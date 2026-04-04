<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    <title>We Are Yan - Beneficiary Dashboard</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen">
    @php
        $pendingCount = $annonces->where('status', 'pending')->count();
        $approvedCount = $annonces->where('status', 'approved')->count();
        $rejectedCount = $annonces->where('status', 'rejected')->count();
        $urgentCount = $annonces->whereIn('urgency', ['urgent', 'critical'])->count();
        $latestAnnonce = $annonces->first();
        $recentItems = $annonces->take(3);
        $totalAnnonces = $annonces->count();
        $totalCollected = 0;
    @endphp

    <div class="min-h-screen xl:grid xl:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="border-b xl:border-b-0 xl:border-r border-[#e6e4dc] bg-[#fbfbf8] px-6 py-8 xl:px-7">
            <div class="flex items-center justify-between xl:block">
                <a href="{{ url('/') }}" class="inline-flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </a>

                <a href="{{ route('donor.form') }}"
                   class="xl:hidden inline-flex items-center rounded-full bg-[#00563f] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                    New Request
                </a>
            </div>

            <nav class="mt-8 space-y-2">
                <a href="{{ route('beneficiary.dashboard') }}"
                   class="flex items-center gap-3 rounded-2xl bg-[#00563f] px-4 py-3 text-sm font-semibold text-white shadow-[0_10px_20px_rgba(0,86,63,0.18)]">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12 12 4l9 8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10v10h14V10" />
                        </svg>
                    </span>
                    Dashboard
                </a>

                <a href="{{ route('donor.form') }}"
                   class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
                    </span>
                    Create Request
                </a>

                <a href="#requests"
                   class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10" />
                        </svg>
                    </span>
                    My Requests
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5a7.5 7.5 0 0 1 15 0" />
                        </svg>
                    </span>
                    Profile Settings
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#fff1ee] text-[#d26c52]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-7.5a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 6 21h7.5a2.25 2.25 0 0 0 2.25-2.25V15" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H9m0 0 3-3m-3 3 3 3" />
                            </svg>
                        </span>
                        Logout
                    </button>
                </form>
            </nav>

            <div class="mt-10 rounded-[28px] border border-[#dce9e3] bg-[#e7f6ef] p-5">
                <p class="text-sm font-bold text-[#0f3d31]">Your requests matter</p>
                <p class="mt-2 text-sm leading-6 text-[#55736a]">
                    Share your needs clearly so donors can respond faster and help the right people at the right time.
                </p>
            </div>
        </aside>

        <main class="px-5 py-6 md:px-8 lg:px-10 xl:px-12 xl:py-8">
            <header class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#8ca097]">Dashboard / Beneficiary Space</p>
                    <h1 class="mt-3 text-4xl font-extrabold leading-tight md:text-5xl">
                        Welcome back, {{ $user->name }}
                    </h1>
                    <p class="mt-3 max-w-[760px] text-[15px] leading-7 text-[#6a6f6b]">
                        Track your requests, review their status, and keep your profile ready so support can reach you quickly.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <label class="relative block">
                        <span class="absolute inset-y-0 left-4 flex items-center text-[#94a39d]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35" />
                                <circle cx="11" cy="11" r="6" />
                            </svg>
                        </span>
                        <input
                            type="text"
                            placeholder="Search requests..."
                            class="h-12 w-full rounded-full border border-[#e1e4de] bg-white pl-11 pr-4 text-sm outline-none transition placeholder:text-[#9aa7a1] focus:border-[#00563f] sm:w-[250px]"
                        >
                    </label>

                    <a href="{{ route('donor.form') }}"
                       class="inline-flex items-center justify-center rounded-full bg-[#00563f] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                        New Request
                    </a>
                </div>
            </header>

            <section class="mt-8 grid grid-cols-1 gap-6 2xl:grid-cols-[minmax(0,1.4fr)_360px]">
                <div class="rounded-[30px] bg-[#00563f] p-7 text-white shadow-[0_18px_40px_rgba(0,86,63,0.18)] md:p-9">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-white/65">Your Impact Overview</p>
                    <h2 class="mt-4 max-w-[560px] text-3xl font-extrabold leading-tight md:text-[42px]">
                        You have posted {{ $annonces->count() }} requests and {{ $approvedCount }} of them are already approved.
                    </h2>
                    <p class="mt-4 max-w-[580px] text-[15px] leading-7 text-white/80">
                        Keep updating your annonces with the right details so donors can understand your needs and respond with confidence.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="#requests"
                           class="inline-flex items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#00563f] transition hover:bg-[#f1f5f3]">
                            View My Requests
                        </a>
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/8 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/14">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="grid gap-6">
                    <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold">This Month</p>
                            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-[#8ea39a]">
                                {{ now()->format('F Y') }}
                            </span>
                        </div>

                        <div class="mt-5">
                            <p class="text-xs uppercase tracking-[0.16em] text-[#93a09a]">Approved Requests</p>
                            <p class="mt-2 text-4xl font-extrabold text-[#111]">{{ $approvedCount }}</p>
                        </div>

                        @php
                            $progress = $annonces->count() > 0 ? round(($approvedCount / $annonces->count()) * 100) : 0;
                        @endphp

                        <div class="mt-5">
                            <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.14em] text-[#93a09a]">
                                <span>Goal Progress</span>
                                <span>{{ $progress }}%</span>
                            </div>
                            <div class="mt-3 h-3 rounded-full bg-[#ecebe6]">
                                <div class="h-3 rounded-full bg-[#00563f]" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="rounded-[18px] bg-[#f7f7f4] p-4">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#9aa6a0]">Pending</p>
                                <p class="mt-2 text-2xl font-bold">{{ $pendingCount }}</p>
                            </div>
                            <div class="rounded-[18px] bg-[#f7f7f4] p-4">
                                <p class="text-xs uppercase tracking-[0.14em] text-[#9aa6a0]">Urgent</p>
                                <p class="mt-2 text-2xl font-bold">{{ $urgentCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-[30px] border border-[#d7eadf] bg-[#e7f6ef] p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#7ca08f]">Achievement</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-[#14604b]">
                            {{ $approvedCount > 0 ? 'Trusted Beneficiary' : 'Getting Started' }}
                        </h3>
                        <p class="mt-3 text-sm leading-6 text-[#5d7f71]">
                            {{ $approvedCount > 0 ? 'Your requests are being validated and reaching the community.' : 'Create your first strong request and start receiving support.' }}
                        </p>
                    </div>
                </div>
            </section>

            <section class="mt-6 grid grid-cols-1 gap-5 xl:grid-cols-3">
                <div class="rounded-[26px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.16em] text-[#96a29d]">Total Requests</p>
                    <p class="mt-3 text-4xl font-extrabold">{{ $annonces->count() }}</p>
                    <p class="mt-2 text-sm text-[#7b807d]">All annonces created from your beneficiary account.</p>
                </div>

                <div class="rounded-[26px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.16em] text-[#96a29d]">Latest Category</p>
                    <p class="mt-3 text-3xl font-extrabold">{{ $latestAnnonce?->category ?? 'No category yet' }}</p>
                    <p class="mt-2 text-sm text-[#7b807d]">Based on your most recent request.</p>
                </div>

                <div class="rounded-[26px] border border-[#d7eadf] bg-[#e7f6ef] p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                    <p class="text-xs uppercase tracking-[0.16em] text-[#96a29d]">Profile Status</p>
                    <p class="mt-3 text-3xl font-extrabold text-[#14604b]">{{ $user->city ? 'Complete' : 'Needs Update' }}</p>
                    <p class="mt-2 text-sm text-[#5d7f71]">
                        {{ $user->city ? 'Your account details look ready for new support requests.' : 'Add your city in profile settings for better request visibility.' }}
                    </p>
                </div>
            </section>

            <section class="mt-6 grid grid-cols-1 gap-6 2xl:grid-cols-[minmax(0,1.45fr)_360px]">
                <div id="requests" class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)] md:p-7">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#8fa198]">My Requests</p>
                            <h2 class="mt-2 text-3xl font-extrabold">Requests Posted For Support</h2>
                        </div>

                        <a href="{{ route('donor.form') }}"
                           class="inline-flex items-center justify-center rounded-full border border-[#dce4de] bg-[#f7f7f4] px-5 py-3 text-sm font-semibold text-[#111] transition hover:border-[#00563f] hover:text-[#00563f]">
                            Browse All
                        </a>
                    </div>

                    <div class="mt-7 grid grid-cols-1 gap-5 lg:grid-cols-2">
                        @forelse ($annonces->take(4) as $annonce)
                            @php
                                $statusClasses = match ($annonce->status) {
                                    'approved' => 'bg-[#e7f6ef] text-[#11624c]',
                                    'rejected' => 'bg-[#fff1ee] text-[#c75e43]',
                                    default => 'bg-[#fff4df] text-[#b77411]',
                                };

                                $urgencyClasses = match ($annonce->urgency) {
                                    'critical' => 'bg-[#fff1ee] text-[#c75e43]',
                                    'urgent' => 'bg-[#fff4df] text-[#b77411]',
                                    default => 'bg-[#e7f6ef] text-[#11624c]',
                                };
                            @endphp

                            <article class="overflow-hidden rounded-[24px] border border-[#ece9e2] bg-[#fcfcfa]">
                                @if ($annonce->image)
                                    <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="h-44 w-full object-cover">
                                @else
                                    <div class="flex h-44 items-center justify-center bg-[#efefec] text-[#7a807b]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8 13 2.5-2.5L14 14l2-2 3 3" />
                                            <circle cx="8.5" cy="9" r="1.2" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-5">
                                    <div class="flex items-center justify-between gap-3">
                                        <span class="inline-flex rounded-full bg-[#dff2ea] px-3 py-1 text-[11px] font-bold uppercase tracking-[0.14em] text-[#11624c]">
                                            {{ $annonce->category }}
                                        </span>
                                        <span class="inline-flex rounded-full px-3 py-1 text-[11px] font-bold uppercase {{ $statusClasses }}">
                                            {{ $annonce->status }}
                                        </span>
                                    </div>

                                    <h3 class="mt-4 text-xl font-extrabold leading-tight">{{ $annonce->title }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-[#727875]">
                                        {{ \Illuminate\Support\Str::limit($annonce->description, 110) }}
                                    </p>

                                    <div class="mt-5 flex items-center justify-between gap-3">
                                        <div>
                                            <p class="text-xs uppercase tracking-[0.16em] text-[#99a59f]">City</p>
                                            <p class="mt-1 text-sm font-semibold">{{ $annonce->city }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs uppercase tracking-[0.16em] text-[#99a59f]">Quantity</p>
                                            <p class="mt-1 text-sm font-semibold">{{ $annonce->quantity ?? 'Not set' }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-5 flex items-center justify-between gap-3">
                                        <span class="inline-flex rounded-full px-3 py-1 text-[11px] font-bold uppercase {{ $urgencyClasses }}">
                                            {{ $annonce->urgency }}
                                        </span>
                                        <span class="text-xs text-[#939c98]">{{ $annonce->created_at?->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="lg:col-span-2 rounded-[26px] border border-dashed border-[#d3d9d4] bg-[#fbfbf8] px-8 py-16 text-center">
                                <h3 class="text-2xl font-extrabold">No requests yet</h3>
                                <p class="mx-auto mt-3 max-w-[520px] text-sm leading-7 text-[#727875]">
                                    Start by creating your first request so donors can discover your needs and support your situation.
                                </p>
                                <a href="{{ route('donor.form') }}"
                                   class="mt-6 inline-flex items-center justify-center rounded-full bg-[#00563f] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                                    Create Your First Request
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-extrabold">Recent Activity</h2>
                        <span class="rounded-full bg-[#e7f6ef] px-3 py-1 text-[11px] font-bold uppercase tracking-[0.14em] text-[#11624c]">
                            Live
                        </span>
                    </div>

                    <div class="mt-6 space-y-4">
                        @forelse ($recentItems as $item)
                            <div class="flex gap-3 rounded-[22px] bg-[#f8f8f5] p-4">
                                <span class="mt-1 inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#e7f6ef] text-[#11624c]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                                    </svg>
                                </span>
                                <div>
                                    <p class="text-sm font-bold">
                                        {{ ucfirst($item->status) }} request: {{ \Illuminate\Support\Str::limit($item->title, 28) }}
                                    </p>
                                    <p class="mt-1 text-sm leading-6 text-[#717774]">
                                        {{ ucfirst($item->category) }} request in {{ $item->city }} with {{ $item->urgency }} urgency.
                                    </p>
                                    <p class="mt-2 text-xs text-[#98a29d]">{{ $item->created_at?->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-[22px] bg-[#f8f8f5] p-5 text-sm text-[#717774]">
                                Your recent activity will appear here after you create a request.
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="mt-6 grid grid-cols-1 gap-6 2xl:grid-cols-[460px_minmax(0,1fr)]">
                <div class="rounded-[30px] border border-[#d7eadf] bg-[#e7f6ef] p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                    <div class="flex items-start gap-4">
                        <div class="h-14 w-14 rounded-full bg-[#ff9b73]"></div>
                        <div>
                            <p class="text-3xl font-extrabold text-[#11543f]">Beneficiary Profile</p>
                            <p class="mt-1 text-sm text-[#648273]">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div class="rounded-[18px] bg-white px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.14em] text-[#93a09a]">Status</p>
                            <p class="mt-2 text-sm font-bold">Active Beneficiary</p>
                        </div>
                        <div class="rounded-[18px] bg-white px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.14em] text-[#93a09a]">City</p>
                            <p class="mt-2 text-sm font-bold">{{ $user->city ?: 'Not set' }}</p>
                        </div>
                        <div class="rounded-[18px] bg-white px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.14em] text-[#93a09a]">Main Need</p>
                            <p class="mt-2 text-sm font-bold">{{ $latestAnnonce?->category ?? 'No request yet' }}</p>
                        </div>
                        <div class="rounded-[18px] bg-white px-4 py-4">
                            <p class="text-xs uppercase tracking-[0.14em] text-[#93a09a]">Request Rhythm</p>
                            <p class="mt-2 text-sm font-bold">{{ $annonces->count() > 1 ? 'Ongoing' : 'Starting' }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center justify-center rounded-full bg-[#00563f] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                            Edit Profile
                        </a>
                        <a href="{{ route('donor.form') }}"
                           class="inline-flex items-center justify-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#00563f] transition hover:bg-[#f4fbf8]">
                            Create Request
                        </a>
                    </div>
                </div>

                <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)]">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-2xl font-extrabold">Request History</h2>
                            <p class="mt-1 text-sm text-[#727875]">Your latest beneficiary annonces</p>
                        </div>
                        <a href="#requests"
                           class="inline-flex items-center justify-center rounded-full border border-[#dce4de] bg-[#f7f7f4] px-5 py-3 text-sm font-semibold text-[#111] transition hover:border-[#00563f] hover:text-[#00563f]">
                            Full History
                        </a>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-[#ece9e2] text-[11px] uppercase tracking-[0.14em] text-[#99a59f]">
                                    <th class="pb-3 pr-4 font-semibold">Title</th>
                                    <th class="pb-3 pr-4 font-semibold">Category</th>
                                    <th class="pb-3 pr-4 font-semibold">Urgency</th>
                                    <th class="pb-3 pr-4 font-semibold">Date</th>
                                    <th class="pb-3 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($annonces->take(5) as $annonce)
                                    @php
                                        $tableStatusClasses = match ($annonce->status) {
                                            'approved' => 'bg-[#e7f6ef] text-[#11624c]',
                                            'rejected' => 'bg-[#fff1ee] text-[#c75e43]',
                                            default => 'bg-[#fff4df] text-[#b77411]',
                                        };
                                    @endphp
                                    <tr class="border-b border-[#f0eee8] text-sm text-[#4b4f4d] last:border-b-0">
                                        <td class="py-4 pr-4 font-semibold text-[#181818]">{{ \Illuminate\Support\Str::limit($annonce->title, 28) }}</td>
                                        <td class="py-4 pr-4">{{ $annonce->category }}</td>
                                        <td class="py-4 pr-4">{{ ucfirst($annonce->urgency) }}</td>
                                        <td class="py-4 pr-4">{{ $annonce->created_at?->format('d M Y') }}</td>
                                        <td class="py-4">
                                            <span class="inline-flex rounded-full px-3 py-1 text-[11px] font-bold uppercase {{ $tableStatusClasses }}">
                                                {{ $annonce->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-10 text-center text-sm text-[#727875]">
                                            No request history available yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
