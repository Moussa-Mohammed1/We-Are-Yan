<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/style.css'])
    <title>We Are Yan - Beneficiary Dashboard</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen">
    @php
        $pendingCount = $annonces->where('status', 'pending')->count();
        $latestAnnonce = $annonces->first();
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

            <div class="xl:sticky xl:top-6">
                <nav class="mt-8 space-y-2">
                    <a href="{{ route('beneficiary.dashboard') }}"
                       class="flex items-center gap-3 rounded-2xl bg-[#00563f] px-4 py-3 text-sm font-semibold text-white shadow-[0_10px_20px_rgba(0,86,63,0.18)]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/12">
                            <i class="fa-solid fa-house text-sm"></i>
                        </span>
                        Dashboard
                    </a>

                    <a href="{{ route('donor.form') }}"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </span>
                        Create Request
                    </a>

                    <a href="#requests"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <i class="fa-solid fa-list text-sm"></i>
                        </span>
                        My Requests
                    </a>

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <i class="fa-solid fa-user-gear text-sm"></i>
                        </span>
                        Profile Settings
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#fff1ee] text-[#d26c52]">
                                <i class="fa-solid fa-right-from-bracket text-sm"></i>
                            </span>
                            Logout
                        </button>
                    </form>
                </nav>

                <div class="mt-10 rounded-[28px] border border-[#dce9e3] bg-[#e7f6ef] p-5">
                    <p class="text-[13px] font-bold text-[#0f3d31]">Your requests matter</p>
                    <p class="mt-2 text-[10px] text-[#55736a]">
                        Share your needs clearly so donors can respond faster and help the right people at the right time.
                    </p>
                </div>
            </div>
        </aside>

        <main class="px-5 py-6 md:px-8 lg:px-10 xl:px-12 xl:py-8">
            <header class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#8ca097]">Dashboard / Beneficiary Space</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight md:text-4xl">
                        Welcome back, <span class="border-b-2 border-[#00563f]">{{ $user->name }}</span>
                    </h1>
                    <p class="mt-3 max-w-[760px] text-[11px] leading-7 text-[#6a6f6b]">
                        Track your requests, review their status, and keep your profile ready so support can reach you quickly.
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <label class="relative block">
                        <span class="absolute inset-y-0 left-4 flex items-center text-[#94a39d]">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
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

            <section class="mt-8">
                <div class="rounded-[30px] bg-[#00563f] p-7 text-white shadow-[0_18px_40px_rgba(0,86,63,0.18)] md:p-9">
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-white/65">A Message For You</p>
                    <h2 class="mt-4 max-w-[560px] text-3xl font-extrabold leading-tight md:text-[30px]">
                        Every request you share matters, and each clear detail brings you closer to the right support.
                    </h2>
                    <p class="mt-4 max-w-[580px] text-[15px] leading-7 text-white/80">
                        Keep going, your need deserves to be seen and supported.
                    </p>
                </div>
            </section>

            <section class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                <div class="relative overflow-hidden rounded-[30px] border border-[#e5ebe7] bg-white p-6 shadow-[0_14px_30px_rgba(0,0,0,0.04)]">
                    <div class="absolute right-0 top-0 h-28 w-28 rounded-full bg-[#eef8f4] blur-2xl"></div>
                    <div class="relative flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-[#8fa198]">Total Requests</p>
                            <p class="mt-4 text-4xl font-extrabold text-[#111111]">{{ $totalAnnonces }}</p>
                            <p class="mt-3 max-w-[220px] text-sm leading-6 text-[#747b77]">All annonces you created from your beneficiary dashboard.</p>
                        </div>
                        <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-[#eef8f4] text-[#00563f]">
                            <i class="fa-solid fa-list-ul text-[24px]"></i>
                        </span>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[30px] border border-[#ece6d8] bg-[#fffaf1] p-6 shadow-[0_14px_30px_rgba(0,0,0,0.04)]">
                    <div class="absolute right-0 top-0 h-28 w-28 rounded-full bg-[#fff0cc] blur-2xl"></div>
                    <div class="relative flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-[#a98b45]">Total Collected</p>
                            <p class="mt-4 text-4xl font-extrabold text-[#2b2313]">{{ $totalCollected }} <span class="text-2xl">MAD</span></p>
                            <p class="mt-3 max-w-[220px] text-sm leading-6 text-[#81745c]">This amount will update once donation payments are saved in the system.</p>
                        </div>
                        <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-[#fff0cc] text-[#b07b00]">
                            <i class="fa-solid fa-hand-holding-dollar text-[24px]"></i>
                        </span>
                    </div>
                </div>

                <div class="relative overflow-hidden rounded-[30px] border border-[#d7eadf] bg-[#e7f6ef] p-6 shadow-[0_14px_30px_rgba(0,0,0,0.04)]">
                    <div class="absolute right-0 top-0 h-28 w-28 rounded-full bg-white/40 blur-2xl"></div>
                    <div class="relative flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.18em] text-[#669886]">Pending Requests</p>
                            <p class="mt-4 text-4xl font-extrabold text-[#14604b]">{{ $pendingCount }}</p>
                            <p class="mt-3 max-w-[220px] text-sm leading-6 text-[#5d7f71]">These annonces are still waiting for review and approval.</p>
                        </div>
                        <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white/70 text-[#14604b]">
                            <i class="fa-regular fa-clock text-[24px]"></i>
                        </span>
                    </div>
                </div>
            </section>

            <section class="mt-6">
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
                                        <i class="fa-regular fa-image text-4xl"></i>
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

                                    <div class="mt-5 flex gap-3 justify-end">
                                        <a href="{{route('edit.form', $annonce)}}">
                                            <button type="button"
                                               class="inline-flex items-center justify-center rounded-full border border-[#00563f] px-4 py-2 text-sm font-semibold text-[#00563f] transition hover:bg-[#00563f] hover:text-white">
                                                Edit Annonce
                                            </button>
                                        </a>

                                        <button type="button"
                                           class="inline-flex items-center justify-center rounded-full border border-[#c75e43] px-4 py-2 text-sm font-semibold text-[#c75e43] transition hover:bg-[#c75e43] hover:text-white">
                                            Delete Annonce
                                        </button>
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

            </section>

            <section class="mt-6">
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
