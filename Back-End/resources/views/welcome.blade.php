<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>We Are Yan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f5] text-[#111111] font-sec">

  <div class="max-w-[1440px] mx-auto">

    <header class="w-full px-10 md:px-16 lg:px-20 pt-8">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-16 object-contain">
        </div>

        <nav class="hidden md:flex items-center gap-10 text-[15px] font-medium text-[#1e1e1e]">
          <a href="#home" class="text-[#007b67] font-semibold">Home</a>
          <a href="#featured-request">Featured Request</a>
          <a href="#how-to-help">How To Help</a>
          <a href="#faq">FAQ</a>
          <a href="#newsletter">Newsletter</a>
        </nav>

        <a href="{{ route('login') }}">
          <button class="bg-[#00563f] hover:bg-[#004734] text-white px-9 py-4 rounded-full text-[16px] font-semibold flex items-center gap-2">
            Donate
            <span>&rarr;</span>
          </button>
        </a>
      </div>
    </header>

    <section id="home" class="px-8 md:px-14 lg:px-20 pt-10">
      <div class="text-center">
        <h1 class="text-[#007b67] text-[56px] md:text-[74px] leading-[0.95] font-princ max-w-[920px] mx-auto">
          Connecting Help to Those Who Need It
        </h1>
      </div>

      <div class="mt-12 flex flex-col lg:flex-row items-end justify-center gap-8">
        <div class="w-full lg:w-[300px]">
          <img src="{{ Vite::asset('resources/images/Angelina Jolie meets the forgotten children of Burma.jpeg') }}" alt="Children" class="w-full h-[460px] object-cover rounded-[34px]">
        </div>

        <div class="w-full lg:w-[560px]">
          <img src="{{ Vite::asset('resources/images/charity event.jpeg') }}" alt="Beneficiaire" class="w-full h-[300px] object-cover rounded-[34px]">
          <div class="mt-4 bg-[#005a47] rounded-[24px] py-6 text-center text-white">
            <h2 class="text-[43px] font-extrabold leading-none">1200 <span class="font-princ text-[30px]">Beneficiaire</span></h2>
            <p class="text-[28px] font-bold mt-2 uppercase">In Morocco 2025</p>
          </div>
        </div>

        <div class="w-full lg:w-[300px]">
          <img src="{{ Vite::asset('resources/images/David Beckham admits Brooklyn is embarrassed by his doting father.jpeg') }}" alt="Community" class="w-full h-[460px] object-cover rounded-[34px]">
        </div>
      </div>

    </section>

    <section id="featured-request" class="px-8 md:px-14 lg:px-20 pt-24">
      <div class="rounded-[34px] border border-[#d8d8d8] bg-white p-6 shadow-[0_12px_30px_rgba(0,0,0,0.04)] md:p-8">
        <p class="text-[#007b67] font-semibold text-sm uppercase tracking-[0.18em]">Featured Request</p>

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
          <div>
            @if ($featuredAnnonce?->image)
              <img src="{{ asset('storage/' . $featuredAnnonce->image) }}" alt="{{ $featuredAnnonce->title }}" class="w-full h-[360px] object-cover rounded-[26px]">
            @else
              <div class="w-full h-[360px] rounded-[26px] bg-[#eef6f3] border border-[#d7e9e2] flex items-center justify-center text-center px-8">
                <p class="text-[18px] uppercase tracking-[0.18em] text-[#007b67] font-semibold">No image yet</p>
              </div>
            @endif
          </div>

          <div>
            <h2 class="text-[42px] leading-[1.05] font-princ md:text-[56px]">
              {{ $featuredAnnonce?->title ?? 'Support the next request' }}
            </h2>

            <p class="mt-6 text-[15px] text-[#666] leading-7 max-w-[620px]">
              {{ $featuredAnnonce ? \Illuminate\Support\Str::limit($featuredAnnonce->description, 220) : 'Join We Are Yan today so you are ready to support verified requests as soon as they are published.' }}
            </p>

            <a href="{{ route('register') }}" class="inline-flex mt-8 bg-[#00563f] hover:bg-[#004734] text-white rounded-full px-10 py-4 text-[18px] font-semibold justify-center">
              Support Now
            </a>
          </div>
        </div>
      </div>
    </section>

    <section id="how-to-help" class="px-8 md:px-14 lg:px-20 pt-24">
      <div class="bg-[#01563f] rounded-[70px] px-10 md:px-16 py-16 text-white">
        <h2 class="text-center text-[54px] font-princ">How To Start Help</h2>
        <p class="text-center text-[14px] text-white/70 max-w-[720px] mx-auto mt-4 leading-6">
          In carrying out their duties, charitable foundations provide a variety of social services such as
          education, food, medicine, housing, and others
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-16 text-center">
          <div>
            <div class="flex justify-center mb-6">
              <i class="fa-solid fa-users text-[54px] text-white"></i>
            </div>
            <h3 class="text-[34px] font-bold">Register Yourself</h3>
            <p class="text-[14px] text-white/75 mt-4 leading-6">
              Sign up to join and be part of the great people who love to share
            </p>
          </div>

          <div>
            <div class="flex justify-center mb-6">
              <i class="fa-solid fa-hand-holding-heart text-[54px] text-white"></i>
            </div>
            <h3 class="text-[34px] font-bold">Select Donate</h3>
            <p class="text-[14px] text-white/75 mt-4 leading-6">
              There are many things you can choose to share goodness with
            </p>
          </div>

          <div>
            <div class="flex justify-center mb-6">
              <i class="fa-regular fa-face-smile text-[54px] text-white"></i>
            </div>
            <h3 class="text-[34px] font-bold">Share Happiness</h3>
            <p class="text-[14px] text-white/75 mt-4 leading-6">
              Sharing happiness with those less and doing more good for others
            </p>
          </div>
        </div>
      </div>
    </section>

    <section id="faq" class="px-8 md:px-14 lg:px-20 pt-28 pb-20">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div>
          <h2 class="text-[60px] leading-[1.05] font-princ max-w-[500px]">
            Find Answers About Requests, Donations, And Community Support
          </h2>
          <p class="text-[15px] text-[#777] mt-6 max-w-[400px] leading-7">
            Learn how We Are Yan connects donors with verified needs, how requests are reviewed, and how support reaches people who need it most.
          </p>

          <div class="mt-16 ml-8">
            <div class="text-[#007b67]">
              <i class="fa-solid fa-arrow-right-long text-[120px] rotate-[25deg]"></i>
            </div>
          </div>
        </div>

        <div class="space-y-5">
          <div class="faq-item bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <button type="button" class="faq-toggle w-full flex items-center justify-between text-left text-[15px] font-medium" aria-expanded="false">
              <span>How do I post a request for help?</span>
              <span class="faq-icon text-[#1e1e1e]">+</span>
            </button>
            <div class="faq-answer hidden">
              <p class="text-[13px] text-[#666] leading-6 mt-5">
                Create a beneficiary account, open your dashboard, and complete the request form with the title, category, quantity, city, urgency, and a clear description of your need.
              </p>
            </div>
          </div>

          <div class="faq-item bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <button type="button" class="faq-toggle w-full flex items-center justify-between text-left text-[15px] font-semibold text-[#007b67]" aria-expanded="true">
              <span>How are donation requests reviewed before they appear?</span>
              <span class="faq-icon text-[#1e1e1e]">-</span>
            </button>
            <div class="faq-answer">
              <p class="text-[13px] text-[#666] leading-6 mt-5">
                Every request is checked by the administrative team before publication. This review helps confirm the request details, keep the platform safe, and make sure donors see clear and relevant needs.
              </p>
            </div>
          </div>

          <div class="faq-item bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <button type="button" class="faq-toggle w-full flex items-center justify-between text-left text-[15px] font-medium" aria-expanded="false">
              <span>Who can create requests and who can donate?</span>
              <span class="faq-icon text-[#1e1e1e]">+</span>
            </button>
            <div class="faq-answer hidden">
              <p class="text-[13px] text-[#666] leading-6 mt-5">
                Beneficiaries create requests for help, and donors browse accepted annonces to support people, families, and communities through the platform.
              </p>
            </div>
          </div>

          <div class="faq-item bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <button type="button" class="faq-toggle w-full flex items-center justify-between text-left text-[15px] font-medium" aria-expanded="false">
              <span>What types of needs can be shared on the platform?</span>
              <span class="faq-icon text-[#1e1e1e]">+</span>
            </button>
            <div class="faq-answer hidden">
              <p class="text-[13px] text-[#666] leading-6 mt-5">
                Requests can include essential items such as food, clothing, school supplies, medicine, shelter support, or other urgent community needs that match the platform rules.
              </p>
            </div>
          </div>

          <div class="faq-item bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <button type="button" class="faq-toggle w-full flex items-center justify-between text-left text-[15px] font-medium" aria-expanded="false">
              <span>How can I follow the status of my request?</span>
              <span class="faq-icon text-[#1e1e1e]">+</span>
            </button>
            <div class="faq-answer hidden">
              <p class="text-[13px] text-[#666] leading-6 mt-5">
                After logging in as a beneficiary, you can open your dashboard to view your annonces and track whether each request is pending, accepted, or rejected.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="newsletter" class="bg-[#01563f] mt-10 px-8 md:px-14 lg:px-20 py-20">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
        <div>
          <h2 class="text-white text-[55px] leading-[1.1] font-princ max-w-[500px]">
            Sign up for our Newsletter
          </h2>
          <p class="text-white/75 text-[16px] mt-6">
            Stay in the loop with everything you need to know.
          </p>
        </div>

        <div class="w-full lg:w-[620px]">
          <form action="{{ route('register') }}" method="GET" class="bg-white rounded-full p-2 flex items-center justify-between">
            <input
              type="email"
              placeholder="Enter your email"
              class="flex-1 px-8 py-5 rounded-full outline-none text-[16px] text-[#333] bg-transparent"
            />
            <button type="submit" class="bg-[#00563f] hover:bg-[#004734] text-white px-10 py-5 rounded-full text-[16px] font-semibold min-w-[170px]">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </section>

    <footer class="bg-[#f7f7f5] px-8 md:px-14 lg:px-20 py-14">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
        <div>
          <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-20 object-contain">
        </div>

        <div class="flex flex-wrap justify-center gap-12 text-[16px] font-medium text-[#333]">
          <a href="#">Donations</a>
          <a href="#">Popular Causes</a>
          <a href="#">UpComing Event</a>
          <a href="#">Latest Blog</a>
          <a href="#">Careers</a>
          <a href="#">Help</a>
          <a href="#">Privacy</a>
        </div>
      </div>

      <p class="text-center text-[14px] text-[#8a8a8a] mt-10">
        &copy; 2026 We Are Yan. All rights reserved.
      </p>
    </footer>

  </div>

  <script>
    const faqToggles = document.querySelectorAll('.faq-toggle');

    faqToggles.forEach((toggle) => {
      toggle.addEventListener('click', () => {
        const item = toggle.closest('.faq-item');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.faq-icon');
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';

        faqToggles.forEach((otherToggle) => {
          const otherItem = otherToggle.closest('.faq-item');
          const otherAnswer = otherItem.querySelector('.faq-answer');
          const otherIcon = otherItem.querySelector('.faq-icon');

          otherToggle.setAttribute('aria-expanded', 'false');
          otherToggle.classList.remove('text-[#007b67]', 'font-semibold');
          otherToggle.classList.add('font-medium');
          otherAnswer.classList.add('hidden');
          otherIcon.textContent = '+';
        });

        if (!isOpen) {
          toggle.setAttribute('aria-expanded', 'true');
          toggle.classList.add('text-[#007b67]', 'font-semibold');
          toggle.classList.remove('font-medium');
          answer.classList.remove('hidden');
          icon.textContent = '-';
        }
      });
    });
  </script>

</body>
</html>
