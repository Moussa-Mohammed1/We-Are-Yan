<section>
    <header>
        <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Security</p>
        <h2 class="font-sec mt-3 text-3xl font-extrabold leading-tight text-[#111111]">
            Update Password
        </h2>
        <p class="mt-3 text-[#6d6d6d] text-[15px] leading-7 max-w-[640px]">
            Choose a strong password to keep your account secure and protected.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-[15px] font-bold mb-2">Current Password</label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                placeholder="Enter current password"
                class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
            />
            @if ($errors->updatePassword->get('current_password'))
                <p class="text-red-500 text-sm mt-2">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="update_password_password" class="block text-[15px] font-bold mb-2">New Password</label>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Create a new password"
                    class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                />
                @if ($errors->updatePassword->get('password'))
                    <p class="text-red-500 text-sm mt-2">{{ $errors->updatePassword->first('password') }}</p>
                @endif
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-[15px] font-bold mb-2">Confirm Password</label>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                    class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-[#007b67] focus:ring-0 bg-[#fbfbfb]"
                />
                @if ($errors->updatePassword->get('password_confirmation'))
                    <p class="text-red-500 text-sm mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="h-[56px] rounded-[18px] bg-[#007b67] hover:bg-[#006554] text-white font-bold text-[15px] px-8 transition"
            >
                Save Password
            </button>

            @if (session('status') === 'password-updated')
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
