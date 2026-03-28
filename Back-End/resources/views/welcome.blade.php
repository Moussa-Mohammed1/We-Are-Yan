<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>We Are Yan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite(['resources/css/style.css'])
</head>
<body class="bg-[#f7f7f5] text-[#111111] font-sec">

  <div class="max-w-[1440px] mx-auto">

    <header class="w-full px-10 md:px-16 lg:px-20 pt-8">
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <span class="text-[#007b67] text-3xl font-princ leading-none">We Are Yan</span>
        </div>

        <nav class="hidden md:flex items-center gap-10 text-[15px] font-medium text-[#1e1e1e]">
          <a href="#" class="text-[#007b67] font-semibold">Home</a>
          <a href="#">About Us</a>
          <a href="#">Services</a>
          <a href="#">Teams</a>
          <a href="#">Contact Us</a>
        </nav>

        <a href="{{ route('login') }}">
          <button class="bg-[#007b67] hover:bg-[#006554] text-white px-9 py-4 rounded-full text-[16px] font-semibold flex items-center gap-2">
            Donate
            <span>&rarr;</span>
          </button>
        </a>
      </div>
    </header>

    <section class="px-8 md:px-14 lg:px-20 pt-10">
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

      <p class="text-center text-[14px] text-[#5b5b5b] mt-10">
        Trusted by more than 5 million volunteers in 120 countries
      </p>

      <div class="mt-10 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-y-8 text-[#007b67] text-[18px] font-semibold items-center">
        <div class="flex items-center gap-2 justify-center lg:justify-start">
          <span>o</span><span>TEAMTALK</span>
        </div>
        <div class="flex items-center gap-2 justify-center">
          <span>*</span><span>ExDone</span>
        </div>
        <div class="flex items-center gap-2 justify-center">
          <span>+</span><span>NEXTFLOWS</span>
        </div>
        <div class="flex items-center gap-2 justify-center">
          <span>o</span><span>Globalchart</span>
        </div>
        <div class="flex items-center gap-2 justify-center">
          <span>[]</span><span>MarketSavy</span>
        </div>
        <div class="flex items-center gap-2 justify-center lg:justify-end">
          <span>*</span><span>EpicDev</span>
        </div>
      </div>
    </section>

    <section class="px-8 md:px-14 lg:px-20 pt-24">
      <div class="border border-[#7f7f7f] rounded-[42px] px-8 md:px-12 py-10 flex flex-col lg:flex-row items-center justify-between gap-10">
        <div class="w-full lg:w-[48%]">
          <p class="text-[#007b67] text-[54px] font-extrabold leading-none font-princ">
            $20<span class="text-[16px] font-medium text-[#444] align-middle"> /MON</span>
          </p>
          <p class="text-[11px] text-[#6b6b6b] mt-2">&copy; Make One Time Donation</p>

          <h2 class="text-[58px] leading-[1.05] font-princ mt-8 max-w-[560px]">
            Share Food With Others Who Is In Need
          </h2>

          <p class="text-[15px] text-[#666] mt-6 max-w-[560px] leading-7">
            In carrying out their duties, charitable foundations provide a variety of social services
            such as education, food, medicine, housing, and others
          </p>

          <div class="flex justify-between text-[13px] text-[#555] mt-8 font-medium">
            <span>Raised : $69,152</span>
            <span>Goal : $89,000</span>
          </div>

          <div class="w-full h-[12px] bg-[#d8d8d8] rounded-full mt-3 overflow-hidden">
            <div class="h-full w-[65%] bg-[#007b67] rounded-full"></div>
          </div>

          <button class="mt-8 bg-[#007b67] hover:bg-[#006554] text-white rounded-full px-12 py-4 text-[22px] font-semibold w-[290px]">
            Donate Now
          </button>
        </div>

        <div class="w-full lg:w-[42%]">
          <img src="{{ Vite::asset('resources/images/téléchargement (20).jpeg') }}" alt="Donation" class="w-full h-[420px] object-cover rounded-[34px]">
        </div>
      </div>
    </section>

    <section class="px-8 md:px-14 lg:px-20 pt-24">
      <div class="bg-[#01563f] rounded-[70px] px-10 md:px-16 py-16 text-white">
        <h2 class="text-center text-[54px] font-princ">How To Start Help</h2>
        <p class="text-center text-[14px] text-white/70 max-w-[720px] mx-auto mt-4 leading-6">
          In carrying out their duties, charitable foundations provide a variety of social services such as
          education, food, medicine, housing, and others
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-16 text-center">
          <div>
            <div class="flex justify-center mb-6">
              <svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="10" cy="7" r="4"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
              </svg>
            </div>
            <h3 class="text-[34px] font-bold">Register Yourself</h3>
            <p class="text-[14px] text-white/75 mt-4 leading-6">
              Sign up to join and be part of the great people who love to share
            </p>
          </div>

          <div>
            <div class="flex justify-center mb-6">
              <svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                <path d="M12 2v6"/>
                <path d="M12 16v6"/>
                <path d="M4.93 4.93l4.24 4.24"/>
                <path d="M14.83 14.83l4.24 4.24"/>
                <path d="M2 12h6"/>
                <path d="M16 12h6"/>
                <path d="M4.93 19.07l4.24-4.24"/>
                <path d="M14.83 9.17l4.24-4.24"/>
              </svg>
            </div>
            <h3 class="text-[34px] font-bold">Select Donate</h3>
            <p class="text-[14px] text-white/75 mt-4 leading-6">
              There are many things you can choose to share goodness with
            </p>
          </div>

          <div>
            <div class="flex justify-center mb-6">
              <svg width="54" height="54" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                <circle cx="12" cy="12" r="10"/>
                <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                <line x1="9" y1="9" x2="9.01" y2="9"/>
                <line x1="15" y1="9" x2="15.01" y2="9"/>
              </svg>
            </div>
            <h3 class="text-[34px] font-bold">Share Happiness</h3>
            <p class="text-[14px] text-white/75 mt-4 leading-6">
              Sharing happiness with those less and doing more good for others
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="px-8 md:px-14 lg:px-20 pt-28 pb-20">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <div>
          <h2 class="text-[60px] leading-[1.05] font-princ max-w-[500px]">
            Find Answers to Your Donation Questions
          </h2>
          <p class="text-[15px] text-[#777] mt-6 max-w-[400px] leading-7">
            Et felis vitae ac venenatis lacus cras etiam risus scelerisque auctor adipiscing in a porta
          </p>

          <div class="mt-16 ml-8">
            <svg width="180" height="140" viewBox="0 0 180 140" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M83 5C61 13 50 40 62 58C73 75 107 79 114 58C121 36 103 22 86 32C67 43 58 67 66 90C75 114 107 126 151 126" stroke="#007b67" stroke-width="3" stroke-linecap="round"/>
              <path d="M142 117L151 126L141 133" stroke="#007b67" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>

        <div class="space-y-5">
          <details class="bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <summary class="cursor-pointer list-none flex items-center justify-between text-[15px] font-medium">
              Is there a free trial?
              <span>+</span>
            </summary>
          </details>

          <details open class="bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <summary class="cursor-pointer list-none flex items-center justify-between text-[15px] font-semibold text-[#007b67]">
              How many courses can I take at the same time?
              <span class="text-[#1e1e1e]">-</span>
            </summary>
            <p class="text-[13px] text-[#666] leading-6 mt-5">
              Adipiscing sagittis neque egestas id platea accumsan. Morbi nisi platea urna curabitur habitant pulvinar
              lacinia neque. Netus gravida amet, aliquam quam turpis aliquet cras. Erat adipiscing dolor in reprehenderit
              voluptate velit esse cillum dolore eu nulla pariatur. Sit amet, adipiscing elit.
            </p>
          </details>

          <details class="bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <summary class="cursor-pointer list-none flex items-center justify-between text-[15px] font-medium">
              How can I choose my teacher?
              <span>+</span>
            </summary>
          </details>

          <details class="bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <summary class="cursor-pointer list-none flex items-center justify-between text-[15px] font-medium">
              How much do the courses cost?
              <span>+</span>
            </summary>
          </details>

          <details class="bg-transparent border border-[#8a8a8a] rounded-2xl px-6 py-5">
            <summary class="cursor-pointer list-none flex items-center justify-between text-[15px] font-medium">
              How can I track my progress?
              <span>+</span>
            </summary>
          </details>
        </div>
      </div>
    </section>

    <section class="bg-[#01563f] mt-10 px-8 md:px-14 lg:px-20 py-20">
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
          <div class="bg-white rounded-full p-2 flex items-center justify-between">
            <input
              type="email"
              placeholder="Enter your email"
              class="flex-1 px-8 py-5 rounded-full outline-none text-[16px] text-[#333] bg-transparent"
            />
            <button class="bg-[#007b67] hover:bg-[#006554] text-white px-10 py-5 rounded-full text-[16px] font-semibold min-w-[170px]">
              Subscribe
            </button>
          </div>
        </div>
      </div>
    </section>

    <footer class="bg-[#f7f7f5] px-8 md:px-14 lg:px-20 py-14">
      <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
        <div>
          <img src="{{ Vite::asset('resources/images/téléchargement (21).jpeg') }}" alt="Community support" class="h-20 w-20 object-cover rounded-2xl">
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

</body>
</html>
