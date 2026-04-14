<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>Chat With Beneficiary - We Are Yan</title>
</head>
<body class="bg-[#f6f5f2] text-[#111111] font-sec min-h-screen">
    @php
        $annonce = $conversation->donation->annonce;
        $otherUser = $user->id === $conversation->donor_id ? $conversation->beneficiary : $conversation->donor;
    @endphp

    <main class="max-w-5xl mx-auto px-6 py-8">
        <header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center">
                <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-14 object-contain">
            </a>

            @if ($user->id === $conversation->donor_id)
                <a href="{{ route('annonces.show', $annonce) }}" class="px-5 py-3 rounded-full border border-[#d8d8d8] bg-white font-semibold hover:bg-[#f3f3f3] transition">
                    Back To Annonce
                </a>
            @else
                <a href="{{ route('beneficiary.dashboard') }}" class="px-5 py-3 rounded-full border border-[#d8d8d8] bg-white font-semibold hover:bg-[#f3f3f3] transition">
                    Back Dashboard
                </a>
            @endif
        </header>

        <section class="grid grid-cols-1 lg:grid-cols-[320px_1fr] gap-6 items-start">
            <aside class="bg-white border border-[#e7e3db] rounded-[28px] p-6 shadow-sm">
                <p class="text-sm uppercase tracking-[0.16em] text-[#777] font-semibold">Chat With</p>
                <h1 class="mt-2 text-3xl font-bold">{{ $otherUser?->name ?? 'Unknown user' }}</h1>
                <p class="mt-2 text-[#666] break-all">{{ $otherUser?->email ?? 'No email available' }}</p>

                <div class="mt-6 border-t border-[#eee] pt-5">
                    <p class="text-sm uppercase tracking-[0.16em] text-[#777] font-semibold">Annonce</p>
                    <h2 class="mt-2 text-xl font-bold">{{ $annonce->title }}</h2>
                    <p class="mt-2 text-[#666]">{{ $annonce->category }} - {{ $annonce->city }}</p>
                </div>
            </aside>

            <section class="bg-white border border-[#e7e3db] rounded-[28px] p-6 md:p-8 shadow-sm">
                <p class="text-sm uppercase tracking-[0.16em] text-[#777] font-semibold">Chat</p>
                <h2 class="mt-2 text-3xl font-bold">Chat With {{ $otherUser?->name ?? 'User' }}</h2>
                <p class="mt-3 text-[#666] leading-7">
                    Send a simple message. It will be saved in the database.
                </p>

                <div class="mt-8 rounded-[24px] h-[600px] border-[1px] border-[#5e6865] bg-[#fbfbfb] p-6 flex flex-col gap-4">
                    <div class="flex-1 overflow-y-auto space-y-3">
                        @forelse ($conversation->messages as $message)
                            <div class="flex {{ $message->sender_id === $user->id ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[75%] rounded-[18px] px-4 py-3 {{ $message->sender_id === $user->id ? 'bg-[#00563f] text-white' : 'bg-white border border-[#e7e3db]' }}">
                                    <p class="text-xs opacity-70">{{ $message->sender?->name ?? 'User' }}</p>
                                    <p class="mt-1">{{ $message->content }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-[#777]">No messages yet.</p>
                        @endforelse
                    </div>

                    <form method="POST" action="{{ route('chat.messages.store', $conversation) }}" class="place-msg flex gap-3">
                        @csrf
                        <input
                            id="messageInput"
                            name="content"
                            type="text"
                            placeholder="Type message..."
                            class="flex-1 rounded-full border border-[#d8d8d8] bg-white px-5 py-3 outline-none focus:border-[#00563f]">
                        <button type="submit" class="rounded-full bg-[#00563f] px-6 py-3 font-bold text-white hover:bg-[#004734]">
                            Send
                        </button>
                    </form>
                </div>
            </section>
        </section>
    </main>

    <script>
        const messageInput = document.getElementById('messageInput');

        setInterval(function () {
            if (document.activeElement !== messageInput) {
                window.location.reload();
            }
        }, 5000);
    </script>
</body>
</html>
