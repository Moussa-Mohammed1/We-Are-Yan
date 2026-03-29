<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css'])
    <title>We Are Yan - Donor Dashboard</title>
</head>
<body class="bg-gray-50 font-sec">

    <nav class="bg-white border-b px-8 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <div class="text-teal-600 font-bold text-2xl">We Are <span class="text-teal-800">Yan</span></div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700">Welcome <span class="font-semibold">{{ $user->name }}</span></span>
            <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center text-white">Donor</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="border border-teal-600 text-teal-600 px-4 py-1 rounded hover:bg-teal-50">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-8 py-6 flex justify-between">
        <div class="flex space-x-3">
            <button class="border border-teal-600 text-teal-600 px-6 py-2 rounded-md font-medium">Dashboard</button>
            <a href="{{ route('donor.form') }}" class="bg-teal-700 text-white px-6 py-2 rounded-md font-medium flex items-center">
                <span class="mr-2">+</span> Add New Post
            </a>
        </div>
        <button class="bg-teal-700 text-white px-6 py-2 rounded-md font-medium">← Back To Home</button>
    </div>

    <main class="max-w-7xl mx-auto px-8">
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex items-center justify-between gap-6 flex-wrap">
                <div>
                    <p class="text-sm uppercase tracking-[0.2em] text-teal-600 font-semibold">Donor Profile</p>
                    <h2 class="text-2xl font-bold text-gray-900 mt-2">{{ $user->name }}</h2>
                    <p class="text-gray-500 mt-1">Your personal donor information</p>
                </div>

                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-teal-700 text-white px-5 py-3 rounded-xl font-semibold hover:bg-teal-800 transition">
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
        
        <div class="relative bg-teal-600 rounded-2xl p-10 overflow-hidden mb-12 text-white">
            <div class="relative z-10 max-w-lg">
                <p class="uppercase tracking-widest text-sm mb-2 opacity-90 font-semibold">Community Support</p>
                <h1 class="text-4xl font-bold leading-tight mb-6">Help Connect Donors With Families And Communities Who Need Support</h1>
                <a href="{{ route('donor.form') }}" class="inline-flex bg-gray-900 text-white px-8 py-3 rounded-full items-center space-x-3 hover:bg-black">
                    <span>Create a Request</span>
                    <span class="bg-white text-black rounded-full w-6 h-6 flex items-center justify-center text-xs">&rarr;</span>
                </a>
            </div>
            <div class="absolute top-0 right-0 w-64 h-full bg-teal-500 opacity-20 -skew-x-12 translate-x-10"></div>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-800 mb-8">Let's Give Help To<br>Those In Need</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @forelse ($annonces as $annonce)
                @php
                    $urgencyClasses = match ($annonce->urgency) {
                        'urgent' => 'text-red-500 border-red-500 bg-red-50',
                        'critical' => 'text-orange-500 border-orange-500 bg-orange-50',
                        default => 'text-green-600 border-green-600 bg-green-50',
                    };
                @endphp

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="p-4">
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
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">
                            {{ \Illuminate\Support\Str::limit($annonce->description, 110) }}
                        </p>

                        <div class="space-y-2 text-sm text-gray-600 mb-5">
                            <p><span class="font-semibold text-gray-800">City:</span> {{ $annonce->city }}</p>
                            <p><span class="font-semibold text-gray-800">Quantity:</span> {{ $annonce->quantity ?? 'Not specified' }}</p>
                        </div>

                        <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                            <span>Posted by {{ $annonce->beneficiary?->name ?? 'Unknown user' }}</span>
                            <span>{{ $annonce->created_at?->diffForHumans() }}</span>
                        </div>

                        <a href="{{ route('annonces.show', $annonce) }}" class="block w-full bg-teal-800 text-white py-3 rounded-xl font-bold hover:bg-teal-900 transition text-center">
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

        <div class="flex justify-center mb-20">
            <button class="border-2 border-teal-600 text-teal-600 px-12 py-2 rounded-lg font-bold hover:bg-teal-50">
                Load More
            </button>
        </div>
    </main>

    <footer class="border-t py-12 px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="text-teal-600 font-bold text-2xl mb-6 md:mb-0">We Are <span class="text-teal-800">Yan</span></div>
            <div class="flex flex-wrap justify-center gap-6 text-sm font-medium text-gray-600">
                <a href="#">Donations</a>
                <a href="#">Popular Causes</a>
                <a href="#">Upcoming Event</a>
                <a href="#">Latest Blog</a>
                <a href="#">Careers</a>
                <a href="#">Help</a>
                <a href="#">Privacy</a>
            </div>
        </div>
        <div class="text-center text-gray-400 text-xs mt-8">
            © 2024 We Are Yan. All rights reserved.
        </div>
    </footer>

</body>
</html>
