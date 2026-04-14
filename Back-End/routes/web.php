<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Models\Annonce;
use App\Models\Conversation;
use App\Models\Donation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredAnnonce = Annonce::with('beneficiary')
        ->where('status', 'approved')
        ->latest()
        ->first()
        ?? Annonce::with('beneficiary')->latest()->first();

    return view('welcome', [
        'featuredAnnonce' => $featuredAnnonce,
    ]);
});

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    $annonces = Annonce::with('beneficiary')
        ->where('status', 'approved')
        ->latest()
        ->get();

    $category = Annonce::select('category')->distinct()->get();

    return view('donor.pagedonor', [
        'user' => $user,
        'annonces' => $annonces,
        'category' => $category,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    $annonces = Annonce::with('beneficiary')->latest()->get();
    $pendingAnnonces = $annonces->where('status', 'pending');
    $reviewedAnnonces = $annonces->whereIn('status', ['approved', 'rejected'])->take(8);

    return view('admin.admindashbord', [
        'stats' => [
            'total_users' => User::count(),
            'donors' => User::where('role', 'donateur')->count(),
            'beneficiaries' => User::where('role', 'beneficiaire')->count(),
            'total_annonces' => $annonces->count(),
            'pending_annonces' => $pendingAnnonces->count(),
            'approved_annonces' => $annonces->where('status', 'approved')->count(),
            'rejected_annonces' => $annonces->where('status', 'rejected')->count(),
        ],
        'pendingAnnonces' => $pendingAnnonces,
        'reviewedAnnonces' => $reviewedAnnonces,
    ]);
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.dashboard');

Route::patch('/admin/annonces/{annonce}/status', function (Request $request, Annonce $annonce) {
    $validated = $request->validate([
        'status' => ['required', 'in:approved,rejected'],
        'raport' => ['required', 'string', 'max:1000'],
    ]);

    $annonce->update([
        'status' => $validated['status'],
        'raport' => $validated['raport'],
        'reviewed_at' => now(),
    ]);

    return back()->with('status', 'annonce-reviewed');
})->middleware(['auth', 'verified', 'role:admin'])->name('admin.annonces.status.update');

Route::get('/beneficiary/dashboard', function (Request $request) {
    $user = $request->user();

    $annonces = Annonce::where('beneficiary_id', $user->id)
        ->latest()
        ->get();

    $conversations = Conversation::with(['donor', 'donation.annonce', 'messages.sender'])
        ->where('beneficiary_id', $user->id)
        ->latest()
        ->get();

    return view('beneficiary.dashboard', [
        'user' => $user,
        'annonces' => $annonces,
        'conversations' => $conversations,
    ]);
})->middleware(['auth', 'verified', 'role:beneficiaire'])->name('beneficiary.dashboard');

Route::patch('/beneficiary/payment-settings', function (Request $request) {
    $validated = $request->validate([
        'stripe_account_email' => ['nullable', 'email', 'max:255'],
        'stripe_payment_link' => ['nullable', 'url', 'max:255'],
        'rib_account_holder' => ['nullable', 'string', 'max:255'],
        'rib_bank_name' => ['nullable', 'string', 'max:255'],
        'rib_number' => ['nullable', 'string', 'max:34'],
    ]);

    $request->user()->update($validated);

    return back()->with('status', 'payment-settings-updated');
})->middleware(['auth', 'verified', 'role:beneficiaire'])->name('beneficiary.payment-settings.update');

Route::get('/donor/form', function (Request $request) {
    $user = $request->user();

    return view('donor.formdonor', [
        'user' => $user,
    ]);
})->middleware(['auth', 'verified', 'role:beneficiaire'])->name('donor.form');

Route::get('/edit/{annonce}/form', function (Request $request, Annonce $annonce){
    $user = $request->user();

    return view('donor.formdonor', [
        'user'=> $user,
        'annonce' => $annonce,
    ]);
})->middleware(['auth', 'verified', 'role:beneficiaire'])->name('edit.form');

Route::put('/update/{annonce}', [AnnonceController::class, 'update'])->name('annonce.update');

Route::post('/donor/form', [AnnonceController::class, 'store'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('donor.form.store');

Route::get('/annonces/{annonce}', function (Request $request, Annonce $annonce) {
    $user = $request->user();

    abort_if($annonce->status !== 'approved', 404);

    $annonce->load('beneficiary');

    return view('donor.show-annonce', [
        'user' => $user,
        'annonce' => $annonce,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('annonces.show');

Route::get('/annonces/{annonce}/donate', function (Request $request, Annonce $annonce) {
    $user = $request->user();

    abort_if($annonce->status !== 'approved', 404);

    $annonce->load('beneficiary');

    return view('donor.donation', [
        'user' => $user,
        'annonce' => $annonce,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('annonces.donate');

Route::post('/annonces/{annonce}/donate', function (Request $request, Annonce $annonce) {
    abort_if($annonce->status !== 'approved', 404);

    $validated = $request->validate([
        'donor_name' => ['required', 'string', 'max:255'],
        'donor_email' => ['required', 'email', 'max:255'],
        'payment_mode' => ['nullable', 'in:cash,stripe,rib'],
        'donation_kind' => ['required', 'in:money,items'],
        'donation_amount' => ['nullable', 'numeric', 'min:1'],
        'donation_items' => ['nullable', 'string', 'max:1000'],
        'message' => ['nullable', 'string', 'max:1000'],
    ]);

    if ($validated['donation_kind'] === 'money' && empty($validated['donation_amount'])) {
        return back()
            ->withErrors(['donation_amount' => 'Please enter the donation amount.'])
            ->withInput();
    }

    if ($validated['donation_kind'] === 'money' && empty($validated['payment_mode'])) {
        return back()
            ->withErrors(['payment_mode' => 'Please choose a payment mode.'])
            ->withInput();
    }

    if ($validated['donation_kind'] === 'items' && empty($validated['donation_items'])) {
        return back()
            ->withErrors(['donation_items' => 'Please describe the items you want to donate.'])
            ->withInput();
    }

    Donation::create([
        'annonce_id' => $annonce->id,
        'donor_id' => $request->user()->id,
        'donor_name' => $validated['donor_name'],
        'donor_email' => $validated['donor_email'],
        'type' => $validated['donation_kind'],
        'amount_or_qty' => $validated['donation_kind'] === 'money'
            ? $validated['donation_amount']
            : $validated['donation_items'],
        'method' => $validated['donation_kind'] === 'money'
            ? $validated['payment_mode']
            : null,
        'message' => $validated['message'] ?? null,
        'status' => 'pending',
    ]);

    return back()->with('status', 'donation-submitted');
})->middleware(['auth', 'verified', 'role:donateur'])->name('annonces.donate.submit');

Route::get('/annonces/{annonce}/chat', function (Request $request, Annonce $annonce) {
    abort_if($annonce->status !== 'approved', 404);

    $annonce->load('beneficiary');

    $user = $request->user();

    abort_if($annonce->beneficiary_id === $user->id, 403);

    $donation = Donation::firstOrCreate(
        [
            'annonce_id' => $annonce->id,
            'donor_id' => $user->id,
            'type' => 'chat',
        ],
        [
            'donor_name' => $user->name,
            'donor_email' => $user->email,
            'amount_or_qty' => 'Chat',
            'method' => null,
            'message' => null,
            'status' => 'pending',
        ]
    );

    $conversation = Conversation::firstOrCreate(
        ['donation_id' => $donation->id],
        [
            'donor_id' => $user->id,
            'beneficiary_id' => $annonce->beneficiary_id,
        ]
    );

    $conversation->load(['donor', 'beneficiary', 'donation.annonce', 'messages.sender']);

    return view('chat.show', [
        'user' => $user,
        'conversation' => $conversation,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('chat.start');

Route::get('/chat/{conversation}', function (Request $request, Conversation $conversation) {
    $user = $request->user();

    abort_unless($conversation->donor_id === $user->id || $conversation->beneficiary_id === $user->id, 403);

    $conversation->load(['donor', 'beneficiary', 'donation.annonce', 'messages.sender']);

    return view('chat.show', [
        'user' => $user,
        'conversation' => $conversation,
    ]);
})->middleware(['auth', 'verified'])->name('chat.show');

Route::post('/chat/{conversation}/messages', function (Request $request, Conversation $conversation) {
    $user = $request->user();

    abort_unless($conversation->donor_id === $user->id || $conversation->beneficiary_id === $user->id, 403);

    $validated = $request->validate([
        'content' => ['required', 'string', 'max:1000'],
    ]);

    Message::create([
        'conversation_id' => $conversation->id,
        'sender_id' => $user->id,
        'content' => $validated['content'],
    ]);

    return back();
})->middleware(['auth', 'verified'])->name('chat.messages.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
