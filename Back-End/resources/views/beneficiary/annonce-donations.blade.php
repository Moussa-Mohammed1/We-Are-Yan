<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>Annonce Donations - {{ $annonce->title }}</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen">
    <main class="mx-auto max-w-6xl px-5 py-8 md:px-8">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <a href="{{ route('beneficiary.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#00563f]">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back to dashboard
                </a>
                <p class="mt-6 text-sm font-semibold uppercase tracking-[0.18em] text-[#8ca097]">Beneficiary / Donations</p>
                <h1 class="mt-3 text-3xl font-extrabold leading-tight md:text-4xl">{{ $annonce->title }}</h1>
                <p class="mt-3 max-w-[760px] text-sm leading-7 text-[#6a6f6b]">
                    Track how much support this annonce received from donors.
                </p>
            </div>

            <a href="{{ route('edit.form', $annonce) }}" class="inline-flex items-center justify-center rounded-full border border-[#00563f] px-5 py-3 text-sm font-semibold text-[#00563f] transition hover:bg-[#00563f] hover:text-white">
                Edit Annonce
            </a>
        </header>

        <section class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-3">
            <div class="rounded-[28px] border border-[#ece6d8] bg-[#fffaf1] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#a98b45]">Paid Total</p>
                <p class="mt-4 text-4xl font-extrabold text-[#2b2313]">{{ number_format((float) $paidTotal, 2) }} <span class="text-2xl">MAD</span></p>
                <p class="mt-3 text-sm leading-6 text-[#81745c]">Validated Stripe payments only.</p>
            </div>

            <div class="rounded-[28px] border border-[#d7eadf] bg-[#e7f6ef] p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#669886]">Paid Donations</p>
                <p class="mt-4 text-4xl font-extrabold text-[#14604b]">{{ $paidCount }}</p>
                <p class="mt-3 text-sm leading-6 text-[#5d7f71]">Money donations confirmed as paid.</p>
            </div>

            <div class="rounded-[28px] border border-[#e5ebe7] bg-white p-6 shadow-sm">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#8fa198]">All Records</p>
                <p class="mt-4 text-4xl font-extrabold text-[#111111]">{{ $donations->count() }}</p>
                <p class="mt-3 text-sm leading-6 text-[#747b77]">Money, item, chat, pending, and cancelled records.</p>
            </div>
        </section>

        <section class="mt-8 rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-sm md:p-7">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#8fa198]">Donation Details</p>
                    <h2 class="mt-2 text-3xl font-extrabold">Donors For This Annonce</h2>
                </div>
                <span class="inline-flex rounded-full bg-[#e7f6ef] px-4 py-2 text-sm font-semibold text-[#11624c]">
                    {{ $annonce->status === 'approved' ? 'accepted' : $annonce->status }}
                </span>
            </div>

            <div class="mt-7 overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-[#ece9e2] text-[11px] uppercase tracking-[0.14em] text-[#99a59f]">
                            <th class="pb-3 pr-4 font-semibold">Donor</th>
                            <th class="pb-3 pr-4 font-semibold">Type</th>
                            <th class="pb-3 pr-4 font-semibold">Method</th>
                            <th class="pb-3 pr-4 font-semibold">Amount / Items</th>
                            <th class="pb-3 pr-4 font-semibold">Status</th>
                            <th class="pb-3 font-semibold">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donations as $donation)
                            @php
                                $statusClasses = match ($donation->status) {
                                    'paid' => 'bg-[#e7f6ef] text-[#11624c]',
                                    'cancelled', 'stripe_failed' => 'bg-[#fff1ee] text-[#c75e43]',
                                    default => 'bg-[#fff4df] text-[#b77411]',
                                };
                            @endphp
                            <tr class="border-b border-[#f0eee8] text-sm text-[#4b4f4d] last:border-b-0">
                                <td class="py-4 pr-4">
                                    <p class="font-semibold text-[#181818]">{{ $donation->donor_name ?? $donation->donor?->name ?? 'Unknown donor' }}</p>
                                    <p class="mt-1 text-xs text-[#727875]">{{ $donation->donor_email ?? $donation->donor?->email ?? 'No email' }}</p>
                                </td>
                                <td class="py-4 pr-4">{{ ucfirst($donation->type) }}</td>
                                <td class="py-4 pr-4">{{ $donation->method ? ucfirst($donation->method) : 'Not set' }}</td>
                                <td class="py-4 pr-4 font-semibold">
                                    @if ($donation->type === 'money')
                                        {{ number_format((float) $donation->amount_or_qty, 2) }} MAD
                                    @else
                                        {{ $donation->amount_or_qty }}
                                    @endif
                                </td>
                                <td class="py-4 pr-4">
                                    <span class="inline-flex rounded-full px-3 py-1 text-[11px] font-bold uppercase {{ $statusClasses }}">
                                        {{ str_replace('_', ' ', $donation->status) }}
                                    </span>
                                </td>
                                <td class="py-4">{{ $donation->created_at?->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-sm text-[#727875]">
                                    No donations for this annonce yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
