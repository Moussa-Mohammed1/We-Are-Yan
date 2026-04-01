<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - We Are Yan</title>
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js', 'resources/js/city.js'])
</head>
<body class="bg-[#f6f5f2] text-[#111111] min-h-screen font-sec">

    <section class="min-h-screen px-6 py-8 md:px-10 lg:px-16">
        <!-- top -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ url('/') }}" class="text-[#007b67] font-extrabold text-3xl leading-none">
                <div class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </div>
            </a>

            <a href="{{ url('/') }}"
               class="hidden md:inline-flex items-center gap-2 bg-[#00563f] text-white px-7 py-3 rounded-full font-semibold hover:bg-[#004734] transition">
                Back Home
                <span>→</span>
            </a>
        </div>

        <!-- content -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 items-stretch max-w-[1500px] mx-auto">

            <!-- left form -->
            <div class="bg-white border border-[#dfdfdf] rounded-[40px] p-6 md:p-10 lg:p-12 shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex items-center order-2 xl:order-1">
                <div class="w-full max-w-[620px] mx-auto">
                    <div class="mb-8">
                        <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Join Community</p>
                        <h2 class="font-sec mt-3 text-4xl md:text-5xl font-extrabold leading-tight">Create Account</h2>
                        <p class="mt-3 text-[#6d6d6d] text-[16px] leading-7">
                            Sign up and become part of a community that connects help to those who need it.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-[15px] font-bold mb-2">Full Name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Enter your full name"
                                class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                            />
                            @error('name')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[15px] font-bold mb-2">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="Enter your email"
                                class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                            />
                            @error('email')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-[15px] font-bold mb-2">City</label>
                            <select
                                id="city"
                                name="city"
                                data-selected-city="{{ old('city') }}"
                                required
                                class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                            >
                                <option value="">Choose your city</option>
                            </select>
                            @error('city')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block text-[15px] font-bold mb-2">Account Type</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="border border-[#d8d8d8] rounded-[18px] p-4 bg-[#fbfbfb] cursor-pointer hover:border-[#007b67] transition">
                                    <input
                                        type="radio"
                                        name="role"
                                        value="donateur"
                                        class="accent-[#007b67]"
                                        {{ old('role', 'donateur') === 'donateur' ? 'checked' : '' }}
                                    >
                                    <span class="block mt-3 font-bold">Donateur</span>
                                    <span class="block text-sm text-[#777] mt-1">Support causes and help people.</span>
                                </label>

                                <label class="border border-[#d8d8d8] rounded-[18px] p-4 bg-[#fbfbfb] cursor-pointer hover:border-[#007b67] transition">
                                    <input
                                        type="radio"
                                        name="role"
                                        value="beneficiaire"
                                        class="accent-[#007b67]"
                                        {{ old('role') === 'beneficiaire' ? 'checked' : '' }}
                                    >
                                    <span class="block mt-3 font-bold">Bénéficiaire</span>
                                    <span class="block text-sm text-[#777] mt-1">Request support and publish needs.</span>
                                </label>
                            </div>
                            @error('role')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-[15px] font-bold mb-2">Password</label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Create password"
                                    class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                                />
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-[15px] font-bold mb-2">Confirm Password</label>
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm password"
                                    class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                                />
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="w-full h-[60px] rounded-[18px] bg-[#00563f] hover:bg-[#004734] text-white font-bold text-[16px] transition"
                        >
                            Create Account
                        </button>

                        <p class="text-center text-[15px] text-[#666] pt-2">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-[#007b67] font-bold">Login</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- right visual -->
            <div class="relative overflow-hidden rounded-[40px] bg-[#00563f] text-white p-8 md:p-12 min-h-[720px] flex flex-col justify-between order-1 xl:order-2">
                <div class="relative z-10">
                    <span class="inline-block px-4 py-2 rounded-full bg-white/10 text-sm font-semibold">
                        Start Your Journey
                    </span>

                    <h1 class="font-sec mt-8 text-4xl md:text-6xl font-extrabold leading-[1.05] max-w-[520px]">
                        Make every action count.
                    </h1>

                    <p class="mt-6 text-white/80 text-[15px] leading-7 max-w-[520px]">
                        Create your account to donate, publish needs, support communities,
                        and follow the real-world impact of your contributions.
                    </p>
                </div>

                <div class="relative z-10 space-y-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10 flex items-center justify-between">
                        <div>
                            <p class="text-white/70 text-sm">Community support</p>
                            <h3 class="mt-1 text-2xl font-extrabold">Food & Clothing</h3>
                        </div>
                        <span class="px-4 py-2 rounded-full bg-white text-[#00563f] font-bold text-sm">Live</span>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10 flex items-center justify-between">
                        <div>
                            <p class="text-white/70 text-sm">Education access</p>
                            <h3 class="mt-1 text-2xl font-extrabold">School Kits</h3>
                        </div>
                        <span class="px-4 py-2 rounded-full bg-white text-[#00563f] font-bold text-sm">Active</span>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10 flex items-center justify-between">
                        <div>
                            <p class="text-white/70 text-sm">Medical support</p>
                            <h3 class="mt-1 text-2xl font-extrabold">Urgent Cases</h3>
                        </div>
                        <span class="px-4 py-2 rounded-full bg-white text-[#00563f] font-bold text-sm">Priority</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
