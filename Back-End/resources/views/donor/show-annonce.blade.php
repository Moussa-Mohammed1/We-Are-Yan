<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>{{ $annonce->title }} - We Are Yan</title>
</head>
<body class="min-h-screen bg-[#f6f5f2] text-[#111111] font-sec">
    @php
        $urgencyClasses = match ($annonce->urgency) {
            'urgent' => 'bg-red-50 text-red-600 border-red-200',
            'critical' => 'bg-orange-50 text-orange-600 border-orange-200',
            default => 'bg-green-50 text-green-700 border-green-200',
        };

        $canChat = $annonce->beneficiary && $annonce->beneficiary->id !== $user->id;
    @endphp

    <main class="max-w-6xl mx-auto px-6 py-8">
        <header class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ url('/') }}" class="inline-flex items-center">
                <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-14 object-contain">
            </a>

            <div class="flex gap-3">
                <a href="{{ route('dashboard') }}" class="rounded-full border border-[#d8d8d8] bg-white px-5 py-3 font-semibold hover:bg-[#f3f3f3]">
                    Back
                </a>
                <a href="{{ route('profile.edit') }}" class="rounded-full bg-[#00563f] px-5 py-3 font-semibold text-white hover:bg-[#004734]">
                    Profile
                </a>
            </div>
        </header>

        <section class="mb-6 rounded-[28px] bg-[#00563f] px-6 py-7 text-white md:px-8">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-white/70">Annonce Details</p>
                    <h1 class="mt-3 max-w-3xl text-4xl font-bold leading-tight md:text-5xl">
                        {{ $annonce->title }}
                    </h1>
                </div>

                <div class="flex flex-wrap gap-3">
                    <span class="rounded-full border px-4 py-2 text-sm font-bold uppercase {{ $urgencyClasses }}">
                        {{ $annonce->urgency }}
                    </span>
                    <span class="rounded-full bg-white px-4 py-2 text-sm font-bold text-[#00563f]">
                        {{ $annonce->category }}
                    </span>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_380px]">
            <div class="space-y-6">
                <section class="grid grid-cols-1 overflow-hidden rounded-[28px] border border-[#e7e3db] bg-white shadow-sm md:grid-cols-[1fr_1fr]">
                    <div class="bg-[#eef6f3]">
                        @if ($annonce->image)
                            <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="h-full min-h-[320px] w-full object-cover">
                        @else
                            <div class="flex min-h-[320px] items-center justify-center text-2xl font-bold text-[#007b67]">
                                No Image
                            </div>
                        @endif
                    </div>

                    <div class="p-6 md:p-8">
                        <p class="text-sm font-bold uppercase tracking-[0.16em] text-[#8a8a8a]">Description</p>
                        <p class="mt-4 text-[16px] leading-8 text-[#5f5f5f]">
                            {{ $annonce->description }}
                        </p>

                        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="rounded-[20px] bg-[#f7f6f2] p-5">
                                <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#8a8a8a]">City</p>
                                <p class="mt-2 text-xl font-bold">{{ $annonce->city }}</p>
                            </div>

                            <div class="rounded-[20px] bg-[#f7f6f2] p-5">
                                <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#8a8a8a]">Quantity</p>
                                <p class="mt-2 text-xl font-bold">{{ $annonce->quantity ?? 'Not set' }}</p>
                            </div>

                            <div class="rounded-[20px] bg-[#f7f6f2] p-5 sm:col-span-2">
                                <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#8a8a8a]">Posted</p>
                                <p class="mt-2 text-xl font-bold">{{ $annonce->created_at?->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-[28px] border border-[#e7e3db] bg-white p-6 shadow-sm">
                    <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-[0.16em] text-[#8a8a8a]">Map</p>
                            <h2 class="mt-1 text-2xl font-bold">{{ $annonce->city }}</h2>
                        </div>
                        <span class="w-fit rounded-full bg-[#eef8f4] px-4 py-2 text-sm font-bold text-[#007b67]">Morocco</span>
                    </div>

                    <div class="h-[320px] overflow-hidden rounded-[22px] border border-[#d8d8d8]">
                        <iframe
                            title="Annonce location"
                            class="h-full w-full"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q={{ urlencode($annonce->city . ', Morocco') }}&output=embed">
                        </iframe>
                    </div>
                </section>
            </div>

            <aside class="space-y-6 lg:sticky lg:top-8">
                <section class="rounded-[28px] border border-[#e7e3db] bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold uppercase tracking-[0.16em] text-[#8a8a8a]">Beneficiary</p>
                    <div class="mt-5 flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-[#00563f] text-xl font-bold text-white">
                            {{ strtoupper(substr($annonce->beneficiary?->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">{{ $annonce->beneficiary?->name ?? 'Unknown user' }}</h2>
                            <p class="mt-1 text-sm text-[#666]">{{ $annonce->beneficiary?->city ?? $annonce->city }}</p>
                        </div>
                    </div>

                    <div class="mt-6 rounded-[20px] bg-[#f7f6f2] p-4">
                        <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#8a8a8a]">Email</p>
                        <p class="mt-2 break-all text-sm font-semibold">{{ $annonce->beneficiary?->email ?? 'Not available' }}</p>
                    </div>
                </section>

                <section class="rounded-[28px] border border-[#00563f] bg-white p-6 shadow-sm">
                    <p class="text-sm font-bold uppercase tracking-[0.16em] text-[#00563f]">Support</p>
                    <h2 class="mt-3 text-2xl font-bold">How do you want to help?</h2>
                    <p class="mt-3 text-sm leading-7 text-[#666]">
                        Choose chat if you need more details, or donate directly if you are ready.
                    </p>

                    <div class="mt-6 flex flex-col gap-3">
                        @if ($canChat)
                            <a href="{{ route('chat.start', $annonce) }}" class="rounded-full border border-[#00563f] px-6 py-4 text-center font-bold text-[#00563f] hover:bg-[#eef8f4]">
                                Chat With Beneficiary
                            </a>
                        @else
                            <span class="cursor-not-allowed rounded-full border border-[#d8d8d8] px-6 py-4 text-center font-bold text-[#999]">
                                Chat Unavailable
                            </span>
                        @endif

                        <a href="{{ route('annonces.donate', $annonce) }}" class="rounded-full bg-[#00563f] px-6 py-4 text-center font-bold text-white hover:bg-[#004734]">
                            Donate Now
                        </a>
                    </div>
                </section>
            </aside>
        </section>
    </main>
</body>
</html>
