document.addEventListener('DOMContentLoaded', () => {
    const url = document.body.dataset.filterUrl;
    const buttons = document.querySelectorAll('.filter-button');
    const list = document.getElementById('annoncesList');

    if (!url || !buttons.length || !list) {
        return;
    }

    function urgencyClass(urgency) {
        if (urgency === 'urgent') return 'text-red-500 border-red-500 bg-red-50';
        if (urgency === 'critical') return 'text-orange-500 border-orange-500 bg-orange-50';
        return 'text-green-600 border-green-600 bg-green-50';
    }

    function cardHtml(annonce) {
        const image = annonce.image
            ? `<img src="${annonce.image}" alt="${annonce.title}" class="w-full h-48 object-cover rounded-2xl mb-4">`
            : `<div class="w-full h-48 rounded-2xl mb-4 bg-[#eef6f3] flex items-center justify-center text-[#007b67] font-bold text-lg">No Image</div>`;

        const quantity = annonce.quantity ? annonce.quantity : 'Not specified';

        return `
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="p-4">
                    ${image}
                    <div class="flex justify-between items-center gap-3 mb-3">
                        <span class="text-teal-600 font-bold text-sm uppercase tracking-wide">${annonce.category}</span>
                        <span class="border ${urgencyClass(annonce.urgency)} text-[10px] px-3 py-1 rounded-full font-semibold uppercase">
                            ${annonce.urgency}
                        </span>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">${annonce.title}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">${annonce.description}</p>
                    <div class="space-y-2 text-sm text-gray-600 mb-5">
                        <p><span class="font-semibold text-gray-800">City:</span> ${annonce.city}</p>
                        <p><span class="font-semibold text-gray-800">Quantity:</span> ${quantity}</p>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                        <span>Posted by ${annonce.beneficiary_name}</span>
                        <span>${annonce.created_at_human ?? ''}</span>
                    </div>
                    <a href="${annonce.show_url}" class="block w-full bg-[#00563f] text-white py-3 rounded-xl font-bold hover:bg-[#004734] transition text-center">
                        View Details
                    </a>
                </div>
            </div>
        `;
    }

    function setActiveButton(activeButton) {
        buttons.forEach((button) => {
            button.classList.remove('bg-[#004734]', 'text-white', 'border-[#004734]');
            button.classList.add('text-[#004734]', 'border-[#004732]');
        });

        activeButton.classList.add('bg-[#004734]', 'text-white', 'border-[#004734]');
    }

    function showMessage(text) {
        list.innerHTML = `
            <div class="md:col-span-2 lg:col-span-3 bg-white border border-[#dfdfdf] rounded-[28px] px-8 py-12 text-center text-[#666] shadow-sm">
                ${text}
            </div>
        `;
    }

    async function loadAnnonces(category) {
        const filterUrl = category ? `${url}?category=${encodeURIComponent(category)}` : url;

        showMessage('Loading annonces...');

        try {
            const response = await fetch(filterUrl);
            const data = await response.json();
            const annonces = data.annonces || [];

            if (!annonces.length) {
                showMessage('No annonces available for this category.');
                return;
            }

            list.innerHTML = annonces.map(cardHtml).join('');
        } catch (error) {
            showMessage('Something went wrong while loading annonces.');
        }
    }

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            setActiveButton(button);
            loadAnnonces(button.dataset.category || '');
        });
    });
});
