<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    $user = $request->user();

    abort_unless($user && $user->role === 'donateur', 403);

    return view('donor.pagedonor', [
        'user' => $user,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/donor/form', function (Request $request) {
    $user = $request->user();

    abort_unless($user && $user->role === 'donateur', 403);

    return view('donor.formdonor', [
        'user' => $user,
    ]);
})->middleware(['auth', 'verified'])->name('donor.form');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
