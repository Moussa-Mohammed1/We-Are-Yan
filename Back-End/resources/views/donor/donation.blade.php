<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/donation.js'])
    <title>Donate - {{ $annonce->title }}</title>
</head>
<body class="bg-[#f6f5f2] text-[#111111] font-sec min-h-screen">
    @php
        $beneficiaryName = $annonce->beneficiary?->name ?? 'Unknown user';
        $beneficiaryEmail = $annonce->beneficiary?->email ?? 'Not available';
        $beneficiaryCity = $annonce->beneficiary?->city ?? $annonce->city;
        $ribValue = 'RIB not added yet by beneficiary';
        $selectedPaymentMode = old('payment_mode', 'cash');
        $selectedDonationKind = old('donation_kind', 'money');
    @endphp

    <section class="px-6 py-8 md:px-10 lg:px-16">
        <div class="max-w-[1380px] mx-auto">
            <div class="flex items-center justify-between gap-4 mb-10">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('annonces.show', $annonce) }}"
                       class="hidden md:inline-flex items-center px-5 py-3 rounded-full border border-[#d8d8d8] bg-white text-[#111] font-semibold hover:bg-[#f3f3f3] transition">
                        Back To Annonce
                    </a>
                    <a href="{{ route('dashboard') }}"
                       class="hidden md:inline-flex items-center px-5 py-3 rounded-full bg-[#00563f] text-white font-semibold hover:bg-[#004734] transition">
                        Dashboard
                    </a>
                </div>
            </div>

            @if (session('status') === 'donation-submitted')
                <div class="mb-8 rounded-[24px] border border-green-200 bg-green-50 px-6 py-5 text-green-700">
                    Your donation information was sent successfully. Please continue with the selected payment method.
                </div>
            @endif

            <div class="grid grid-cols-1 xl:grid-cols-[1.15fr_0.85fr] gap-8 items-start">
                <div class="space-y-8">
                    <div class="bg-white border border-[#e7e3db] rounded-[36px] p-6 md:p-8 shadow-[0_14px_35px_rgba(0,0,0,0.05)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Donation Form</p>
                        <h1 class="mt-3 text-4xl md:text-5xl leading-[1.05] font-bold">Complete your donation</h1>
                        <p class="mt-4 text-[16px] text-[#666666] leading-7 max-w-[760px]">
                            Choose the payment mode, add your donor information, and specify whether you want to donate money or items like clothes, food, or supplies.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('annonces.donate.submit', $annonce) }}" class="space-y-8">
                        @csrf

                        <div class="bg-white border border-[#e7e3db] rounded-[36px] p-6 md:p-8 shadow-[0_14px_35px_rgba(0,0,0,0.05)]">
                            <div class="flex items-center justify-between gap-4 flex-wrap">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Annonce</p>
                                    <h2 class="mt-2 text-3xl font-bold">{{ $annonce->title }}</h2>
                                </div>
                                <span class="inline-flex px-4 py-2 rounded-full bg-[#eef8f4] text-[#007b67] text-sm font-semibold">
                                    {{ $annonce->category }}
                                </span>
                            </div>

                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="rounded-[22px] bg-[#faf8f3] border border-[#ece7dc] p-5">
                                    <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">City</p>
                                    <p class="mt-3 text-xl font-bold">{{ $annonce->city }}</p>
                                </div>
                                <div class="rounded-[22px] bg-[#faf8f3] border border-[#ece7dc] p-5">
                                    <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">Quantity Needed</p>
                                    <p class="mt-3 text-xl font-bold">{{ $annonce->quantity ?? 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-[#e7e3db] rounded-[36px] p-6 md:p-8 shadow-[0_14px_35px_rgba(0,0,0,0.05)] space-y-8">
                            <div>
                                <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Donor Information</p>
                                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label for="donor_name" class="block text-[16px] font-bold mb-3">Donor Name</label>
                                        <input
                                            id="donor_name"
                                            name="donor_name"
                                            type="text"
                                            value="{{ old('donor_name', $user->name) }}"
                                            class="w-full h-[60px] rounded-[18px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 text-[16px] outline-none focus:border-[#007b67]">
                                        @error('donor_name')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="donor_email" class="block text-[16px] font-bold mb-3">Donor Email</label>
                                        <input
                                            id="donor_email"
                                            name="donor_email"
                                            type="email"
                                            value="{{ old('donor_email', $user->email) }}"
                                            class="w-full h-[60px] rounded-[18px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 text-[16px] outline-none focus:border-[#007b67]">
                                        @error('donor_email')
                                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Payment Mode</p>
                                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="payment-mode-card rounded-[24px] border border-[#d8d8d8] bg-[#fbfbfb] p-5 cursor-pointer transition">
                                        <input type="radio" name="payment_mode" value="cash" class="sr-only payment-mode-input"
                                               {{ $selectedPaymentMode === 'cash' ? 'checked' : '' }}>
                                        <span class="block text-[18px] font-bold">Cash</span>
                                        <span class="block mt-2 text-sm text-[#666]">Meet the beneficiary and give cash directly.</span>
                                    </label>

                                    <label class="payment-mode-card rounded-[24px] border border-[#d8d8d8] bg-[#fbfbfb] p-5 cursor-pointer transition">
                                        <input type="radio" name="payment_mode" value="stripe" class="sr-only payment-mode-input"
                                               {{ $selectedPaymentMode === 'stripe' ? 'checked' : '' }}>
                                        <span class="block text-[18px] font-bold">Stripe</span>
                                        <span class="block mt-2 text-sm text-[#666]">Use an online card payment flow.</span>
                                    </label>

                                    <label class="payment-mode-card rounded-[24px] border border-[#d8d8d8] bg-[#fbfbfb] p-5 cursor-pointer transition">
                                        <input type="radio" name="payment_mode" value="rib" class="sr-only payment-mode-input"
                                               {{ $selectedPaymentMode === 'rib' ? 'checked' : '' }}>
                                        <span class="block text-[18px] font-bold">Send To RIB</span>
                                        <span class="block mt-2 text-sm text-[#666]">Transfer the donation to beneficiary bank info.</span>
                                    </label>
                                </div>
                                @error('payment_mode')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Donation Type</p>
                                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="donation-kind-card rounded-[24px] border border-[#d8d8d8] bg-[#fbfbfb] p-5 cursor-pointer transition">
                                        <input type="radio" name="donation_kind" value="money" class="sr-only donation-kind-input"
                                               {{ $selectedDonationKind === 'money' ? 'checked' : '' }}>
                                        <span class="block text-[18px] font-bold">Money Donation</span>
                                        <span class="block mt-2 text-sm text-[#666]">Enter the amount you want to donate.</span>
                                    </label>

                                    <label class="donation-kind-card rounded-[24px] border border-[#d8d8d8] bg-[#fbfbfb] p-5 cursor-pointer transition">
                                        <input type="radio" name="donation_kind" value="items" class="sr-only donation-kind-input"
                                               {{ $selectedDonationKind === 'items' ? 'checked' : '' }}>
                                        <span class="block text-[18px] font-bold">Object Donation</span>
                                        <span class="block mt-2 text-sm text-[#666]">Describe items like clothes, blankets, or food.</span>
                                    </label>
                                </div>
                                @error('donation_kind')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="moneyDonationSection" class="rounded-[28px] border border-[#e7e3db] p-6">
                                <label for="donation_amount" class="block text-[16px] font-bold mb-3">Donation Amount</label>
                                <input
                                    id="donation_amount"
                                    name="donation_amount"
                                    type="number"
                                    min="1"
                                    step="0.01"
                                    value="{{ old('donation_amount') }}"
                                    placeholder="Enter amount"
                                    class="w-full h-[60px] rounded-[18px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 text-[16px] outline-none focus:border-[#007b67]">
                                @error('donation_amount')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="itemsDonationSection" class="rounded-[28px] border border-[#e7e3db] p-6">
                                <label for="donation_items" class="block text-[16px] font-bold mb-3">Donation Object / Items</label>
                                <textarea
                                    id="donation_items"
                                    name="donation_items"
                                    placeholder="Example: clothes, blankets, school supplies, food..."
                                    class="w-full h-[150px] rounded-[18px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 py-4 text-[16px] outline-none resize-none focus:border-[#007b67]">{{ old('donation_items') }}</textarea>
                                @error('donation_items')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-[16px] font-bold mb-3">Message</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    placeholder="Add a message for the beneficiary..."
                                    class="w-full h-[150px] rounded-[18px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 py-4 text-[16px] outline-none resize-none focus:border-[#007b67]">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-[#00563f] text-white font-bold hover:bg-[#004734] transition">
                                Submit Donation Info
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-8">
                    <div class="bg-[#0f172a] text-white rounded-[36px] p-6 md:p-8 shadow-[0_14px_30px_rgba(0,0,0,0.10)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-white/60 font-semibold">Beneficiary Info</p>
                        <h2 class="mt-3 text-3xl font-bold leading-tight">{{ $beneficiaryName }}</h2>

                        <div class="mt-8 space-y-4">
                            <div class="rounded-[22px] bg-white/5 border border-white/10 p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-white/50 font-semibold">Email</p>
                                <p class="mt-3 text-lg font-bold break-all">{{ $beneficiaryEmail }}</p>
                            </div>
                            <div class="rounded-[22px] bg-white/5 border border-white/10 p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-white/50 font-semibold">City</p>
                                <p class="mt-3 text-lg font-bold">{{ $beneficiaryCity }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#e7e3db] rounded-[36px] p-6 md:p-8 shadow-[0_14px_35px_rgba(0,0,0,0.05)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Payment Details</p>

                        <div id="cashPaymentInfo" class="payment-info-panel mt-6 rounded-[28px] border border-[#ece7dc] bg-[#faf8f3] p-6">
                            <h3 class="text-2xl font-bold">Cash Payment</h3>
                            <p class="mt-3 text-[15px] text-[#666] leading-7">
                                Contact the beneficiary and arrange a safe place to hand over the cash donation.
                            </p>
                        </div>

                        <div id="stripePaymentInfo" class="payment-info-panel mt-6 rounded-[28px] border border-[#ece7dc] bg-[#faf8f3] p-6">
                            <h3 class="text-2xl font-bold">Stripe Payment</h3>
                            <p class="mt-3 text-[15px] text-[#666] leading-7">
                                Stripe integration is not connected yet. For now, submit your info here and confirm the online payment with the platform team.
                            </p>
                        </div>

                        <div id="ribPaymentInfo" class="payment-info-panel mt-6 rounded-[28px] border border-[#ece7dc] bg-[#faf8f3] p-6">
                            <h3 class="text-2xl font-bold">Beneficiary RIB</h3>
                            <p class="mt-3 text-[15px] text-[#666] leading-7">
                                Use the bank information below to send the donation transfer.
                            </p>

                            <div class="mt-5 rounded-[22px] bg-white border border-[#ece7dc] p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">RIB</p>
                                <p class="mt-3 text-lg font-bold break-all">{{ $ribValue }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
