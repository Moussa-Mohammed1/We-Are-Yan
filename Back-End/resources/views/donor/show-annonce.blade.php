<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    <title>{{ $annonce->title }} - We Are Yan</title>
</head>
<body class="bg-[#f6f5f2] text-[#111111] font-sec min-h-screen">
    @php
        $urgencyClasses = match ($annonce->urgency) {
            'urgent' => 'bg-red-50 text-red-600 border-red-200',
            'critical' => 'bg-orange-50 text-orange-600 border-orange-200',
            default => 'bg-green-50 text-green-600 border-green-200',
        };
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

            <div class="grid grid-cols-1 xl:grid-cols-[1.15fr_0.85fr] gap-8">
                <div class="space-y-8">
                    <div class="bg-white border border-[#e7e3db] rounded-[32px] p-6 md:p-8 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <span class="inline-flex px-4 py-2 rounded-full border text-sm font-semibold uppercase {{ $urgencyClasses }}">
                                {{ $annonce->urgency }}
                            </span>
                            <span class="inline-flex px-4 py-2 rounded-full bg-[#eef8f4] text-[#007b67] text-sm font-semibold">
                                {{ $annonce->category }}
                            </span>
                            <span class="text-sm text-[#8a8a8a]">{{ $annonce->created_at?->diffForHumans() }}</span>
                        </div>

                        <h1 class="text-4xl md:text-5xl leading-[1.05] font-bold max-w-[760px]">
                            {{ $annonce->title }}
                        </h1>

                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="rounded-[24px] bg-[#faf8f3] border border-[#ece7dc] p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">City</p>
                                <p class="mt-3 text-xl font-bold">{{ $annonce->city }}</p>
                            </div>
                            <div class="rounded-[24px] bg-[#faf8f3] border border-[#ece7dc] p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">Quantity</p>
                                <p class="mt-3 text-xl font-bold">{{ $annonce->quantity ?? 'Not specified' }}</p>
                            </div>
                            <div class="rounded-[24px] bg-[#faf8f3] border border-[#ece7dc] p-5">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#8a8a8a] font-semibold">Posted By</p>
                                <p class="mt-3 text-xl font-bold">{{ $annonce->beneficiary?->name ?? 'Unknown user' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#e7e3db] rounded-[32px] overflow-hidden shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                        @if ($annonce->image)
                            <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="w-full h-[420px] object-cover">
                        @else
                            <div class="h-[420px] bg-[#eef6f3] flex items-center justify-center text-[#007b67] text-2xl font-bold">
                                No Image
                            </div>
                        @endif
                    </div>

                    <div class="bg-white border border-[#e7e3db] rounded-[32px] p-6 md:p-8 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Description</p>
                        <div class="mt-5 text-[16px] text-[#5f5f5f] leading-8">
                            {{ $annonce->description }}
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-[#0f172a] text-white rounded-[32px] p-6 md:p-8 shadow-[0_14px_30px_rgba(0,0,0,0.10)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-white/60 font-semibold">Quick View</p>
                        <h2 class="mt-3 text-3xl font-bold leading-tight">
                            A clear look at this annonce.
                        </h2>
                        <p class="mt-4 text-white/75 leading-7">
                            Review the main need, its location, and the person who posted it in one simple view.
                        </p>
                    </div>

                    <div class="bg-white border border-[#e7e3db] rounded-[32px] p-6 md:p-8 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                        <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">Details</p>
                        <div class="mt-6 space-y-4">
                            <div class="flex items-center justify-between gap-4 py-3 border-b border-[#ece7dc]">
                                <span class="text-[#777]">Category</span>
                                <span class="font-bold">{{ $annonce->category }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-3 border-b border-[#ece7dc]">
                                <span class="text-[#777]">Urgency</span>
                                <span class="font-bold">{{ ucfirst($annonce->urgency) }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-3 border-b border-[#ece7dc]">
                                <span class="text-[#777]">Created</span>
                                <span class="font-bold">{{ $annonce->created_at?->format('M d, Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-4 py-3">
                                <span class="text-[#777]">Poster Email</span>
                                <span class="font-bold text-right">{{ $annonce->beneficiary?->email ?? 'Not available' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-[#e7e3db] rounded-[32px] p-6 md:p-8 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
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
            </div>
        </div>
    </section>
</body>
</html>
