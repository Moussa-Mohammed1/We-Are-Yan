<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnonceRequest;
use App\Models\Annonce;
use Illuminate\Http\RedirectResponse;

class AnnonceController extends Controller
{
    public function store(StoreAnnonceRequest $request): RedirectResponse
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public');
        }

        Annonce::create([
            'beneficiary_id' => $request->user()->id,
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'category' => $request->validated('category'),
            'quantity' => $request->validated('quantity'),
            'city' => $request->validated('city'),
            'urgency' => $request->validated('urgency'),
            'status' => 'pending',
            'image' => $imagePath,
            'rejection_reason' => null,
        ]);

        return redirect()
            ->route('donor.form')
            ->with('status', 'annonce-created');
    }
}
