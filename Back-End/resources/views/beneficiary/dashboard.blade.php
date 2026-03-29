<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    <title>We Are Yan - Beneficiary Dashboard</title>
</head>
<body class="bg-[#f6f5f2] text-[#111111] font-sec min-h-screen">
    @php
        $pendingCount = $annonces->where('status', 'pending')->count();
        $approvedCount = $annonces->where('status', 'approved')->count();
        $urgentCount = $annonces->whereIn('urgency', ['urgent', 'critical'])->count();
    @endphp

    <header class="w-full px-8 md:px-14 lg:px-20 pt-8">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
            </a>

            <div class="flex items-center gap-3 flex-wrap">
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center px-5 py-3 rounded-full border border-[#d8d8d8] bg-white text-[#111] font-semibold hover:bg-[#f3f3f3] transition">
                    Edit Profile
                </a>
                <a href="{{ route('donor.form') }}"
                   class="inline-flex items-center px-5 py-3 rounded-full bg-[#007b67] text-white font-semibold hover:bg-[#006554] transition">
                    New Request
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-5 py-3 rounded-full border border-[#007b67] text-[#007b67] font-semibold hover:bg-[#e7f6f1] transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="px-8 md:px-14 lg:px-20 pt-10 pb-20">
        <section class="grid grid-cols-1 xl:grid-cols-[1.2fr_0.8fr] gap-8 items-stretch">
            <div class="bg-[#00563f] text-white rounded-[36px] p-8 md:p-10 shadow-[0_14px_30px_rgba(0,0,0,0.10)]">
                <p class="uppercase tracking-[0.22em] text-sm text-white/70 font-semibold">Beneficiary Space</p>
                <h1 class="mt-4 text-4xl md:text-6xl leading-[1.02] font-bold max-w-[760px]">
                    Manage your requests and follow the support coming from donors.
                </h1>
                <p class="mt-6 text-white/80 text-[15px] leading-7 max-w-[620px]">
                    This dashboard helps you track every annonce you created, check its status, and quickly post a new request when your situation changes.
                </p>

                <div class="mt-8 flex flex-wrap gap-3 text-sm">
                    <span class="px-4 py-2 rounded-full bg-white/10">Name: {{ $user->name }}</span>
                    <span class="px-4 py-2 rounded-full bg-white/10">Role: {{ ucfirst($user->role) }}</span>
                    <span class="px-4 py-2 rounded-full bg-white/10">City: {{ $user->city ?: 'Not set' }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <div class="bg-white border border-[#dfdfdf] rounded-[28px] p-6 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.18em] text-[#8a8a8a] font-semibold">Total Requests</p>
                    <p class="mt-4 text-4xl font-bold text-[#007b67]">{{ $annonces->count() }}</p>
                </div>

                <div class="bg-white border border-[#dfdfdf] rounded-[28px] p-6 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.18em] text-[#8a8a8a] font-semibold">Pending Review</p>
                    <p class="mt-4 text-4xl font-bold text-[#d97706]">{{ $pendingCount }}</p>
                </div>

                <div class="bg-white border border-[#dfdfdf] rounded-[28px] p-6 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.18em] text-[#8a8a8a] font-semibold">Urgent Requests</p>
                    <p class="mt-4 text-4xl font-bold text-[#dc2626]">{{ $urgentCount }}</p>
                </div>

                <div class="bg-white border border-[#dfdfdf] rounded-[28px] p-6 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.18em] text-[#8a8a8a] font-semibold">Approved</p>
                    <p class="mt-4 text-4xl font-bold text-[#059669]">{{ $approvedCount }}</p>
                </div>
            </div>
        </section>

        <section class="mt-10 bg-white border border-[#dfdfdf] rounded-[32px] p-8 shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div>
                    <p class="text-sm uppercase tracking-[0.16em] text-[#8a8a8a] font-semibold">My Annonces</p>
                    <h2 class="mt-2 text-3xl font-bold">Requests you posted for support</h2>
                </div>

                <a href="{{ route('donor.form') }}"
                   class="inline-flex items-center px-6 py-3 rounded-full bg-[#007b67] text-white font-semibold hover:bg-[#006554] transition">
                    Create Another Request
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @forelse ($annonces as $annonce)
                    @php
                        $statusClasses = match ($annonce->status) {
                            'approved' => 'bg-green-50 text-green-700 border-green-200',
                            'rejected' => 'bg-red-50 text-red-700 border-red-200',
                            default => 'bg-amber-50 text-amber-700 border-amber-200',
                        };

                        $urgencyClasses = match ($annonce->urgency) {
                            'critical' => 'bg-red-50 text-red-700',
                            'urgent' => 'bg-orange-50 text-orange-700',
                            default => 'bg-green-50 text-green-700',
                        };
                    @endphp

                    <article class="bg-[#fcfbf8] border border-[#e7e3db] rounded-[28px] overflow-hidden shadow-[0_10px_25px_rgba(0,0,0,0.03)]">
                        @if ($annonce->image)
                            <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="h-48 bg-[#eef6f3] flex items-center justify-center text-[#007b67] text-lg font-bold">
                                Request Preview
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center justify-between gap-3 flex-wrap mb-4">
                                <span class="text-[12px] uppercase tracking-[0.16em] text-[#007b67] font-bold">
                                    {{ $annonce->category }}
                                </span>
                                <span class="inline-flex px-3 py-1 rounded-full border text-[11px] font-semibold uppercase {{ $statusClasses }}">
                                    {{ $annonce->status }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold leading-tight">{{ $annonce->title }}</h3>
                            <p class="mt-3 text-[15px] text-[#666] leading-6">
                                {{ \Illuminate\Support\Str::limit($annonce->description, 120) }}
                            </p>

                            <div class="mt-5 space-y-2 text-sm text-[#666]">
                                <p><span class="font-semibold text-[#111]">City:</span> {{ $annonce->city }}</p>
                                <p><span class="font-semibold text-[#111]">Quantity:</span> {{ $annonce->quantity ?? 'Not specified' }}</p>
                                <p><span class="font-semibold text-[#111]">Created:</span> {{ $annonce->created_at?->format('M d, Y') }}</p>
                            </div>

                            <div class="mt-5 flex items-center justify-between gap-3">
                                <span class="inline-flex px-3 py-1 rounded-full text-[11px] font-semibold uppercase {{ $urgencyClasses }}">
                                    {{ $annonce->urgency }}
                                </span>
                                <span class="text-xs text-[#8a8a8a]">{{ $annonce->created_at?->diffForHumans() }}</span>
                            </div>

                            @if ($annonce->status === 'rejected' && $annonce->rejection_reason)
                                <div class="mt-5 rounded-[18px] bg-red-50 border border-red-100 p-4 text-sm text-red-700">
                                    <span class="font-semibold">Reason:</span> {{ $annonce->rejection_reason }}
                                </div>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 rounded-[28px] border border-dashed border-[#cfc7b8] bg-[#fbfaf7] px-8 py-16 text-center">
                        <h3 class="text-2xl font-bold text-[#111]">No requests yet</h3>
                        <p class="mt-3 text-[#666] max-w-[520px] mx-auto leading-7">
                            You have not created any annonce yet. Start by sharing what you need, and our team will review it before it appears to donors.
                        </p>
                        <a href="{{ route('donor.form') }}"
                           class="inline-flex mt-6 items-center px-6 py-3 rounded-full bg-[#007b67] text-white font-semibold hover:bg-[#006554] transition">
                            Create Your First Request
                        </a>
                    </div>
                @endforelse
            </div>
        </section>
    </main>
</body>
</html>
