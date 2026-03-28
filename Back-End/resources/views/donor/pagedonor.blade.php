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
                <p class="uppercase tracking-widest text-sm mb-2 opacity-90 font-semibold">Online Course</p>
                <h1 class="text-4xl font-bold leading-tight mb-6">Sharpen Your Skills With Professional Online Courses</h1>
                <button class="bg-gray-900 text-white px-8 py-3 rounded-full flex items-center space-x-3 hover:bg-black">
                    <span>Join Now</span>
                    <span class="bg-white text-black rounded-full w-6 h-6 flex items-center justify-center text-xs">→</span>
                </button>
            </div>
            <div class="absolute top-0 right-0 w-64 h-full bg-teal-500 opacity-20 -skew-x-12 translate-x-10"></div>
            <div class="absolute top-10 right-20 text-teal-400 opacity-30 text-6xl">✦</div>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-800 mb-8">Let's Give Help To<br>Those In Need</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            
            <script>
                const cardData = [
                    { tag: 'URGENT', color: 'text-red-500 border-red-500' },
                    { tag: 'CRITICAL', color: 'text-orange-500 border-orange-500' },
                    { tag: 'NORMAL', color: 'text-green-500 border-green-500' },
                    { tag: 'URGENT', color: 'text-red-500 border-red-500' },
                    { tag: 'CRITICAL', color: 'text-orange-500 border-orange-500' },
                    { tag: 'NORMAL', color: 'text-green-500 border-green-500' }
                ];

                document.write(cardData.map(card => `
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                        <div class="p-4">
                            <img src="https://via.placeholder.com/400x300" alt="Cause" class="w-full h-48 object-cover rounded-2xl mb-4">
                            
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-teal-600 font-bold text-lg">$20<span class="text-xs text-gray-400">/MON</span></span>
                                <span class="border ${card.color} text-[10px] px-2 py-0.5 rounded italic">${card.tag}</span>
                            </div>
                            
                            <h3 class="font-bold text-gray-800 text-lg mb-2">Share Food With Others In Need</h3>
                            <p class="text-gray-500 text-xs leading-relaxed mb-4">
                                In carrying out their duties, charitable foundations food, medicine, food.
                            </p>

                            <div class="flex justify-between text-[10px] mb-1 font-semibold text-gray-400">
                                <span>Raised: $84,702</span>
                                <span>Goal: $90,000</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5 mb-6">
                                <div class="bg-teal-600 h-1.5 rounded-full" style="width: 85%"></div>
                            </div>

                            <button class="w-full bg-teal-800 text-white py-3 rounded-xl font-bold hover:bg-teal-900 transition">
                                Donate Now
                            </button>
                        </div>
                    </div>
                `).join(''));
            </script>

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
