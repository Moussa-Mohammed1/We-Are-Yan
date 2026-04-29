<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - {{ $annonce->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="font-sec text-[#111111] min-h-screen page-shell">
    @php
        $beneficiary = $annonce->beneficiary;
        $heroImage = $annonce->image ? asset('storage/' . $annonce->image) : null;
    @endphp

    <div class="max-w-[1440px] mx-auto px-6 md:px-10 lg:px-16 py-6 md:py-8">
        <header class="glass-panel animated-border rounded-[28px] px-5 md:px-8 py-4 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between" data-animate>
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="inline-flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-14 object-contain">
                </a>
                <div class="hidden md:block h-10 w-px bg-[#d8e3de]"></div>
                <div class="hidden md:block">
                    <p class="text-[12px] uppercase tracking-[0.24em] text-[#6d6d6d] font-semibold">Donation Flow</p>
                    <p class="text-[15px] text-[#4e4e4e] mt-1">Support a verified request in a few simple steps.</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('annonces.show', $annonce) }}" class="hover-lift px-5 py-3 rounded-full border border-[#d7dfdb] bg-white/70 font-semibold text-[#1f1f1f]">
                    Back To Annonce
                </a>
                <a href="{{ route('dashboard') }}" class="hover-lift px-5 py-3 rounded-full bg-[#00563f] text-white font-semibold shadow-[0_14px_34px_rgba(0,86,63,0.2)]">
                    Dashboard
                </a>
            </div>
        </header>

        @if (session('status') === 'donation-submitted')
            <div class="mt-6 rounded-[24px] border border-green-200 bg-green-50/90 px-5 py-4 text-green-700 glass-panel" data-animate>
                Your donation information was sent successfully.
            </div>
        @elseif (session('status') === 'stripe-payment-paid')
            <div class="mt-6 rounded-[24px] border border-green-200 bg-green-50/90 px-5 py-4 text-green-700 glass-panel" data-animate>
                Your Stripe payment was validated successfully.
            </div>
        @elseif (session('status') === 'stripe-payment-not-paid')
            <div class="mt-6 rounded-[24px] border border-yellow-200 bg-yellow-50/90 px-5 py-4 text-yellow-800 glass-panel" data-animate>
                Stripe did not confirm the payment yet. Please try again.
            </div>
        @elseif (session('status') === 'stripe-payment-cancelled')
            <div class="mt-6 rounded-[24px] border border-yellow-200 bg-yellow-50/90 px-5 py-4 text-yellow-800 glass-panel" data-animate>
                Stripe payment was cancelled.
            </div>
        @endif

        <section class="mt-8 grid grid-cols-1 xl:grid-cols-[1.08fr_0.92fr] gap-8 items-start">
            <div class="space-y-8">
                <section class="relative overflow-hidden rounded-[38px] border border-white/60 bg-[#0b4f3c] text-white elevated-card shimmer-band" data-animate>
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.18),transparent_32%),radial-gradient(circle_at_bottom_right,rgba(200,247,219,0.2),transparent_24%)]"></div>
                    <div class="relative grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-8 p-7 md:p-10">
                        <div class="flex flex-col justify-between">
                            <div>
                                <p class="text-[12px] uppercase tracking-[0.28em] text-white/70 font-semibold">Support Request</p>
                                <h1 class="mt-4 text-[38px] md:text-[54px] leading-[1.02] font-bold max-w-[12ch]">
                                    Donate to {{ $annonce->title }}
                                </h1>
                                <p class="mt-5 text-[15px] md:text-[16px] leading-7 text-white/78 max-w-[58ch]">
                                    Choose a money donation or offer useful items. Every contribution is linked to a real beneficiary and managed through the We Are Yan platform.
                                </p>
                            </div>

                            <div class="mt-8 flex flex-wrap gap-3" data-stagger-children>
                                <span class="px-4 py-2 rounded-full bg-white/10 border border-white/15 text-sm">Category: {{ $annonce->category }}</span>
                                <span class="px-4 py-2 rounded-full bg-white/10 border border-white/15 text-sm">City: {{ $annonce->city }}</span>
                                <span class="px-4 py-2 rounded-full bg-white/10 border border-white/15 text-sm">Urgency: {{ ucfirst($annonce->urgency) }}</span>
                            </div>
                        </div>

                        <div class="relative min-h-[300px] rounded-[30px] overflow-hidden border border-white/15 bg-white/10 backdrop-blur-sm">
                            @if ($heroImage)
                                <img src="{{ $heroImage }}" alt="{{ $annonce->title }}" class="absolute inset-0 h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#093426]/80 via-transparent to-white/10"></div>
                            @else
                                <div class="absolute inset-0 bg-[linear-gradient(135deg,#dff4e5_0%,#bde0d0_100%)]"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-24 h-24 rounded-full bg-white/80 text-[#00563f] flex items-center justify-center pulse-soft">
                                        <i class="fa-solid fa-hand-holding-heart text-[32px]"></i>
                                    </div>
                                </div>
                            @endif

                            <div class="absolute left-5 right-5 bottom-5 glass-panel rounded-[22px] px-5 py-4 text-[#111111]">
                                <p class="text-[12px] uppercase tracking-[0.18em] text-[#6d6d6d] font-semibold">Beneficiary</p>
                                <p class="mt-2 text-[20px] font-bold">{{ $beneficiary?->name ?? 'Unknown user' }}</p>
                                <p class="mt-1 text-sm text-[#555]">{{ $beneficiary?->email ?? 'Not available' }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <form method="POST" action="{{ route('annonces.donate.submit', $annonce) }}" class="glass-panel animated-border rounded-[34px] p-6 md:p-8 lg:p-10 space-y-8 elevated-card" data-animate>
                    @csrf

                    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                        <div>
                            <p class="text-[12px] uppercase tracking-[0.24em] text-[#6d6d6d] font-semibold">Donation Form</p>
                            <h2 class="mt-2 text-[30px] md:text-[38px] font-bold leading-[1.08]">Choose the way you want to help</h2>
                        </div>
                        <div class="rounded-[20px] bg-[#f2f7f5] border border-[#d7e6df] px-4 py-3 text-sm text-[#476158]">
                            Secure flow for money donations through Stripe
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="donationTypeCards">
                        <label class="donation-option group relative rounded-[26px] border border-[#d5ddd9] bg-white/70 p-5 cursor-pointer hover-lift">
                            <input class="sr-only" type="radio" name="donation_kind" value="money" {{ old('donation_kind', 'money') === 'money' ? 'checked' : '' }}>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="w-12 h-12 rounded-2xl bg-[#e7f7f0] text-[#00563f] flex items-center justify-center text-xl">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <h3 class="mt-5 text-[22px] font-bold">Money Donation</h3>
                                    <p class="mt-2 text-[14px] leading-6 text-[#666]">Send a direct financial contribution to support the request quickly.</p>
                                </div>
                                <span class="donation-option-indicator mt-1 w-5 h-5 rounded-full border-2 border-[#b5c4bd]"></span>
                            </div>
                        </label>

                        <label class="donation-option group relative rounded-[26px] border border-[#d5ddd9] bg-white/70 p-5 cursor-pointer hover-lift">
                            <input class="sr-only" type="radio" name="donation_kind" value="items" {{ old('donation_kind', 'money') === 'items' ? 'checked' : '' }}>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="w-12 h-12 rounded-2xl bg-[#fff1dc] text-[#ab6b00] flex items-center justify-center text-xl">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>
                                    <h3 class="mt-5 text-[22px] font-bold">Items Donation</h3>
                                    <p class="mt-2 text-[14px] leading-6 text-[#666]">Offer useful goods such as clothes, food, school supplies, or medicine.</p>
                                </div>
                                <span class="donation-option-indicator mt-1 w-5 h-5 rounded-full border-2 border-[#b5c4bd]"></span>
                            </div>
                        </label>
                    </div>
                    @error('donation_kind')
                        <p class="text-red-500 text-sm -mt-4">{{ $message }}</p>
                    @enderror

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5" data-stagger-children>
                        <div>
                            <label for="donor_name" class="block font-bold mb-3 text-[15px]">Name</label>
                            <input id="donor_name" name="donor_name" type="text" value="{{ old('donor_name', $user->name) }}" class="w-full h-[58px] rounded-[18px] border border-[#d6ddd9] bg-white/75 px-4 outline-none" placeholder="Your full name">
                            @error('donor_name')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="donor_email" class="block font-bold mb-3 text-[15px]">Email</label>
                            <input id="donor_email" name="donor_email" type="email" value="{{ old('donor_email', $user->email) }}" class="w-full h-[58px] rounded-[18px] border border-[#d6ddd9] bg-white/75 px-4 outline-none" placeholder="you@example.com">
                            @error('donor_email')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="paymentMethodSection" class="rounded-[28px] border border-[#dde6e1] bg-[#f7faf8] p-5 md:p-6">
                        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                            <div>
                                <p class="text-[12px] uppercase tracking-[0.22em] text-[#6d6d6d] font-semibold">Payment Mode</p>
                                <h3 class="mt-2 text-[24px] font-bold">Secure online checkout</h3>
                            </div>
                            <div class="text-sm text-[#666]">Available when you choose a money donation.</div>
                        </div>

                        <div class="mt-5 grid grid-cols-1 gap-3">
                            <label class="payment-option flex items-center gap-4 rounded-[22px] border border-[#d8e0dc] bg-white px-4 py-4 cursor-pointer hover-lift">
                                <input class="sr-only" type="radio" name="payment_mode" value="stripe" {{ old('payment_mode', 'stripe') === 'stripe' ? 'checked' : '' }}>
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#635bff] text-lg font-extrabold text-white shadow-[0_10px_20px_rgba(99,91,255,0.25)]">S</span>
                                <span>
                                    <span class="block font-bold">Stripe Checkout</span>
                                    <span class="block text-sm text-[#666]">Protected checkout page for secure card payment.</span>
                                </span>
                            </label>
                        </div>
                        @error('payment_mode')
                            <p class="text-red-500 text-sm mt-3">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="amountSection" class="rounded-[28px] border border-[#dde6e1] bg-white/65 p-5">
                        <label for="donation_amount" class="block font-bold mb-3 text-[15px]">Amount</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#6d6d6d] font-semibold">MAD</span>
                            <input id="donation_amount" name="donation_amount" type="number" min="1" step="0.01" value="{{ old('donation_amount') }}" placeholder="100" class="w-full h-[58px] rounded-[18px] border border-[#d6ddd9] bg-white px-16 outline-none">
                        </div>
                        <p class="text-sm text-[#777] mt-3">Required only for money donations.</p>
                        @error('donation_amount')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="itemsSection" class="rounded-[28px] border border-[#dde6e1] bg-white/65 p-5">
                        <label for="donation_items" class="block font-bold mb-3 text-[15px]">Items</label>
                        <input id="donation_items" name="donation_items" type="text" value="{{ old('donation_items') }}" placeholder="Example: clothes, blankets, food parcels" class="w-full h-[58px] rounded-[18px] border border-[#d6ddd9] bg-white px-4 outline-none">
                        <p class="text-sm text-[#777] mt-3">Required only for item donations.</p>
                        @error('donation_items')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block font-bold mb-3 text-[15px]">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Write a short message to the beneficiary" class="w-full rounded-[24px] border border-[#d6ddd9] bg-white/75 px-5 py-4 outline-none resize-none">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between pt-2">
                        <p class="text-sm leading-6 text-[#67736d] max-w-[56ch]">
                            The beneficiary and the admin team will receive your donation intent. If you donate money, you will be redirected to Stripe to finalize the payment.
                        </p>

                        <button id="donationSubmitButton" type="submit" class="hover-lift w-full md:w-auto min-w-[240px] px-8 py-4 rounded-full bg-[#00563f] text-white font-bold shadow-[0_18px_34px_rgba(0,86,63,0.24)]">
                            Submit Donation
                        </button>
                    </div>
                </form>
            </div>

            <aside class="space-y-6 xl:sticky xl:top-8" data-animate>
                <section class="glass-panel rounded-[34px] p-6 md:p-7 elevated-card">
                    <p class="text-[12px] uppercase tracking-[0.24em] text-[#6d6d6d] font-semibold">Request Summary</p>
                    <div class="mt-5 space-y-5">
                        <div class="rounded-[26px] overflow-hidden bg-[#eef6f3] border border-[#d6e5de] min-h-[230px]">
                            @if ($heroImage)
                                <img src="{{ $heroImage }}" alt="{{ $annonce->title }}" class="w-full h-[230px] object-cover">
                            @else
                                <div class="h-[230px] flex items-center justify-center">
                                    <div class="w-20 h-20 rounded-full bg-white text-[#00563f] flex items-center justify-center shadow-md">
                                        <i class="fa-solid fa-image text-[28px]"></i>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h2 class="text-[28px] font-bold leading-[1.12]">{{ $annonce->title }}</h2>
                            <p class="mt-3 text-[15px] leading-7 text-[#626262]">
                                {{ \Illuminate\Support\Str::limit($annonce->description, 180) }}
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm" data-stagger-children>
                            <div class="rounded-[20px] bg-[#f4f7f5] border border-[#dce7e1] px-4 py-4">
                                <p class="text-[#7a7a7a]">Category</p>
                                <p class="mt-1 font-bold text-[#1b1b1b]">{{ $annonce->category }}</p>
                            </div>
                            <div class="rounded-[20px] bg-[#f4f7f5] border border-[#dce7e1] px-4 py-4">
                                <p class="text-[#7a7a7a]">Quantity</p>
                                <p class="mt-1 font-bold text-[#1b1b1b]">{{ $annonce->quantity ?? 'Flexible' }}</p>
                            </div>
                            <div class="rounded-[20px] bg-[#f4f7f5] border border-[#dce7e1] px-4 py-4">
                                <p class="text-[#7a7a7a]">City</p>
                                <p class="mt-1 font-bold text-[#1b1b1b]">{{ $annonce->city }}</p>
                            </div>
                            <div class="rounded-[20px] bg-[#f4f7f5] border border-[#dce7e1] px-4 py-4">
                                <p class="text-[#7a7a7a]">Urgency</p>
                                <p class="mt-1 font-bold text-[#1b1b1b]">{{ ucfirst($annonce->urgency) }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="glass-panel rounded-[34px] p-6 md:p-7 elevated-card">
                    <p class="text-[12px] uppercase tracking-[0.24em] text-[#6d6d6d] font-semibold">Beneficiary Details</p>
                    <div class="mt-5 space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl bg-[#e7f7f0] text-[#00563f] flex items-center justify-center text-[22px]">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <div>
                                <p class="font-bold text-[20px]">{{ $beneficiary?->name ?? 'Unknown user' }}</p>
                                <p class="text-sm text-[#666] break-all">{{ $beneficiary?->email ?? 'Not available' }}</p>
                            </div>
                        </div>

                        <div class="rounded-[24px] bg-[#f4f7f5] border border-[#dce7e1] px-5 py-5 space-y-3 text-sm text-[#53635c]">
                            <div class="flex items-start gap-3">
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-[#635bff] text-base font-extrabold text-white">S</span>
                                <p><span class="font-bold text-[#111]">Stripe email:</span> {{ $beneficiary?->stripe_account_email ?? 'Stripe email not added yet.' }}</p>
                            </div>

                            @if ($beneficiary?->stripe_payment_link)
                                <a href="{{ $beneficiary->stripe_payment_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-[#00563f] font-bold">
                                    Open Stripe Payment Link
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[12px]"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </section>
            </aside>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kindInputs = document.querySelectorAll('input[name="donation_kind"]');
            const paymentSection = document.getElementById('paymentMethodSection');
            const amountSection = document.getElementById('amountSection');
            const itemsSection = document.getElementById('itemsSection');
            const paymentInputs = document.querySelectorAll('input[name="payment_mode"]');
            const submitButton = document.getElementById('donationSubmitButton');
            const donationOptions = document.querySelectorAll('.donation-option');
            const paymentOptions = document.querySelectorAll('.payment-option');

            function refreshSelectionStyles(collection, selectedSelector, activeClasses, inactiveClasses) {
                collection.forEach(function (element) {
                    const input = element.querySelector(selectedSelector);
                    const indicator = element.querySelector('.donation-option-indicator');
                    const isChecked = input?.checked;

                    element.classList.remove(...inactiveClasses);
                    element.classList.remove(...activeClasses);
                    element.classList.add(...(isChecked ? activeClasses : inactiveClasses));

                    if (indicator) {
                        indicator.classList.toggle('bg-[#00563f]', isChecked);
                        indicator.classList.toggle('border-[#00563f]', isChecked);
                        indicator.classList.toggle('shadow-[0_0_0_5px_rgba(0,86,63,0.12)]', isChecked);
                    }
                });
            }

            function updateDonationForm() {
                const selectedKind = document.querySelector('input[name="donation_kind"]:checked')?.value ?? 'money';
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

                refreshSelectionStyles(
                    donationOptions,
                    'input[name="donation_kind"]',
                    ['border-[#00563f]', 'bg-[#ecf9f2]', 'shadow-[0_18px_35px_rgba(0,86,63,0.10)]'],
                    ['border-[#d5ddd9]', 'bg-white/70']
                );

                refreshSelectionStyles(
                    paymentOptions,
                    'input[name="payment_mode"]',
                    ['border-[#635bff]', 'bg-[#f5f4ff]', 'shadow-[0_18px_35px_rgba(99,91,255,0.12)]'],
                    ['border-[#d8e0dc]', 'bg-white']
                );
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
