<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnonceRequest;
use App\Models\Annonce;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnnonceController extends Controller
{
    public function create(Request $request): View
    {
        return view('donor.formdonor', [
            'user' => $request->user(),
        ]);
    }

    public function edit(Request $request, Annonce $annonce): View
    {
        return view('donor.formdonor', [
            'user' => $request->user(),
            'annonce' => $annonce,
        ]);
    }

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
            'raport' => null,
        ]);

        return redirect()
            ->route($request->user()->homeRouteName())
            ->with('status', 'annonce-created');
    }

    public function update(Request $request, $id){
        $annonce = Annonce::findOrFail($id);

        $annonce->title = $request->title;
        $annonce->category = $request->category;
        $annonce->quantity = $request->quantity;
        $annonce->city = $request->city;
        $annonce->urgency = $request->urgency;


        $annonce->save();

        return redirect()->route('beneficiary.dashboard')->with('success','Annonce Update');

    }

    public function destroy(Request $request, Annonce $annonce): RedirectResponse
    {
        abort_unless($annonce->beneficiary_id === $request->user()->id, 403);

        if ($annonce->donations()->whereIn('type', ['money', 'items'])->exists()) {
            return back()->with('status', 'annonce-has-donations');
        }

        $annonce->delete();

        return back()->with('status', 'annonce-deleted');
    }

    public function filterByCategory(Request $request): JsonResponse
    {
        $query = Annonce::with('beneficiary')
            ->where('status', 'approved')
            ->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category')->toString());
        }

        $annonces = $query->get()->map(function (Annonce $annonce) {
            return [
                'id' => $annonce->id,
                'title' => $annonce->title,
                'description' => $annonce->description,
                'category' => $annonce->category,
                'quantity' => $annonce->quantity,
                'city' => $annonce->city,
                'urgency' => $annonce->urgency,
                'image' => $annonce->image ? asset('storage/' . $annonce->image) : null,
                'beneficiary_name' => $annonce->beneficiary?->name ?? 'Unknown user',
                'created_at_human' => $annonce->created_at?->diffForHumans(),
                'show_url' => route('annonces.show', $annonce),
            ];
        });

        return response()->json([
            'annonces' => $annonces,
        ]);
    }
}
