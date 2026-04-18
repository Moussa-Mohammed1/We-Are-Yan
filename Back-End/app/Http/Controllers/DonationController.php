<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Donation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class DonationController extends Controller
{
    public function showAnnonce(Request $request, Annonce $annonce): View
    {
        abort_if($annonce->status !== 'approved', 404);

        $annonce->load('beneficiary');

        return view('donor.show-annonce', [
            'user' => $request->user(),
            'annonce' => $annonce,
        ]);
    }

    public function create(Request $request, Annonce $annonce): View
    {
        abort_if($annonce->status !== 'approved', 404);

        $annonce->load('beneficiary');

        return view('donor.donation', [
            'user' => $request->user(),
            'annonce' => $annonce,
        ]);
    }

    public function store(Request $request, Annonce $annonce): RedirectResponse
    {
        abort_if($annonce->status !== 'approved', 404);

        $validated = $request->validate([
            'donor_name' => ['required', 'string', 'max:255'],
            'donor_email' => ['required', 'email', 'max:255'],
            'payment_mode' => ['nullable', 'in:cash,stripe,rib'],
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

        if ($validated['donation_kind'] === 'money' && empty($validated['payment_mode'])) {
            return back()
                ->withErrors(['payment_mode' => 'Please choose a payment mode.'])
                ->withInput();
        }

        if ($validated['donation_kind'] === 'items' && empty($validated['donation_items'])) {
            return back()
                ->withErrors(['donation_items' => 'Please describe the items you want to donate.'])
                ->withInput();
        }

        $donation = Donation::create([
            'annonce_id' => $annonce->id,
            'donor_id' => $request->user()->id,
            'donor_name' => $validated['donor_name'],
            'donor_email' => $validated['donor_email'],
            'type' => $validated['donation_kind'],
            'amount_or_qty' => $validated['donation_kind'] === 'money'
                ? $validated['donation_amount']
                : $validated['donation_items'],
            'method' => $validated['donation_kind'] === 'money'
                ? $validated['payment_mode']
                : null,
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        if (($validated['payment_mode'] ?? null) === 'stripe') {
            return $this->redirectToStripeCheckout($request, $annonce, $donation, (float) $validated['donation_amount']);
        }

        return back()->with('status', 'donation-submitted');
    }

    private function redirectToStripeCheckout(
        Request $request,
        Annonce $annonce,
        Donation $donation,
        float $amount
    ): RedirectResponse {
        if (! config('services.stripe.secret')) {
            return back()
                ->withErrors(['payment_mode' => 'Stripe payment is not configured yet.'])
                ->withInput();
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = StripeSession::create([
                'mode' => 'payment',
                'customer_email' => $donation->donor_email,
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'mad',
                        'product_data' => [
                            'name' => 'Donation: ' . $annonce->title,
                        ],
                        'unit_amount' => (int) round($amount * 100),
                    ],
                    'quantity' => 1,
                ]],
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel') . '?donation_id=' . $donation->id,
                'metadata' => [
                    'donation_id' => (string) $donation->id,
                    'annonce_id' => (string) $annonce->id,
                    'donor_id' => (string) $request->user()->id,
                ],
            ]);
        } catch (ApiErrorException $exception) {
            $donation->update(['status' => 'stripe_failed']);

            return back()
                ->withErrors(['payment_mode' => 'Stripe could not start the payment. Please try again.'])
                ->withInput();
        }

        $donation->update([
            'status' => 'payment_pending',
            'stripe_session_id' => $session->id,
        ]);

        return redirect()->away($session->url);
    }
}
