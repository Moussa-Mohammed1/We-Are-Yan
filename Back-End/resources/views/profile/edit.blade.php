<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - We Are Yan</title>
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f6f5f2] text-[#111111] min-h-screen font-sec">

    <section class="min-h-screen px-6 py-8 md:px-10 lg:px-16">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ url('/') }}" class="text-[#007b67] font-extrabold text-3xl leading-none">
                <div class="flex items-center">
                    <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
                </div>
            </a>

            <a href="{{ route('dashboard') }}"
               class="hidden md:inline-flex items-center gap-2 bg-[#007b67] text-white px-7 py-3 rounded-full font-semibold hover:bg-[#006554] transition">
                Back Dashboard
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-[1.05fr_0.95fr] gap-8 items-start max-w-[1500px] mx-auto">
            <div class="space-y-6">
                <div class="bg-white border border-[#dfdfdf] rounded-[40px] p-6 md:p-10 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
                    <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Profile Settings</p>
                    <h1 class="font-princ mt-3 text-4xl md:text-5xl font-extrabold leading-tight">Manage Your Account</h1>
                    <p class="mt-4 text-[#6d6d6d] text-[16px] leading-7 max-w-[700px]">
                        Update your personal details, secure your password, and manage your account
                        using the same simple style as the rest of We Are Yan.
                    </p>
                </div>

                <div class="bg-white border border-[#dfdfdf] rounded-[40px] p-6 md:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="bg-white border border-[#dfdfdf] rounded-[40px] p-6 md:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="bg-white border border-red-100 rounded-[40px] p-6 md:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="relative overflow-hidden rounded-[40px] bg-[#00563f] text-white p-8 md:p-12 min-h-[720px] flex flex-col justify-between">
                <div class="absolute -top-12 -left-12 w-56 h-56 bg-white/10 rounded-full"></div>
                <div class="absolute bottom-8 right-8 w-40 h-40 bg-white/10 rounded-full"></div>

                <div class="relative z-10">
                    <span class="inline-block px-4 py-2 rounded-full bg-white/10 text-sm font-semibold">
                        Account Overview
                    </span>

                    <h2 class="font-princ mt-8 text-4xl md:text-6xl font-extrabold leading-[1.05] max-w-[520px]">
                        Keep your donor identity up to date.
                    </h2>

                    <p class="mt-6 text-white/80 text-[15px] leading-7 max-w-[520px]">
                        Review the information attached to your account and make sure your details stay current
                        before you continue supporting people in need.
                    </p>
                </div>

                <div class="relative z-10 space-y-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                        <p class="text-white/70 text-sm">Full name</p>
                        <h3 class="mt-2 text-2xl font-extrabold">{{ $user->name }}</h3>
                    </div>

                    <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                        <p class="text-white/70 text-sm">Email address</p>
                        <h3 class="mt-2 text-xl font-extrabold break-all">{{ $user->email }}</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                            <p class="text-white/70 text-sm">Role</p>
                            <h3 class="mt-2 text-xl font-extrabold">{{ ucfirst($user->role) }}</h3>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-[24px] p-5 border border-white/10">
                            <p class="text-white/70 text-sm">City</p>
                            <h3 class="mt-2 text-xl font-extrabold">{{ $user->city ?: 'Not set' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
