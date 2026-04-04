<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use App\Models\Annonce;
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

    $annonces = Annonce::with('beneficiary')->latest()->get();

    return view('donor.pagedonor', [
        'user' => $user,
        'annonces' => $annonces,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('dashboard');

Route::get('/beneficiary/dashboard', function (Request $request) {
    $user = $request->user();

    $annonces = Annonce::where('beneficiary_id', $user->id)
        ->latest()
        ->get();

    return view('beneficiary.dashboard', [
        'user' => $user,
        'annonces' => $annonces,
    ]);
})->middleware(['auth', 'verified', 'role:beneficiaire'])->name('beneficiary.dashboard');

Route::get('/donor/form', function (Request $request) {
    $user = $request->user();

    return view('donor.formdonor', [
        'user' => $user,
    ]);
})->middleware(['auth', 'verified', 'role:beneficiaire'])->name('donor.form');

Route::post('/donor/form', [AnnonceController::class, 'store'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('donor.form.store');

Route::get('/annonces/{annonce}', function (Request $request, Annonce $annonce) {
    $user = $request->user();

    $annonce->load('beneficiary');

    return view('donor.show-annonce', [
        'user' => $user,
        'annonce' => $annonce,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('annonces.show');

Route::get('/annonces/{annonce}/donate', function (Request $request, Annonce $annonce) {
    $user = $request->user();

    $annonce->load('beneficiary');

    return view('donor.donation', [
        'user' => $user,
        'annonce' => $annonce,
    ]);
})->middleware(['auth', 'verified', 'role:donateur'])->name('annonces.donate');

Route::post('/annonces/{annonce}/donate', function (Request $request, Annonce $annonce) {
    $validated = $request->validate([
        'donor_name' => ['required', 'string', 'max:255'],
        'donor_email' => ['required', 'email', 'max:255'],
        'payment_mode' => ['required', 'in:cash,stripe,rib'],
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

    if ($validated['donation_kind'] === 'items' && empty($validated['donation_items'])) {
        return back()
            ->withErrors(['donation_items' => 'Please describe the items you want to donate.'])
            ->withInput();
    }

    return back()->with('status', 'donation-submitted');
})->middleware(['auth', 'verified', 'role:donateur'])->name('annonces.donate.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
