<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/style.css'])
    <title>Admin Dashboard - We Are Yan</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen">
    <div class="min-h-screen xl:grid xl:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="border-b xl:border-b-0 xl:border-r border-[#e6e4dc] bg-[#fbfbf8] px-6 py-8 xl:px-7">
            <div class="xl:sticky xl:top-6">
                <a href="{{ url('/') }}" class="inline-flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </a>

                <nav class="mt-8 space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 rounded-2xl bg-[#00563f] px-4 py-3 text-sm font-semibold text-white shadow-[0_10px_20px_rgba(0,86,63,0.18)]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/12">
                            <i class="fa-solid fa-chart-line text-sm"></i>
                        </span>
                        Admin Dashboard
                    </a>

                    <a href="#pending-annonces"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <i class="fa-solid fa-hourglass-half text-sm"></i>
                        </span>
                        Pending Annonces
                    </a>

                    <a href="#review-history"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <i class="fa-solid fa-clipboard-check text-sm"></i>
                        </span>
                        Review History
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
                    <p class="text-[13px] font-bold text-[#0f3d31]">Admin review</p>
                    <p class="mt-2 text-[11px] leading-5 text-[#55736a]">
                        Approve clear annonces and refuse requests that need corrections. Add a report for every decision.
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
                        Review platform activity, approve valid annonces, and keep a report for each accepted or refused request.
                    </p>
                </div>

                @if (session('status') === 'annonce-reviewed')
                    <span class="inline-flex rounded-full bg-[#e7f6ef] px-5 py-3 text-sm font-semibold text-[#11624c]">
                        Annonce status updated
                    </span>
                @endif
            </header>

            <section class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                @foreach ([
                    ['label' => 'Users', 'value' => $stats['total_users'], 'icon' => 'fa-users', 'tone' => 'bg-[#eef8f4] text-[#00563f]'],
                    ['label' => 'Donors', 'value' => $stats['donors'], 'icon' => 'fa-hand-holding-heart', 'tone' => 'bg-[#fff4df] text-[#b77411]'],
                    ['label' => 'Beneficiaries', 'value' => $stats['beneficiaries'], 'icon' => 'fa-people-roof', 'tone' => 'bg-[#eef0ff] text-[#4b5fc4]'],
                    ['label' => 'Annonces', 'value' => $stats['total_annonces'], 'icon' => 'fa-list-ul', 'tone' => 'bg-[#fff1ee] text-[#c75e43]'],
                ] as $card)
                    <div class="rounded-[22px] border border-[#e5ebe7] bg-white p-5 shadow-[0_10px_24px_rgba(0,0,0,0.04)]">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#8fa198]">{{ $card['label'] }}</p>
                                <p class="mt-3 text-3xl font-extrabold text-[#111111]">{{ $card['value'] }}</p>
                            </div>
                            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl {{ $card['tone'] }}">
                                <i class="fa-solid {{ $card['icon'] }} text-lg"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </section>

            <section class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ([
                    ['label' => 'Pending', 'value' => $stats['pending_annonces'], 'class' => 'border-[#f1d28a] bg-[#fff4df] text-[#8a5a00]'],
                    ['label' => 'Accepted', 'value' => $stats['approved_annonces'], 'class' => 'border-[#bfe5cf] bg-[#e7f6ef] text-[#11624c]'],
                    ['label' => 'Refused', 'value' => $stats['rejected_annonces'], 'class' => 'border-[#f0c1b6] bg-[#fff1ee] text-[#c75e43]'],
                ] as $statusCard)
                    <div class="rounded-[22px] border p-5 {{ $statusCard['class'] }}">
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-sm font-bold">{{ $statusCard['label'] }}</p>
                            <p class="text-2xl font-extrabold">{{ $statusCard['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </section>

            <section id="pending-annonces" class="mt-8">
                <div class="rounded-[30px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)] md:p-7">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.16em] text-[#8fa198]">Pending Annonces</p>
                        <h2 class="mt-2 text-3xl font-extrabold">Accept Or Refuse Requests</h2>
                        <p class="mt-3 max-w-[760px] text-sm leading-7 text-[#727875]">
                            Write the reason for your decision, then choose Accept or Refuse.
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
                                                class="mt-2 h-28 w-full resize-none rounded-2xl border border-[#d8d8d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00563f]">{{ old('raport') }}</textarea>
                                            @error('raport')
                                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                                            <button type="submit" name="status" value="approved"
                                                class="inline-flex items-center justify-center rounded-full bg-[#00563f] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                                                Accept Annonce
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
                                            <span class="inline-flex rounded-full px-3 py-1 text-[11px] font-bold uppercase {{ $annonce->status === 'approved' ? 'bg-[#e7f6ef] text-[#11624c]' : 'bg-[#fff1ee] text-[#c75e43]' }}">
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
        </main>
    </div>
</body>
</html>
