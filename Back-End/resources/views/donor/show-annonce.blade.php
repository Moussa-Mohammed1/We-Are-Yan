<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>{{ $annonce->title }} - We Are Yan</title>
</head>
<body class="bg-[#f6f5f2] text-[#111111] font-sec min-h-screen">
    @php
        $urgencyClasses = match ($annonce->urgency) {
            'urgent' => 'bg-red-50 text-red-600 border-red-200',
            'critical' => 'bg-orange-50 text-orange-600 border-orange-200',
            default => 'bg-green-50 text-green-600 border-green-200',
        };

        $canChat = $annonce->beneficiary && $annonce->beneficiary->id !== $user->id;
    @endphp

    <section class="px-6 py-8 md:px-10 lg:px-16">
        <div class="max-w-[1320px] mx-auto">
            <div class="flex items-center justify-between gap-4 mb-10">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </a>

                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}"
                       class="hidden md:inline-flex items-center px-5 py-3 rounded-full border border-[#d8d8d8] bg-white text-[#111] font-semibold hover:bg-[#f3f3f3] transition">
                        Back
                    </a>
                    <a href="{{ route('profile.edit') }}"
                       class="hidden md:inline-flex items-center px-5 py-3 rounded-full bg-[#00563f] text-white font-semibold hover:bg-[#004734] transition">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-[1.25fr_0.75fr] gap-8 items-start">
                <div class="bg-white border border-[#e7e3db] rounded-[36px] p-6 md:p-8 shadow-[0_14px_35px_rgba(0,0,0,0.05)] space-y-8">
                    @if ($annonce->image)
                        <div class="overflow-hidden rounded-[28px] border border-[#e7e3db] shadow-[0_12px_30px_rgba(0,0,0,0.08)]">
                            <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="w-full h-[240px] md:h-[320px] object-cover">
                        </div>
                    @else
                        <div class="h-[240px] md:h-[320px] rounded-[28px] border border-[#dbe8e2] bg-[#eef6f3] flex items-center justify-center text-[#007b67] text-2xl font-bold">
                            No Image
                        </div>
                    @endif

                    <div>
                        <div class="flex flex-wrap items-center gap-3 mb-5">
                            <span class="inline-flex px-4 py-2 rounded-full border text-sm font-semibold uppercase {{ $urgencyClasses }}">
                                {{ $annonce->urgency }}
                            </span>
                            <span class="inline-flex px-4 py-2 rounded-full bg-[#eef8f4] text-[#007b67] text-sm font-semibold">
                                {{ $annonce->category }}
                            </span>
                            <span class="text-sm text-[#8a8a8a]">{{ $annonce->created_at?->diffForHumans() }}</span>
                        </div>

                        <h1 class="text-4xl md:text-5xl leading-[1.05] font-bold">
                            {{ $annonce->title }}
                        </h1>
                    </div>

                    <div class="bg-[#faf8f3] border border-[#ece7dc] rounded-[28px] p-6 md:p-8">
                        <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Annonce Information</p>
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-[22px] bg-white border border-[#ece7dc] p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">City</p>
                                <p class="mt-3 text-xl font-bold">{{ $annonce->city }}</p>
                            </div>
                            <div class="rounded-[22px] bg-white border border-[#ece7dc] p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">Quantity</p>
                                <p class="mt-3 text-xl font-bold">{{ $annonce->quantity ?? 'Not specified' }}</p>
                            </div>
                            <div class="rounded-[22px] bg-white border border-[#ece7dc] p-5 sm:col-span-2">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">Description</p>
                                <p class="mt-3 text-[16px] text-[#5f5f5f] leading-8">{{ $annonce->description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#e7e3db] rounded-[28px] p-6 md:p-8">
                        <div class="flex items-center justify-between gap-4 flex-wrap">
                            <div>
                                <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Map</p>
                                <h2 class="mt-2 text-2xl font-bold">Location</h2>
                            </div>
                            <span class="inline-flex px-4 py-2 rounded-full bg-[#eef8f4] text-[#007b67] text-sm font-semibold">
                                {{ $annonce->city }}
                            </span>
                        </div>

                        <div class="mt-6 rounded-[24px] overflow-hidden border border-[#d8d8d8] h-[340px]">
                            <iframe
                                title="Annonce location"
                                class="w-full h-full"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps?q={{ urlencode($annonce->city . ', Morocco') }}&output=embed">
                            </iframe>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-[#0f172a] text-white rounded-[36px] p-6 md:p-8 shadow-[0_14px_30px_rgba(0,0,0,0.10)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-white/60 font-semibold">Beneficiary</p>
                        <h2 class="mt-3 text-3xl font-bold leading-tight">
                            {{ $annonce->beneficiary?->name ?? 'Unknown user' }}
                        </h2>

                        <div class="mt-8 space-y-4">
                            <div class="rounded-[22px] bg-white/5 border border-white/10 p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-white/50 font-semibold">Email</p>
                                <p class="mt-3 text-lg font-bold break-all">{{ $annonce->beneficiary?->email ?? 'Not available' }}</p>
                            </div>
                            <div class="rounded-[22px] bg-white/5 border border-white/10 p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-white/50 font-semibold">City</p>
                                <p class="mt-3 text-lg font-bold">{{ $annonce->beneficiary?->city ?? $annonce->city }}</p>
                            </div>
                            <div class="rounded-[22px] bg-white/5 border border-white/10 p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-white/50 font-semibold">Created</p>
                                <p class="mt-3 text-lg font-bold">{{ $annonce->created_at?->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#00563f] text-white rounded-[36px] p-6 md:p-8 shadow-[0_14px_30px_rgba(0,0,0,0.10)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-white/70 font-semibold">Actions</p>
                        <h2 class="mt-3 text-3xl font-bold leading-tight">Contact and support now.</h2>

                        <div class="mt-8 flex flex-col gap-4">
                            @if ($canChat)
                                <a href="{{ route('chat.start', $annonce) }}"
                                   class="inline-flex items-center justify-center px-6 py-4 rounded-full border border-white/20 bg-white/10 text-white font-bold hover:bg-white/20 transition">
                                    Chat With Beneficiary
                                </a>
                            @else
                                <span
                                    class="inline-flex items-center justify-center px-6 py-4 rounded-full border border-white/10 bg-white/5 text-white/60 font-bold cursor-not-allowed">
                                    Chat Unavailable
                                </span>
                            @endif

                            <a href="{{ route('annonces.donate', $annonce) }}"
                               class="inline-flex items-center justify-center px-6 py-4 rounded-full bg-white text-[#00563f] font-bold hover:bg-[#f0f7f4] transition">
                                Donate Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
