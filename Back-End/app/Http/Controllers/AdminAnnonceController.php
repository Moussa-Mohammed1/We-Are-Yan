<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminAnnonceController extends Controller
{
    public function updateStatus(Request $request, Annonce $annonce): RedirectResponse
    {
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
    }
}
