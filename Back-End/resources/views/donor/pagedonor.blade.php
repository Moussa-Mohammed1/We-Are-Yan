<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/donorfilter.js'])
    <title>We Are Yan - Donor Dashboard</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen" data-filter-url="{{ url('/api/annonces/filter') }}">

    <div class="min-h-screen xl:grid xl:grid-cols-[280px_minmax(0,1fr)]">
        <aside class="border-b xl:border-b-0 xl:border-r border-[#e6e4dc] bg-[#fbfbf8] px-6 py-8 xl:px-7">
            <div class="flex items-center justify-between xl:block">
                <a href="{{ url('/') }}" class="inline-flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </a>

                <a href="#requests"
                   class="xl:hidden inline-flex items-center rounded-full bg-[#00563f] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                    Browse Requests
                </a>
            </div>

            <div class="xl:sticky xl:top-6">
                <nav class="mt-8 space-y-2">
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 rounded-2xl bg-[#00563f] px-4 py-3 text-sm font-semibold text-white shadow-[0_10px_20px_rgba(0,86,63,0.18)]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12 12 4l9 8" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10v10h14V10" />
                            </svg>
                        </span>
                        Dashboard
                    </a>

                    <a href="#requests"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h10" />
                            </svg>
                        </span>
                        Requests
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

                    <a href="{{ url('/') }}"
                       class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-[#52605a] transition hover:bg-white hover:text-[#111]">
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-[#eef4f1] text-[#00563f]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19 3 12l7-7" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18" />
                            </svg>
                        </span>
                        Back Home
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
                    <p class="text-[13px] font-bold text-[#0f3d31]">Every donation matters</p>
                    <p class="mt-2 text-[10px] text-[#55736a]">
                        Browse verified requests and support people with care, clarity, and real impact.
                    </p>
                </div>
            </div>
        </aside>

        <main class="px-5 py-6 md:px-8 lg:px-10 xl:px-12 xl:py-8">
            <header class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between mb-8">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#8ca097]">Dashboard / Donor Space</p>
                    <h1 class="mt-3 text-3xl font-extrabold leading-tight md:text-4xl">
                        Welcome back, <span class="border-b-2 border-[#00563f]">{{ $user->name }}</span>
                    </h1>
                    <p class="mt-3 max-w-[760px] text-[13px] leading-7 text-[#6a6f6b]">
                        Explore active requests, review details, and support families and communities in need.
                    </p>
                </div>
            </header>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="flex items-center justify-between gap-6 flex-wrap">
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-teal-600 font-semibold">Donor Profile</p>
                        <h2 class="text-2xl font-bold text-gray-900 mt-2">{{ $user->name }}</h2>
                        <p class="text-gray-500 mt-1">Your personal donor information</p>
                    </div>

                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-[#00563f] text-white px-5 py-3 rounded-xl font-semibold hover:bg-[#004734] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 1 1 3.182 3.182L7.5 19.213 3 21l1.787-4.5L16.862 3.487Z" />
                        </svg>
                        Edit Profile
                    </a>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full md:w-auto">
                        <div class="bg-gray-50 rounded-xl px-5 py-4 min-w-[200px]">
                            <p class="text-xs uppercase text-gray-400 font-semibold">Email</p>
                            <p class="text-gray-800 font-medium mt-2">{{ $user->email }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl px-5 py-4 min-w-[200px]">
                            <p class="text-xs uppercase text-gray-400 font-semibold">City</p>
                            <p class="text-gray-800 font-medium mt-2">{{ $user->city }}</p>
                        </div>

                        <div class="bg-gray-50 rounded-xl px-5 py-4 min-w-[200px]">
                            <p class="text-xs uppercase text-gray-400 font-semibold">Role</p>
                            <p class="text-gray-800 font-medium mt-2">{{ ucfirst($user->role) }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="relative bg-[#00563f] rounded-2xl p-10 overflow-hidden mb-12 text-white">
                <div class="relative z-10 max-w-lg">
                    <p class="uppercase tracking-widest text-sm mb-2 opacity-90 font-semibold">Community Support</p>
                    <h1 class="text-4xl font-bold leading-tight mb-6">Explore active requests and support families and communities in need.</h1>
                    <a href="#requests" class="inline-flex bg-gray-900 text-white px-8 py-3 rounded-full items-center space-x-3 hover:bg-black">
                        <span>Browse Requests</span>
                        <span class="bg-white text-black rounded-full w-6 h-6 flex items-center justify-center text-xs">&rarr;</span>
                    </a>
                </div>
            </div>

            <h2 id="requests" class="text-3xl font-extrabold text-gray-800 mb-8">Let's Give Help To Those In <span class="text-green-700 border-b-4 border-green-700">Need</span></h2>

            <div class="category flex flex-wrap items-center gap-3 pb-5" id="categoryFilters">
                    <button
                        type="button"
                        data-category=""
                        class="filter-button block w-40 text-[12px] border-2 py-3 rounded-xl font-bold transition text-center uppercase bg-[#004734] text-white border-[#004734]">
                        See All
                    </button>
                @forelse ($category as $ancategory)
                    <button
                        type="button"
                        data-category="{{ $ancategory->category }}"
                        class="filter-button block w-40 text-[12px] text-[#004734] border-[#004732] border-2 py-3 rounded-xl font-bold hover:bg-[#004734] hover:text-white transition text-center uppercase">
                        {{ $ancategory->category }}
                    </button>
                @empty
                    <button class="block w-52 bg-[#00563f] text-white py-3 rounded-xl font-bold hover:bg-[#004734] transition text-center">No Canegory yet !</button>
                @endforelse
            </div>

            <div id="annoncesList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse ($annonces as $annonce)
                    @php
                        $urgencyClasses = match ($annonce->urgency) {
                            'urgent' => 'text-red-500 border-red-500 bg-red-50',
                            'critical' => 'text-orange-500 border-orange-500 bg-orange-50',
                            default => 'text-green-600 border-green-600 bg-green-50',
                        };
                    @endphp

                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition h-full">
                        <div class="p-4 flex h-full flex-col">
                            @if ($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->title }}" class="w-full h-48 object-cover rounded-2xl mb-4">
                            @else
                                <div class="w-full h-48 rounded-2xl mb-4 bg-[#eef6f3] flex items-center justify-center text-[#007b67] font-bold text-lg">
                                    No Image
                                </div>
                            @endif

                            <div class="flex justify-between items-center gap-3 mb-3">
                                <span class="text-teal-600 font-bold text-sm uppercase tracking-wide">{{ $annonce->category }}</span>
                                <span class="border {{ $urgencyClasses }} text-[10px] px-3 py-1 rounded-full font-semibold uppercase">
                                    {{ $annonce->urgency }}
                                </span>
                            </div>

                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $annonce->title }}</h3>
                            <p class="min-h-[72px] text-gray-500 text-sm leading-relaxed mb-4">
                                {{ \Illuminate\Support\Str::limit($annonce->description, 85) }}
                            </p>

                            <div class="space-y-2 text-sm text-gray-600 mb-5">
                                <p><span class="font-semibold text-gray-800">City:</span> {{ $annonce->city }}</p>
                                <p><span class="font-semibold text-gray-800">Quantity:</span> {{ $annonce->quantity ?? 'Not specified' }}</p>
                            </div>

                            <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                                <span>Posted by {{ $annonce->beneficiary?->name }}</span>
                                <span>{{ $annonce->created_at }}</span>
                            </div>

                            <a href="{{ route('annonces.show', $annonce) }}" class="mt-auto block w-full bg-[#00563f] text-white py-3 rounded-xl font-bold hover:bg-[#004734] transition text-center">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 bg-white border border-[#dfdfdf] rounded-[28px] px-8 py-12 text-center text-[#666] shadow-sm">
                        No annonces available yet.
                    </div>
                @endforelse
            </div>

        </main>
    </div>

</body>
</html>
