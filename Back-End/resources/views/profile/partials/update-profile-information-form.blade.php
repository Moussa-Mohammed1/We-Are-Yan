<section>
    <header>
        <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Personal Info</p>
        <h2 class="font-sec mt-3 text-3xl font-extrabold leading-tight text-[#111111]">
            Profile Information
        </h2>
        <p class="mt-3 text-[#6d6d6d] text-[15px] leading-7 max-w-[640px]">
            Update your account name and email address to keep your profile information accurate.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-[15px] font-bold mb-2">Full Name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Enter your full name"
                class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
            />
            @if ($errors->get('name'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div>
            <label for="email" class="block text-[15px] font-bold mb-2">Email Address</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                placeholder="Enter your email"
                class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
            />
            @if ($errors->get('email'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-[20px] border border-[#dbeee3] bg-[#f6fbf8] p-4">
                    <p class="text-sm text-[#49645a] leading-6">
                        Your email address is unverified.

                        <button form="send-verification" class="text-[#007b67] font-semibold hover:underline">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-[#007b67]">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="h-[56px] rounded-[18px] bg-[#00563f] hover:bg-[#004734] text-white font-bold text-[15px] px-8 transition"
            >
                Save Information
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#007b67] font-semibold"
                >Saved.</p>
            @endif
        </div>
    </form>
</section>
