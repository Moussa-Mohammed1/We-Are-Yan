<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class StripeCheckoutController extends Controller
{
    public function success(Request $request): RedirectResponse
    {
        $request->validate([
            'session_id' => ['required', 'string'],
        ]);

        if (! config('services.stripe.secret')) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'stripe-not-configured');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = StripeSession::retrieve($request->string('session_id')->toString());
        } catch (ApiErrorException $exception) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'stripe-verification-failed');
        }

        $donation = Donation::where('stripe_session_id', $session->id)->first();

        if (! $donation || $donation->donor_id !== $request->user()->id) {
            abort(403);
        }

        if ($session->payment_status === 'paid') {
            $donation->update(['status' => 'paid']);

            return redirect()
                ->route('annonces.donate', $donation->annonce)
                ->with('status', 'stripe-payment-paid');
        }

        return redirect()
            ->route('annonces.donate', $donation->annonce)
            ->with('status', 'stripe-payment-not-paid');
    }

    public function cancel(Request $request): RedirectResponse
    {
        $donation = Donation::where('id', $request->integer('donation_id'))
            ->where('donor_id', $request->user()->id)
            ->first();

        if ($donation && $donation->status === 'payment_pending') {
            $donation->update(['status' => 'cancelled']);
        }

        return redirect()
            ->route('dashboard')
            ->with('status', 'stripe-payment-cancelled');
    }
}
