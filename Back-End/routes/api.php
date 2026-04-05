<?php

use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;

Route::get('/annonces/filter', [AnnonceController::class, 'filterByCategory']);
