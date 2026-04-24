<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/style.css', 'resources/js/app.js'])
    <title>Create Event - We Are Yan</title>
</head>
<body class="bg-[#f7f7f3] text-[#161616] font-sec min-h-screen">
    <main class="mx-auto max-w-3xl px-5 py-10">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#00563f]">
            <i class="fa-solid fa-arrow-left"></i>
            Back to dashboard
        </a>

        <section class="mt-8 rounded-[28px] border border-[#ece9e2] bg-white p-6 shadow-[0_10px_24px_rgba(0,0,0,0.03)] md:p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#8ca097]">Admin / Events</p>
            <h1 class="mt-3 text-3xl font-extrabold leading-tight md:text-4xl">Create Event</h1>
            <p class="mt-3 text-sm leading-7 text-[#6a6f6b]">
                Add a community event so donors can participate from their dashboard.
            </p>

            <form method="POST" action="{{ route('admin.events.store') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-bold text-[#2d3430]">Event Title</label>
                    <input
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-[#d8d8d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00563f]"
                        placeholder="Food collection day">
                    @error('title')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="city" class="block text-sm font-bold text-[#2d3430]">City</label>
                    <input
                        id="city"
                        name="city"
                        value="{{ old('city') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-[#d8d8d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00563f]"
                        placeholder="Casablanca">
                    @error('city')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_event" class="block text-sm font-bold text-[#2d3430]">Event Date</label>
                    <input
                        id="date_event"
                        name="date_event"
                        type="date"
                        value="{{ old('date_event') }}"
                        required
                        class="mt-2 w-full rounded-2xl border border-[#d8d8d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00563f]">
                    @error('date_event')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-bold text-[#2d3430]">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="mt-2 h-36 w-full resize-none rounded-2xl border border-[#d8d8d8] bg-white px-4 py-3 text-sm outline-none transition focus:border-[#00563f]"
                        placeholder="Explain what donors will do in this event...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#2563eb] px-7 py-3 text-sm font-semibold text-white transition hover:bg-[#004734]">
                    Create Event
                </button>
            </form>
        </section>
    </main>
</body>
</html>
