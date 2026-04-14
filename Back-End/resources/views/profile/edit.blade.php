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

            <a href="{{ route($user->homeRouteName()) }}"
               class="hidden md:inline-flex items-center gap-2 bg-[#00563f] text-white px-7 py-3 rounded-full font-semibold hover:bg-[#004734] transition">
                Back Dashboard
                <span>&rarr;</span>
            </a>
        </div>

        <div class="max-w-[900px] mx-auto">
            <div class="space-y-6">
                <div class="bg-white border border-[#dfdfdf] rounded-[40px] p-6 md:p-10 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
                    <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Profile Settings</p>
                    <h1 class="mt-3 text-4xl md:text-5xl font-extrabold leading-tight">Manage Your Account</h1>
                    <p class="mt-4 text-[#6d6d6d] text-[16px] leading-7 max-w-[700px]">
                        Update your personal details, secure your password, and manage your account
                        with the same visual style used across We Are Yan.
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
        </div>
    </section>

</body>
</html>
