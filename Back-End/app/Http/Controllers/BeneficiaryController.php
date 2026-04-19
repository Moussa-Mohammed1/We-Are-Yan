<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Conversation;
use App\Models\Donation;
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
            'annonces' => Annonce::withSum([
                    'donations as paid_money_donations_sum' => fn ($query) => $query
                        ->where('type', 'money')
                        ->where('status', 'paid'),
                ], 'amount_or_qty')
                ->where('beneficiary_id', $user->id)
                ->latest()
                ->get(),
            'totalCollected' => Donation::whereHas('annonce', fn ($query) => $query->where('beneficiary_id', $user->id))
                ->where('type', 'money')
                ->where('status', 'paid')
                ->sum('amount_or_qty'),
            'conversations' => Conversation::with(['donor', 'donation.annonce', 'messages.sender'])
                ->where('beneficiary_id', $user->id)
                ->latest()
                ->get(),
        ]);
    }

    public function annonceDonations(Request $request, Annonce $annonce): View
    {
        abort_unless($annonce->beneficiary_id === $request->user()->id, 403);

        $annonce->load(['donations' => fn ($query) => $query->whereIn('type', ['money', 'items'])]);
        $annonce->donations->load('donor');

        $paidMoneyDonations = $annonce->donations
            ->where('type', 'money')
            ->where('status', 'paid');

        return view('beneficiary.annonce-donations', [
            'user' => $request->user(),
            'annonce' => $annonce,
            'donations' => $annonce->donations->sortByDesc('created_at'),
            'paidTotal' => $paidMoneyDonations->sum(fn (Donation $donation) => (float) $donation->amount_or_qty),
            'paidCount' => $paidMoneyDonations->count(),
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
