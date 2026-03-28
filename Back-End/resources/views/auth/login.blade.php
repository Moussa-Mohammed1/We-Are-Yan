<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - We Are Yan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f6f5f2] text-[#111111] min-h-screen">

    <section class="min-h-screen px-6 py-8 md:px-10 lg:px-16">
        <!-- top -->
        <div class="flex items-center justify-between mb-8">
            <a href="{{ url('/') }}" class="text-[#007b67] font-extrabold text-3xl leading-none">
                <div class="flex items-center">
                    <img src="{{ asset('images/logowry.png') }}" alt="We Are Yan Logo" class="h-16 object-contain">
                </div>
            </a>

            <a href="{{ url('/') }}"
               class="hidden md:inline-flex items-center gap-2 bg-[#007b67] text-white px-7 py-3 rounded-full font-semibold hover:bg-[#006554] transition">
                Back Home
                <span>→</span>
            </a>
        </div>

        <!-- content -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 items-stretch max-w-[1500px] mx-auto">

            <!-- left visual -->
            <div class="relative overflow-hidden rounded-[40px] bg-[#00563f] text-white p-8 md:p-12 min-h-[720px] flex flex-col justify-between">
                <div class="absolute -top-16 -right-16 w-64 h-64 bg-white/10 rounded-full"></div>
                <div class="absolute bottom-10 right-10 w-36 h-36 bg-white/10 rounded-full"></div>

                <div class="relative z-10">
                    <span class="inline-block px-4 py-2 rounded-full bg-white/10 text-sm font-semibold">
                        Welcome Back
                    </span>

                    <h1 class="mt-8 text-4xl md:text-6xl font-extrabold leading-[1.05] max-w-[520px]">
                        Continue helping those who need it.
                    </h1>

                    <p class="mt-6 text-white/80 text-[16px] leading-7 max-w-[520px]">
                        Log in to manage your donations, follow your impact, save your favorite causes,
                        and stay connected with the community.
                    </p>
                </div>

                <div class="relative z-10 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                        <p class="text-white/70 text-[19px]">Requests helped</p>
                        <h3 class="mt-2 text-3xl font-extrabold">1.2K</h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                        <p class="text-white/70 text-[19px]">Donors active</p>
                        <h3 class="mt-2 text-3xl font-extrabold">5.4K</h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                        <p class="text-white/70 text-[19px]">Cities reached</p>
                        <h3 class="mt-2 text-3xl font-extrabold">38</h3>
                    </div>
                </div>
            </div>

            <!-- right form -->
            <div class="bg-white border border-[#dfdfdf] rounded-[40px] p-6 md:p-10 lg:p-12 shadow-[0_10px_30px_rgba(0,0,0,0.04)] flex items-center">
                <div class="w-full max-w-[560px] mx-auto">
                    <div class="mb-8">
                        <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Account Access</p>
                        <h2 class="mt-3 text-4xl md:text-5xl font-extrabold leading-tight">Login</h2>
                        <p class="mt-3 text-[#6d6d6d] text-[16px] leading-7">
                            Enter your credentials to access your dashboard.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 rounded-[18px] border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[15px] font-bold mb-2">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Enter your email"
                                class="w-full h-[60px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                            />
                            @error('email')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="text-[15px] font-bold">Password</label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[#007b67] text-sm font-semibold hover:underline">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                class="w-full h-[60px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                            />
                            @error('password')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember me -->
                        <div class="flex items-center justify-between gap-4 pt-1">
                            <label for="remember_me" class="flex items-center gap-3 text-[14px] text-[#555]">
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="accent-[#007b67] w-4 h-4"
                                >
                                Remember me
                            </label>

                            <span class="text-[14px] text-[#8a8a8a]">Secure access</span>
                        </div>

                        <!-- Submit -->
                        <button
                            type="submit"
                            class="w-full h-[60px] rounded-[18px] bg-[#007b67] hover:bg-[#006554] text-white font-bold text-[16px] transition"
                        >
                            Login to Account
                        </button>

                        <div class="bg-[#f6fbf8] border border-[#dbeee3] rounded-[22px] p-5 mt-4">
                            <p class="text-[14px] text-[#49645a] leading-6">
                                By logging in, you can track donations, follow requests, and see the difference
                                your support is making.
                            </p>
                        </div>

                        <p class="text-center text-[15px] text-[#666] pt-2">
                            Don’t have an account?
                            <a href="{{ route('register') }}" class="text-[#007b67] font-bold hover:underline">Create one</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
</html>