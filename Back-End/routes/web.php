<?php

use App\Http\Controllers\AdminAnnonceController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeCheckoutController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'donor'])
    ->middleware(['auth', 'verified', 'role:donateur'])
    ->name('dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/events/create', [EventController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.events.create');

Route::post('/admin/events', [EventController::class, 'store'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.events.store');

Route::post('/events/{event}/participate', [EventController::class, 'participate'])
    ->middleware(['auth', 'verified', 'role:donateur'])
    ->name('events.participate');

Route::patch('/admin/annonces/{annonce}/status', [AdminAnnonceController::class, 'updateStatus'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('admin.annonces.status.update');

Route::get('/beneficiary/dashboard', [BeneficiaryController::class, 'dashboard'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('beneficiary.dashboard');

Route::patch('/beneficiary/payment-settings', [BeneficiaryController::class, 'updatePaymentSettings'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('beneficiary.payment-settings.update');

Route::get('/donor/form', [AnnonceController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('donor.form');

Route::get('/edit/{annonce}/form', [AnnonceController::class, 'edit'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('edit.form');

Route::put('/update/{annonce}', [AnnonceController::class, 'update'])->name('annonce.update');

Route::post('/donor/form', [AnnonceController::class, 'store'])
    ->middleware(['auth', 'verified', 'role:beneficiaire'])
    ->name('donor.form.store');

Route::get('/annonces/{annonce}', [DonationController::class, 'showAnnonce'])
    ->middleware(['auth', 'verified', 'role:donateur'])
    ->name('annonces.show');

Route::get('/annonces/{annonce}/donate', [DonationController::class, 'create'])
    ->middleware(['auth', 'verified', 'role:donateur'])
    ->name('annonces.donate');

Route::post('/annonces/{annonce}/donate', [DonationController::class, 'store'])
    ->middleware(['auth', 'verified', 'role:donateur'])
    ->name('annonces.donate.submit');

Route::get('/annonces/{annonce}/chat', [ChatController::class, 'start'])
    ->middleware(['auth', 'verified', 'role:donateur'])
    ->name('chat.start');

Route::get('/chat/{conversation}', [ChatController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('chat.show');

Route::post('/chat/{conversation}/messages', [ChatController::class, 'storeMessage'])
    ->middleware(['auth', 'verified'])
    ->name('chat.messages.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/checkout', [StripeCheckoutController::class, 'checkout'])->name('stripe.checkout');
Route::get('/checkout/success', [StripeCheckoutController::class, 'success'])->name('stripe.success');
Route::get('/checkout/cancel', [StripeCheckoutController::class, 'cancel'])->name('stripe.cancel');
