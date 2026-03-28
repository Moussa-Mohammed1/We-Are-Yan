<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Donation Request - We Are Yan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @vite(['resources/css/style.css'])
</head>

<body class="bg-[#f6f5f2] text-[#111111] font-sec">

  <div class="max-w-[1440px] mx-auto min-h-screen flex flex-col">

    <header class="w-full px-8 md:px-14 lg:px-20 pt-6">
      <div class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="flex items-center">
          <img src="{{ Vite::asset('resources/images/logowry.png') }}" alt="Logo" class="h-14 object-contain">
        </a>

        <nav class="hidden md:flex items-center gap-10 text-[15px] font-medium text-[#1d1d1d]">
          <a href="{{ url('/') }}" class="text-[#007b67] font-semibold">Home</a>
          <a href="#">About Us</a>
          <a href="#">Services</a>
          <a href="#">Teams</a>
          <a href="#">Contact Us</a>
        </nav>

        <a href="{{ route('dashboard') }}"
          class="bg-[#007b67] text-white px-8 py-4 rounded-full text-[15px] font-semibold flex items-center gap-2 hover:bg-[#006554] transition">
          Back Dashboard
          <span>&rarr;</span>
        </a>
      </div>
    </header>

    <main class="flex-1 px-8 md:px-14 lg:px-20 pt-14 pb-20">
      <div class="text-[14px] text-[#6d6d6d] font-medium mb-10">
        <span class="text-[#007b67]">Dashboard</span>
        <span class="mx-2">&gt;</span>
        <span>Create Donation Request</span>
      </div>

      <div class="grid grid-cols-1 xl:grid-cols-[1fr_420px] gap-10 items-start">
        <div>
          <h1 class="text-[56px] leading-[1.05] font-princ font-bold tracking-[-0.02em] text-[#007b67]">
            Post Your Need
          </h1>
          <p class="text-[16px] text-[#666666] mt-4 max-w-[760px] leading-6">
            Connect with our community. Please fill out the form accurately. Note that all
            posts are manually reviewed by our moderation team.
          </p>

          <div class="mt-8 bg-[#00563f] text-white rounded-[28px] px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4 shadow-[0_10px_30px_rgba(0,0,0,0.08)]">
            <div>
              <p class="text-white/70 text-[13px] uppercase tracking-[0.18em] font-semibold">Posting As</p>
              <h2 class="font-princ text-3xl mt-2">{{ $user->name }}</h2>
            </div>

            <div class="flex flex-wrap gap-3 text-sm">
              <span class="px-4 py-2 rounded-full bg-white/10">Role: {{ ucfirst($user->role) }}</span>
              <span class="px-4 py-2 rounded-full bg-white/10">City: {{ $user->city ?: 'Not set' }}</span>
            </div>
          </div>

          <div class="mt-10 bg-white border border-[#dfdfdf] rounded-[28px] px-8 py-7 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
            <div class="flex items-center justify-between">
              <h3 class="text-[18px] font-bold text-[#111111]">Step 1: Request Basics</h3>
              <span class="text-[18px] font-bold text-[#1a6f58]">35% Complete</span>
            </div>

            <div class="mt-6 h-[24px] w-full rounded-full bg-[#e9e9e9] overflow-hidden">
              <div class="h-full w-[45%] bg-[#00563f] rounded-full"></div>
            </div>

            <p class="text-[12px] text-[#8a8a8a] mt-4">
              Step 1 of 3: Define what you need and why.
            </p>
          </div>

          <section class="mt-10 bg-white border border-[#dfdfdf] rounded-[32px] px-8 py-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
            <div class="flex items-center gap-4 mb-10">
              <div class="w-10 h-10 rounded-[4px] bg-[#00563f]"></div>
              <h2 class="text-[22px] font-bold">1. Basic Information</h2>
            </div>

            <div class="space-y-7">
              <div>
                <label class="block text-[16px] font-bold mb-3">Request Title</label>
                <input
                  id="requestTitle"
                  type="text"
                  placeholder="ex : Need warm blankets for local shelter"
                  class="w-full h-[62px] rounded-[16px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 text-[16px] placeholder:text-[#b0b0b0] outline-none focus:border-[#007b67]" />
              </div>

              <div>
                <label class="block text-[16px] font-bold mb-3">Category</label>
                <input
                  id="requestCategory"
                  type="text"
                  placeholder="ex : Clothing & Textiles"
                  class="w-full h-[62px] rounded-[16px] border border-[#d8d8d8] bg-[#fbfbfb] px-5 text-[16px] placeholder:text-[#b0b0b0] outline-none focus:border-[#007b67]" />
              </div>
            </div>
          </section>

          <section class="mt-10 bg-white border border-[#dfdfdf] rounded-[32px] px-8 py-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
            <div class="flex items-center gap-4 mb-10">
              <div class="w-10 h-10 rounded-[4px] bg-[#00563f]"></div>
              <h2 class="text-[22px] font-bold">2. Needs Details</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-[240px_1fr] gap-10">
              <div>
                <label class="block text-[16px] font-bold mb-3">Quantity Needed</label>
                <input
                  id="requestQuantity"
                  type="number"
                  placeholder="0"
                  class="w-full h-[60px] rounded-[16px] border border-[#d8d8d8] bg-[#fbfbfb] px-4 text-[16px] placeholder:text-[#b0b0b0] outline-none focus:border-[#007b67]" />
              </div>

              <div>
                <label class="block text-[16px] font-bold mb-3">Urgency Level</label>
                <input id="urgencyLevel" type="hidden" value="urgent" />
                <div class="flex flex-wrap gap-4">
                  <button
                    type="button"
                    data-urgency="urgent"
                    class="urgency-button px-8 h-[42px] rounded-[12px] border-2 border-red-500 text-red-500 text-[16px] font-semibold bg-white transition">
                    Urgent
                  </button>
                  <button
                    type="button"
                    data-urgency="critical"
                    class="urgency-button px-8 h-[42px] rounded-[12px] border-2 border-amber-500 text-amber-500 text-[16px] font-semibold bg-white transition">
                    Critical
                  </button>
                  <button
                    type="button"
                    data-urgency="normal"
                    class="urgency-button px-8 h-[42px] rounded-[12px] border-2 border-lime-600 text-lime-600 text-[16px] font-semibold bg-white transition">
                    Normal
                  </button>
                </div>
              </div>
            </div>

            <div class="mt-8">
              <label class="block text-[16px] font-bold mb-3">Detailed Description</label>
              <textarea
                id="requestDescription"
                placeholder="Describe your situation ..."
                class="w-full h-[180px] rounded-[16px] border border-[#d8d8d8] bg-[#fbfbfb] px-4 py-4 text-[16px] placeholder:text-[#b0b0b0] outline-none resize-none focus:border-[#007b67]"></textarea>
            </div>
          </section>

          <section class="mt-10 bg-white border border-[#dfdfdf] rounded-[32px] px-8 py-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
            <div class="flex items-center gap-4 mb-10">
              <div class="w-10 h-10 rounded-[4px] bg-[#00563f]"></div>
              <h2 class="text-[22px] font-bold">3. Location Information</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-[270px_1fr] gap-10 items-start">
              <div>
                <label class="block text-[16px] font-bold mb-3">City / Region</label>
                <input
                  id="requestCity"
                  type="text"
                  value="{{ $user->city }}"
                  placeholder="ex : Casablanca"
                  class="w-full h-[62px] rounded-[16px] border border-[#d8d8d8] bg-[#fbfbfb] px-4 text-[16px] placeholder:text-[#b0b0b0] outline-none focus:border-[#007b67]" />
              </div>

              <div>
                <div class="w-full max-w-[420px] h-[260px] rounded-[18px] overflow-hidden border border-[#d6d6d6]">
                  <iframe
                    id="cityMap"
                    title="City map"
                    class="w-full h-full"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps?q={{ urlencode(($user->city ?: 'Casablanca') . ', Morocco') }}&output=embed">
                  </iframe>
                </div>
              </div>
            </div>
          </section>

          <section class="mt-10 bg-white border border-[#dfdfdf] rounded-[32px] px-8 py-8 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
            <div class="flex items-center gap-4 mb-10">
              <div class="w-10 h-10 rounded-[4px] bg-[#00563f]"></div>
              <h2 class="text-[22px] font-bold">4. Request Image</h2>
            </div>

            <div class="space-y-6">
              <div>
                <label class="block text-[16px] font-bold mb-3">Upload Image</label>

                <label
                  for="requestImage"
                  class="w-full min-h-[180px] rounded-[18px] border-2 border-dashed border-[#bfbfbf] bg-white/60 flex flex-col items-center justify-center text-center px-6 cursor-pointer hover:border-[#007b67] transition">
                  <svg class="w-12 h-12 text-[#007b67] mb-4" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path d="M12 16V4"></path>
                    <path d="M8 8l4-4 4 4"></path>
                    <path d="M20 16.58A5 5 0 0018 7h-1.26A8 8 0 104 16.25"></path>
                    <path d="M8 16l4 4 4-4"></path>
                  </svg>

                  <p class="text-[18px] font-bold text-[#111111]">Click to upload an image</p>
                  <p class="text-[14px] text-[#777] mt-2">PNG, JPG, JPEG up to 5MB</p>
                </label>

                <input id="requestImage" type="file" accept="image/*" class="hidden" />

                <p id="fileName" class="text-[14px] text-[#777] mt-4">
                  No image selected
                </p>
              </div>
            </div>
          </section>

          <div class="mt-10 bg-[#dff4e5] border border-[#84c6a0] rounded-[24px] px-8 py-7 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-start gap-5">
              <div class="w-14 h-14 rounded-full border-2 border-[#0c5a45] flex items-center justify-center shrink-0 mt-1">
                <svg class="w-7 h-7 text-[#0c5a45]" fill="none" stroke="currentColor" stroke-width="2.2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12.5l1.7 1.7 3.3-3.7" />
                </svg>
              </div>
              <p class="text-[12px] md:text-[14px] text-black/50 leading-6 max-w-[620px]">
                Your request will be submitted to our administrative team.<br>
                Approval usually takes <span class="text-black font-bold">24-48 hours</span> before it appears to
                donors.
              </p>
            </div>

            <button
              class="h-[64px] w-[200px] px-8 rounded-[16px] bg-[#007b67] text-white text-[18px] font-bold self-start md:self-auto hover:bg-[#006554] transition">
              Next Step
            </button>
          </div>
        </div>

        <aside class="xl:pt-[92px]">
          <h2 class="text-[43px] leading-none font-princ font-bold mb-8 text-[#007b67]">Live Preview</h2>

          <div class="bg-white border border-[#dfdfdf] rounded-[24px] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.04)] max-w-[420px]">
            <div
              id="previewImageContainer"
              class="bg-[#e6e6e6] h-[250px] relative flex items-center justify-center overflow-hidden">
              <div class="absolute top-5 right-5 z-10">
                <span
                  id="previewUrgencyBadge"
                  class="bg-red-500 text-white text-[14px] font-semibold px-5 py-2 rounded-full">
                  Urgent
                </span>
              </div>

              <img id="previewImage" src="" alt="Preview" class="hidden w-full h-full object-cover">

              <div id="previewPlaceholder" class="flex items-center justify-center">
                <svg class="w-20 h-20 text-[#1f1f1f]" fill="none" stroke="currentColor" stroke-width="1.8"
                  viewBox="0 0 24 24">
                  <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                  <circle cx="16.5" cy="9.5" r="1.5"></circle>
                  <path d="M21 15l-5-5L5 21"></path>
                </svg>
              </div>
            </div>

            <div class="p-6">
              <div class="flex items-center gap-3 mb-5">
                <span
                  id="previewCategoryBadge"
                  class="bg-[#69b6a4] text-white text-[13px] font-semibold px-4 py-1.5 rounded-[6px] uppercase tracking-wide">
                  Clothing
                </span>
                <span class="text-[14px] text-[#777777]">- Just Now</span>
              </div>

              <h3 id="previewTitle" class="text-[22px] leading-[1.2] font-bold mb-4">
                Request Title Preview ...
              </h3>

              <p id="previewDescription" class="text-[15px] text-[#787878] leading-6">
                Your detailed description will appear here.
                Provide as much context as possible to help
                donors understand your situation.
              </p>

              <div class="flex items-center gap-2 mt-8 text-[#8a8a8a] text-[15px] font-medium">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M5.05 8.05A7 7 0 1115 8c0 3.9-5 9-5 9s-4.95-5.1-4.95-8.95zM10 9.5A1.5 1.5 0 1010 6a1.5 1.5 0 000 3.5z"
                    clip-rule="evenodd" />
                </svg>
                <span id="previewCity">{{ $user->city ?: 'Casablanca' }}</span>
              </div>

              <div class="mt-10 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-[#f79a7a]"></div>
                <div>
                  <p class="text-[18px] font-bold leading-none">{{ $user->name }}</p>
                  <p class="text-[14px] text-[#8a8a8a] mt-1">Verified Donor</p>
                </div>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </main>

    <footer class="pb-10">
      <p class="text-center text-[15px] text-[#9a9a9a]">
        &copy; 2026 We Are Yan. All rights reserved.
      </p>
    </footer>

  </div>

  <script>
    const requestImageInput = document.getElementById('requestImage');
    const previewImage = document.getElementById('previewImage');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const fileName = document.getElementById('fileName');
    const requestTitle = document.getElementById('requestTitle');
    const requestCategory = document.getElementById('requestCategory');
    const requestDescription = document.getElementById('requestDescription');
    const requestCity = document.getElementById('requestCity');
    const previewTitle = document.getElementById('previewTitle');
    const previewCategoryBadge = document.getElementById('previewCategoryBadge');
    const previewDescription = document.getElementById('previewDescription');
    const previewCity = document.getElementById('previewCity');
    const cityMap = document.getElementById('cityMap');
    const urgencyButtons = document.querySelectorAll('.urgency-button');
    const urgencyLevelInput = document.getElementById('urgencyLevel');
    const previewUrgencyBadge = document.getElementById('previewUrgencyBadge');
    const defaultCity = @json($user->city ?: 'Casablanca');

    function updatePreview() {
      previewTitle.textContent = requestTitle.value.trim() || 'Request Title Preview ...';
      previewCategoryBadge.textContent = requestCategory.value.trim() || 'Clothing';
      previewDescription.textContent = requestDescription.value.trim() || 'Your detailed description will appear here. Provide as much context as possible to help donors understand your situation.';
      previewCity.textContent = requestCity.value.trim() || defaultCity;
    }

    function updateMap() {
      const cityValue = requestCity.value.trim() || defaultCity;
      cityMap.src = `https://www.google.com/maps?q=${encodeURIComponent(cityValue + ', Morocco')}&output=embed`;
    }

    function updateUrgencyButtons(selectedValue) {
      urgencyButtons.forEach((button) => {
        button.classList.remove('bg-red-500', 'bg-amber-500', 'bg-lime-600', 'text-white');
        button.classList.add('bg-white');

        if (button.dataset.urgency === selectedValue) {
          button.classList.remove('bg-white');

          if (selectedValue === 'urgent') {
            button.classList.add('bg-red-500', 'text-white');
            previewUrgencyBadge.textContent = 'Urgent';
            previewUrgencyBadge.className = 'bg-red-500 text-white text-[14px] font-semibold px-5 py-2 rounded-full';
          } else if (selectedValue === 'critical') {
            button.classList.add('bg-amber-500', 'text-white');
            previewUrgencyBadge.textContent = 'Critical';
            previewUrgencyBadge.className = 'bg-amber-500 text-white text-[14px] font-semibold px-5 py-2 rounded-full';
          } else {
            button.classList.add('bg-lime-600', 'text-white');
            previewUrgencyBadge.textContent = 'Normal';
            previewUrgencyBadge.className = 'bg-lime-600 text-white text-[14px] font-semibold px-5 py-2 rounded-full';
          }
        }
      });
    }

    requestTitle.addEventListener('input', updatePreview);
    requestCategory.addEventListener('input', updatePreview);
    requestDescription.addEventListener('input', updatePreview);
    requestCity.addEventListener('input', updatePreview);
    requestCity.addEventListener('input', updateMap);

    urgencyButtons.forEach((button) => {
      button.addEventListener('click', function () {
        const selectedValue = this.dataset.urgency;
        urgencyLevelInput.value = selectedValue;
        updateUrgencyButtons(selectedValue);
      });
    });

    updatePreview();
    updateMap();
    updateUrgencyButtons(urgencyLevelInput.value);

    requestImageInput.addEventListener('change', function () {
      const file = this.files[0];

      if (file) {
        fileName.textContent = file.name;

        const reader = new FileReader();

        reader.onload = function (e) {
          previewImage.src = e.target.result;
          previewImage.classList.remove('hidden');
          previewPlaceholder.classList.add('hidden');
        };

        reader.readAsDataURL(file);
      } else {
        fileName.textContent = 'No image selected';
        previewImage.src = '';
        previewImage.classList.add('hidden');
        previewPlaceholder.classList.remove('hidden');
      }
    });
  </script>

</body>

</html>
