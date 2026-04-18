<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Conversation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeneficiaryController extends Controller
{
    public function dashboard(Request $request): View
    {
        $user = $request->user();

        return view('beneficiary.dashboard', [
            'user' => $user,
            'annonces' => Annonce::where('beneficiary_id', $user->id)
                ->latest()
                ->get(),
            'conversations' => Conversation::with(['donor', 'donation.annonce', 'messages.sender'])
                ->where('beneficiary_id', $user->id)
                ->latest()
                ->get(),
        ]);
    }

    public function updatePaymentSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'stripe_account_email' => ['nullable', 'email', 'max:255'],
            'stripe_payment_link' => ['nullable', 'url', 'max:255'],
            'rib_account_holder' => ['nullable', 'string', 'max:255'],
            'rib_bank_name' => ['nullable', 'string', 'max:255'],
            'rib_number' => ['nullable', 'string', 'max:34'],
        ]);

        $request->user()->update($validated);

        return back()->with('status', 'payment-settings-updated');
    }
}
