<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredAnnonce = Annonce::with('beneficiary')
            ->where('status', 'approved')
            ->latest()
            ->first()
            ?? Annonce::with('beneficiary')->latest()->first();

        return view('welcome', [
            'featuredAnnonce' => $featuredAnnonce,
        ]);
    }
}
