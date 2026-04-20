<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>Donate - {{ $annonce->title }}</title>
</head>
<body class="bg-[#f6f5f2] text-[#111111] font-sec min-h-screen">
    @php
        $beneficiary = $annonce->beneficiary;
    @endphp

    <main class="max-w-6xl mx-auto px-6 py-8">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center">
                <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-14 object-contain">
            </a>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('annonces.show', $annonce) }}" class="px-5 py-3 rounded-full border border-[#d8d8d8] bg-white font-semibold hover:bg-[#f3f3f3] transition">
                    Back To Annonce
                </a>
                <a href="{{ route('dashboard') }}" class="px-5 py-3 rounded-full bg-[#00563f] text-white font-semibold hover:bg-[#004734] transition">
                    Dashboard
                </a>
            </div>
        </header>

        @if (session('status') === 'donation-submitted')
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
                Your donation information was sent successfully.
            </div>
        @elseif (session('status') === 'stripe-payment-paid')
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
                Your Stripe payment was validated successfully.
            </div>
        @elseif (session('status') === 'stripe-payment-not-paid')
            <div class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 px-5 py-4 text-yellow-800">
                Stripe did not confirm the payment yet. Please try again.
            </div>
        @elseif (session('status') === 'stripe-payment-cancelled')
            <div class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 px-5 py-4 text-yellow-800">
                Stripe payment was cancelled.
            </div>
        @endif

        <section class="grid grid-cols-1 lg:grid-cols-[1fr_360px] gap-8 items-start">
            <form method="POST" action="{{ route('annonces.donate.submit', $annonce) }}" class="bg-white border border-[#e7e3db] rounded-[28px] p-6 md:p-8 shadow-sm space-y-6">
                @csrf

                <div>
                    <p class="text-sm uppercase tracking-[0.16em] text-[#777] font-semibold">Donation</p>
                    <h1 class="mt-2 text-3xl md:text-4xl font-bold">Donate to {{ $annonce->title }}</h1>
                    <p class="mt-3 text-[#666] leading-7">
                        Fill in your information, choose how you want to donate, then submit the form. Stripe payments open a secure payment page.
                    </p>
                </div>

                <div>
                    <label class="block font-bold mb-3">Donation type</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-center gap-3 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 py-3 cursor-pointer">
                            <input type="radio" name="donation_kind" value="money" {{ old('donation_kind', 'money') === 'money' ? 'checked' : '' }}>
                            <span class="font-semibold">Money</span>
                        </label>

                        <label class="flex items-center gap-3 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 py-3 cursor-pointer">
                            <input type="radio" name="donation_kind" value="items" {{ old('donation_kind', 'money') === 'items' ? 'checked' : '' }}>
                            <span class="font-semibold">Items</span>
                        </label>
                    </div>
                    @error('donation_kind')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="donor_name" class="block font-bold mb-2">Name</label>
                        <input id="donor_name" name="donor_name" type="text" value="{{ old('donor_name', $user->name) }}" class="w-full h-12 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 outline-none focus:border-[#007b67]">
                        @error('donor_name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="donor_email" class="block font-bold mb-2">Email</label>
                        <input id="donor_email" name="donor_email" type="email" value="{{ old('donor_email', $user->email) }}" class="w-full h-12 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 outline-none focus:border-[#007b67]">
                        @error('donor_email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="paymentMethodSection">
                    <label class="block font-bold mb-3">Payment mode</label>
                    <div class="grid grid-cols-1 gap-3">
                        <label class="flex items-center gap-3 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 py-3 cursor-pointer">
                            <input type="radio" name="payment_mode" value="stripe" {{ old('payment_mode', 'stripe') === 'stripe' ? 'checked' : '' }}>
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#635bff] text-lg font-extrabold text-white">S</span>
                            <span class="font-semibold">Stripe</span>
                        </label>
                    </div>
                    @error('payment_mode')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div id="amountSection">
                    <div>
                        <label for="donation_amount" class="block font-bold mb-2">Amount</label>
                        <input id="donation_amount" name="donation_amount" type="number" min="1" step="0.01" value="{{ old('donation_amount') }}" placeholder="Example: 100" class="w-full h-12 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 outline-none focus:border-[#007b67]">
                        <p class="text-sm text-[#777] mt-2">Required only for money donations.</p>
                        @error('donation_amount')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="itemsSection">
                    <div>
                        <label for="donation_items" class="block font-bold mb-2">Items</label>
                        <input id="donation_items" name="donation_items" type="text" value="{{ old('donation_items') }}" placeholder="Example: clothes, food" class="w-full h-12 rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 outline-none focus:border-[#007b67]">
                        <p class="text-sm text-[#777] mt-2">Required only for item donations.</p>
                        @error('donation_items')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="message" class="block font-bold mb-2">Message</label>
                    <textarea id="message" name="message" rows="4" placeholder="Add a message for the beneficiary" class="w-full rounded-xl border border-[#d8d8d8] bg-[#fbfbfb] px-4 py-3 outline-none resize-none focus:border-[#007b67]">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button id="donationSubmitButton" type="submit" class="w-full sm:w-auto px-8 py-4 rounded-full bg-[#00563f] text-white font-bold hover:bg-[#004734] transition">
                    Submit Donation
                </button>
            </form>

            <aside class="bg-white border border-[#e7e3db] rounded-[28px] p-6 shadow-sm space-y-5 lg:sticky lg:top-8">
                <div>
                    <p class="text-sm uppercase tracking-[0.16em] text-[#777] font-semibold">Annonce</p>
                    <h2 class="mt-2 text-2xl font-bold">{{ $annonce->title }}</h2>
                    <p class="mt-2 text-[#666]">{{ $annonce->category }} - {{ $annonce->city }}</p>
                    <p class="mt-2 text-[#666]">Quantity: {{ $annonce->quantity ?? 'Not specified' }}</p>
                </div>

                <div class="border-t border-[#eee] pt-5">
                    <p class="text-sm uppercase tracking-[0.16em] text-[#777] font-semibold">Beneficiary</p>
                    <p class="mt-2 font-bold">{{ $beneficiary?->name ?? 'Unknown user' }}</p>
                    <p class="mt-1 text-[#666] break-all">{{ $beneficiary?->email ?? 'Not available' }}</p>
                </div>

                <div class="border-t border-[#eee] pt-5 space-y-3 text-sm text-[#666]">
                    <div class="flex items-start gap-3">
                        <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#635bff] text-lg font-extrabold text-white">S</span>
                        <p><span class="font-bold text-[#111]">Stripe:</span> {{ $beneficiary?->stripe_account_email ?? 'Stripe email not added yet.' }}</p>
                    </div>

                    @if ($beneficiary?->stripe_payment_link)
                        <a href="{{ $beneficiary->stripe_payment_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex text-[#00563f] font-bold underline">
                            Open Stripe Payment Link
                        </a>
                    @endif
                </div>
            </aside>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kindInputs = document.querySelectorAll('input[name="donation_kind"]');
            const paymentSection = document.getElementById('paymentMethodSection');
            const amountSection = document.getElementById('amountSection');
            const itemsSection = document.getElementById('itemsSection');
            const paymentInputs = document.querySelectorAll('input[name="payment_mode"]');
            const submitButton = document.getElementById('donationSubmitButton');

            function updateDonationForm() {
                const selectedKind = document.querySelector('input[name="donation_kind"]:checked').value;
                const selectedPayment = document.querySelector('input[name="payment_mode"]:checked')?.value;
                const isMoney = selectedKind === 'money';

                paymentSection.classList.toggle('hidden', !isMoney);
                amountSection.classList.toggle('hidden', !isMoney);
                itemsSection.classList.toggle('hidden', isMoney);

                paymentInputs.forEach(function (input) {
                    input.disabled = !isMoney;
                });

                submitButton.textContent = isMoney && selectedPayment === 'stripe'
                    ? 'Pay With Stripe'
                    : 'Submit Donation';
            }

            kindInputs.forEach(function (input) {
                input.addEventListener('change', updateDonationForm);
            });
            paymentInputs.forEach(function (input) {
                input.addEventListener('change', updateDonationForm);
            });

            updateDonationForm();
        });
    </script>
</body>
</html>
