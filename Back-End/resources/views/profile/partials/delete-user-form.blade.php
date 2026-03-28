<section class="space-y-6">
    <header>
        <p class="text-red-500 font-semibold text-sm uppercase tracking-[0.18em]">Danger Zone</p>
        <h2 class="font-sec mt-3 text-3xl font-extrabold leading-tight text-[#111111]">
            Delete Account
        </h2>
        <p class="mt-3 text-[#6d6d6d] text-[15px] leading-7 max-w-[700px]">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Please make sure you really want to remove your account before continuing.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="h-[56px] rounded-[18px] bg-red-500 hover:bg-red-600 text-white font-bold text-[15px] px-8 transition"
    >
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 md:p-8">
            @csrf
            @method('delete')

            <h2 class="font-sec text-3xl font-extrabold text-[#111111]">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-4 text-[15px] text-[#6d6d6d] leading-7">
                This action is permanent. Enter your password to confirm that you want to delete your account.
            </p>

            <div class="mt-6">
                <label for="password" class="block text-[15px] font-bold mb-2">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Enter your password"
                    class="w-full h-[58px] rounded-[18px] border border-[#d8d8d8] px-5 outline-none focus:border-red-500 focus:ring-0 bg-[#fbfbfb]"
                />

                @if ($errors->userDeletion->get('password'))
                    <p class="text-red-500 text-sm mt-2">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="h-[52px] rounded-[16px] border border-[#d8d8d8] px-6 text-[#444] font-semibold hover:bg-[#f5f5f5] transition"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="h-[52px] rounded-[16px] bg-red-500 px-6 text-white font-semibold hover:bg-red-600 transition"
                >
                    Confirm Delete
                </button>
            </div>
        </form>
    </x-modal>
</section>
