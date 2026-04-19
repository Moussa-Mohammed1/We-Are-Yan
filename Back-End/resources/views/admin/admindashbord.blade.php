<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>Admin Dashboard - We Are Yan</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen">
    <div class="min-h-screen xl:grid xl:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="border-b xl:border-b-0 xl:border-r border-[#e6e4dc] bg-[#fbfbf8] px-6 py-8 xl:px-7">
            <div class="xl:sticky xl:top-6">
                <a href="{{ url('/') }}" class="inline-flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowryblue.png') }}" alt="Logo" class="h-16 object-contain">
                </a>

                <nav class="mt-8 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-2xl bg-[#2563eb] px-4 py-3 text-sm font-semibold text-white shadow-[0_10px_20px_rgba(0,86,63,0.18)]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/12">
                            <i class="fa-solid fa-chart-line text-sm"></i>
                        </span>
                        Admin Dashboard
                    </a>

                    <a href="#pending-annonces"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#475569] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eff6ff] text-[#2563eb]">
                            <i class="fa-solid fa-hourglass-half text-sm"></i>
                        </span>
                        Pending Annonces
                    </a>

                    <a href="#review-history"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#475569] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eff6ff] text-[#2563eb]">
                            <i class="fa-solid fa-clipboard-check text-sm"></i>
                        </span>
                        Review History
                    </a>

                    <a href="#events"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#475569] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eff6ff] text-[#2563eb]">
                            <i class="fa-solid fa-calendar-days text-sm"></i>
                        </span>
                        Events
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-sm font-medium text-[#475569] transition hover:bg-white hover:text-[#111]">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#fff1ee] text-[#d26c52]">
                                <i class="fa-solid fa-right-from-bracket text-sm"></i>
                            </span>
                            Logout
                        </button>
                    </form>
                </nav>

                <div class="mt-10 rounded-[28px] border border-[#bfdbfe] bg-[#dbeafe] p-5">
                    <p class="text-[13px] font-bold text-[#1e3a8a]">Admin review</p>
                    <p class="mt-2 text-[11px] leading-5 text-[#64748b]">
                        Accept clear annonces and refuse requests that need corrections. Add a report for every decision.
                    </p>
                </div>
            </div>
        </aside>

        <main class="px-5 py-6 md:px-8 lg:px-10 xl:px-12 xl:py-8">
            @php
                $totalAnnonces = max((int) $stats['total_annonces'], 1);
                $pendingPercent = round(($stats['pending_annonces'] / $totalAnnonces) * 100);
                $acceptedPercent = round(($stats['approved_annonces'] / $totalAnnonces) * 100);
                $refusedPercent = round(($stats['rejected_annonces'] / $totalAnnonces) * 100);
                $activeReviewCount = $stats['pending_annonces'] + $stats['approved_annonces'] + $stats['rejected_annonces'];
            @endphp

            <header class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#8ca097]">Admin / Platform Control</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight md:text-4xl">Application Statistics</h1>
                    <p class="mt-3 max-w-[760px] text-sm leading-7 text-[#6a6f6b]">
                        Review platform activity, accept valid annonces, and keep a report for each accepted or refused request.
                    </p>

                    <div class="mt-5 flex flex-wrap gap-3">
                        <span class="inline-flex items-center gap-2 rounded-full border border-[#bfdbfe] bg-[#eff6ff] px-4 py-2 text-sm font-bold text-[#1d4ed8]">
                            <i class="fa-solid fa-hand-holding-heart text-xs"></i>
                            Donors: {{ $stats['donors'] }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full border border-[#ddd6fe] bg-[#f5f3ff] px-4 py-2 text-sm font-bold text-[#6d28d9]">
                            <i class="fa-solid fa-people-roof text-xs"></i>
                            Beneficiaries: {{ $stats['beneficiaries'] }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full border border-[#cbd5e1] bg-white px-4 py-2 text-sm font-bold text-[#334155]">
                            <i class="fa-solid fa-user-shield text-xs"></i>
                            Admins: {{ $stats['admins'] }}
                        </span>
                    </div>
                </div>

                @if (session('status') === 'annonce-reviewed')
                    <span class="inline-flex rounded-full bg-[#dbeafe] px-5 py-3 text-sm font-semibold text-[#1d4ed8]">
                        Annonce status updated
                    </span>
                @elseif (session('status') === 'event-created')
                    <span class="inline-flex rounded-full bg-[#dbeafe] px-5 py-3 text-sm font-semibold text-[#1d4ed8]">
                        Event created
                    </span>
                @endif
            </header>

            <section class="mt-8 rounded-[28px] border border-[#bfdbfe] bg-[#1e3a8a] p-4 text-white shadow-[0_18px_44px_rgba(0,86,63,0.16)] md:p-5">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.4fr)]">
                    <div class="rounded-[22px] border border-white/10 bg-white/10 p-5 md:p-6">
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-white/60">Platform Statistics</p>
                        <h2 class="mt-3 text-2xl font-extrabold leading-tight md:text-3xl">Overview</h2>
                        <p class="mt-2 text-sm leading-6 text-white/70">
                            Users, requests, and validated money donations.
                        </p>

                        <div class="mt-6">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-white/55">Money Collected</p>
                            <div class="mt-2 flex flex-wrap items-end gap-x-3 gap-y-1">
                                <p class="text-4xl font-extrabold leading-none md:text-5xl">{{ number_format((float) $stats['total_money_collected'], 2) }}</p>
                                <p class="pb-1 text-sm font-bold text-white/65">MAD</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @foreach ([
                            ['label' => 'Users', 'value' => $stats['total_users'], 'icon' => 'fa-users', 'note' => 'All accounts'],
                            ['label' => 'Donors', 'value' => $stats['donors'], 'icon' => 'fa-hand-holding-heart', 'note' => 'Giving members'],
                            ['label' => 'Beneficiaries', 'value' => $stats['beneficiaries'], 'icon' => 'fa-people-roof', 'note' => 'Request owners'],
                            ['label' => 'Annonces', 'value' => $stats['total_annonces'], 'icon' => 'fa-list-ul', 'note' => 'Total requests'],
                        ] as $card)
                            <div class="rounded-[20px] border border-white/10 bg-white/[0.08] p-4">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-white/55">{{ $card['label'] }}</p>
                                        <p class="mt-1 text-3xl font-extrabold leading-none">{{ $card['value'] }}</p>
                                    </div>
                                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-white text-[#1e3a8a]">
                                        <i class="fa-solid {{ $card['icon'] }} text-sm"></i>
                                    </span>
                                </div>
                                <p class="mt-3 text-xs font-semibold text-white/60">{{ $card['note'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 gap-3 md:grid-cols-3">
                    @foreach ([
                        ['label' => 'Pending', 'value' => $stats['pending_annonces'], 'tone' => 'bg-[#fff4df] text-[#8a5a00]'],
                        ['label' => 'Accepted', 'value' => $stats['approved_annonces'], 'tone' => 'bg-[#dbeafe] text-[#1d4ed8]'],
                        ['label' => 'Refused', 'value' => $stats['rejected_annonces'], 'tone' => 'bg-[#fff1ee] text-[#c75e43]'],
                    ] as $statusCard)
                        <div class="flex items-center justify-between rounded-[18px] bg-white px-4 py-3 {{ $statusCard['tone'] }}">
                            <p class="text-sm font-extrabold">{{ $statusCard['label'] }}</p>
                            <p class="text-2xl font-extrabold leading-none">{{ $statusCard['value'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section id="pending-annonces" class="mt-8">
                <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)] md:p-7">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#8fa198]">Pending Annonces</p>
                        <h2 class="mt-2 text-3xl font-extrabold">Accepted Or Refused Requests</h2>
                        <p class="mt-3 max-w-[760px] text-sm leading-7 text-[#727875]">
                            Write the reason for your decision, then choose Accepted or Refused.
                        </p>
                    </div>

                    <div class="mt-7 grid grid-cols-1 gap-5 xl:grid-cols-2">
                        @forelse ($pendingAnnonces as $annonce)
                            <article class="overflow-hidden rounded-[24px] border border-[#ece9e2] bg-[#fcfcfa]">
                                @if ($annonce->image)
                                    <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="h-48 w-full object-cover">
                                @else
                                    <div class="flex h-48 items-center justify-center bg-[#efefec] text-[#7a807b]">
                                        <i class="fa-regular fa-image text-4xl"></i>
                                    </div>
                                @endif

                                <div class="p-5">
                                    <div class="flex flex-wrap items-center justify-between gap-3">
                                        <span class="inline-flex rounded-full bg-[#fff4df] px-3 py-1 text-[11px] font-bold uppercase text-[#b77411]">
                                            Pending
                                        </span>
                                        <span class="text-xs text-[#939c98]">{{ $annonce->created_at?->diffForHumans() }}</span>
                                    </div>

                                    <h3 class="mt-4 text-xl font-extrabold leading-tight">{{ $annonce->title }}</h3>
                                    <p class="mt-3 text-sm leading-6 text-[#727875]">{{ $annonce->description }}</p>

                                    <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">
                                        <div class="rounded-2xl bg-white p-4">
                                            <p class="text-xs uppercase tracking-[0.14em] text-[#99a59f]">Beneficiary</p>
                                            <p class="mt-2 text-sm font-semibold">{{ $annonce->beneficiary?->name ?? 'Unknown' }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-white p-4">
                                            <p class="text-xs uppercase tracking-[0.14em] text-[#99a59f]">City</p>
                                            <p class="mt-2 text-sm font-semibold">{{ $annonce->city }}</p>
                                        </div>
                                        <div class="rounded-2xl bg-white p-4">
                                            <p class="text-xs uppercase tracking-[0.14em] text-[#99a59f]">Category</p>
                                            <p class="mt-2 text-sm font-semibold">{{ $annonce->category }}</p>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('admin.annonces.status.update', $annonce) }}" class="mt-5 space-y-4">
                                        @csrf
                                        @method('PATCH')

                                        <div>
                                            <label for="raport_{{ $annonce->id }}" class="block text-sm font-bold text-[#2d3430]">Decision Report</label>
                                            <textarea
                                                id="raport_{{ $annonce->id }}"
                                                name="raport"
                                                required
                                                placeholder="Write why you accept or refuse this annonce..."
                                                class="mt-2 h-28 w-full resize-none rounded-2xl border border-[#d8d8d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#2563eb]">{{ old('raport') }}</textarea>
                                            @error('raport')
                                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                                            <button type="submit" name="status" value="approved"
                                                class="inline-flex items-center justify-center rounded-full bg-[#2563eb] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1d4ed8]">
                                                Accepted Annonce
                                            </button>
                                            <button type="submit" name="status" value="rejected"
                                                class="inline-flex items-center justify-center rounded-full border border-[#c75e43] px-5 py-3 text-sm font-semibold text-[#c75e43] transition hover:bg-[#c75e43] hover:text-white">
                                                Refuse Annonce
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </article>
                        @empty
                            <div class="xl:col-span-2 rounded-[26px] border border-dashed border-[#d3d9d4] bg-[#fbfbf8] px-8 py-16 text-center">
                                <h3 class="text-2xl font-extrabold">No pending annonces</h3>
                                <p class="mx-auto mt-3 max-w-[520px] text-sm leading-7 text-[#727875]">
                                    New beneficiary requests will appear here when they need admin review.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section id="review-history" class="mt-8">
                <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)] md:p-7">
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#8fa198]">Review History</p>
                    <h2 class="mt-2 text-3xl font-extrabold">Latest Admin Reports</h2>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="border-b border-[#ece9e2] text-[11px] uppercase tracking-[0.14em] text-[#99a59f]">
                                    <th class="pb-3 pr-4 font-semibold">Annonce</th>
                                    <th class="pb-3 pr-4 font-semibold">Status</th>
                                    <th class="pb-3 pr-4 font-semibold">Reviewed</th>
                                    <th class="pb-3 font-semibold">Report</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviewedAnnonces as $annonce)
                                    <tr class="border-b border-[#f0eee8] text-sm text-[#4b4f4d] last:border-b-0">
                                        <td class="py-4 pr-4 font-semibold text-[#181818]">{{ \Illuminate\Support\Str::limit($annonce->title, 34) }}</td>
                                        <td class="py-4 pr-4">
                                            <span class="inline-flex rounded-full px-3 py-1 text-[11px] font-bold uppercase {{ $annonce->status === 'approved' ? 'bg-[#dbeafe] text-[#1d4ed8]' : 'bg-[#fff1ee] text-[#c75e43]' }}">
                                                {{ $annonce->status === 'approved' ? 'accepted' : 'refused' }}
                                            </span>
                                        </td>
                                        <td class="py-4 pr-4">{{ $annonce->reviewed_at?->format('d M Y') ?? 'Not set' }}</td>
                                        <td class="py-4">{{ \Illuminate\Support\Str::limit($annonce->raport ?? 'No report saved', 90) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-10 text-center text-sm text-[#727875]">
                                            No reviewed annonces yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section id="events" class="mt-8">
                <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)] md:p-7">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#8fa198]">Events</p>
                            <h2 class="mt-2 text-3xl font-extrabold">Donor Participation</h2>
                            <p class="mt-3 max-w-[760px] text-sm leading-7 text-[#727875]">
                                Create events and follow how many donors participate.
                            </p>
                        </div>

                        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center justify-center rounded-full bg-[#2563eb] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1d4ed8]">
                            Create Event
                        </a>
                    </div>

                    <div class="mt-7 grid grid-cols-1 gap-5 xl:grid-cols-2">
                        @forelse ($events as $event)
                            <article class="rounded-[24px] border border-[#ece9e2] bg-[#fcfcfa] p-5">
                                <div class="flex flex-wrap items-start justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8fa198]">{{ $event->city }}</p>
                                        <h3 class="mt-2 text-xl font-extrabold">{{ $event->title }}</h3>
                                    </div>
                                    <span class="inline-flex rounded-full bg-[#dbeafe] px-4 py-2 text-sm font-bold text-[#1d4ed8]">
                                        {{ $event->participants_count }} participants
                                    </span>
                                </div>

                                <p class="mt-4 text-sm leading-7 text-[#727875]">
                                    {{ $event->description ?: 'No description added.' }}
                                </p>

                                <div class="mt-5 flex items-center gap-3 text-sm font-semibold text-[#4b4f4d]">
                                    <i class="fa-regular fa-calendar text-[#2563eb]"></i>
                                    {{ $event->date_event?->format('d M Y') }}
                                </div>

                                <div class="mt-5 rounded-[20px] border border-[#ece9e2] bg-white p-4">
                                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8fa198]">Participants Details</p>

                                    <div class="mt-4 space-y-3">
                                        @forelse ($event->participants as $participant)
                                            <div class="flex flex-col gap-1 rounded-2xl bg-[#f7f7f3] px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                                                <p class="text-sm font-bold text-[#181818]">{{ $participant->name }}</p>
                                                <p class="text-sm text-[#727875]">{{ $participant->email }}</p>
                                            </div>
                                        @empty
                                            <p class="rounded-2xl border border-dashed border-[#d3d9d4] px-4 py-5 text-center text-sm text-[#727875]">
                                                No donors participating yet.
                                            </p>
                                        @endforelse
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="xl:col-span-2 rounded-[26px] border border-dashed border-[#d3d9d4] bg-[#fbfbf8] px-8 py-16 text-center">
                                <h3 class="text-2xl font-extrabold">No events yet</h3>
                                <p class="mx-auto mt-3 max-w-[520px] text-sm leading-7 text-[#727875]">
                                    Create the first event so donors can participate.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
