document.addEventListener('DOMContentLoaded', () => {
    const paymentModeInputs = document.querySelectorAll('.payment-mode-input');
    const paymentModeCards = document.querySelectorAll('.payment-mode-card');
    const donationKindInputs = document.querySelectorAll('.donation-kind-input');
    const donationKindCards = document.querySelectorAll('.donation-kind-card');
    const cashPaymentInfo = document.getElementById('cashPaymentInfo');
    const stripePaymentInfo = document.getElementById('stripePaymentInfo');
    const ribPaymentInfo = document.getElementById('ribPaymentInfo');
    const moneyDonationSection = document.getElementById('moneyDonationSection');
    const itemsDonationSection = document.getElementById('itemsDonationSection');

    if (
        !paymentModeInputs.length ||
        !donationKindInputs.length ||
        !cashPaymentInfo ||
        !stripePaymentInfo ||
        !ribPaymentInfo ||
        !moneyDonationSection ||
        !itemsDonationSection
    ) {
        return;
    }

    const activeCardClasses = ['border-[#007b67]', 'bg-[#eef8f4]'];
    const inactiveCardClasses = ['border-[#d8d8d8]', 'bg-[#fbfbfb]'];

    const updatePaymentMode = () => {
        const selected = document.querySelector('.payment-mode-input:checked')?.value || 'cash';

        paymentModeCards.forEach((card) => {
            const input = card.querySelector('.payment-mode-input');
            const isActive = input?.value === selected;

            card.classList.remove(...(isActive ? inactiveCardClasses : activeCardClasses));
            card.classList.add(...(isActive ? activeCardClasses : inactiveCardClasses));
        });

        cashPaymentInfo.classList.toggle('hidden', selected !== 'cash');
        stripePaymentInfo.classList.toggle('hidden', selected !== 'stripe');
        ribPaymentInfo.classList.toggle('hidden', selected !== 'rib');
    };

    const updateDonationKind = () => {
        const selected = document.querySelector('.donation-kind-input:checked')?.value || 'money';

        donationKindCards.forEach((card) => {
            const input = card.querySelector('.donation-kind-input');
            const isActive = input?.value === selected;

            card.classList.remove(...(isActive ? inactiveCardClasses : activeCardClasses));
            card.classList.add(...(isActive ? activeCardClasses : inactiveCardClasses));
        });

        moneyDonationSection.classList.toggle('hidden', selected !== 'money');
        itemsDonationSection.classList.toggle('hidden', selected !== 'items');
    };

    paymentModeInputs.forEach((input) => {
        input.addEventListener('change', updatePaymentMode);
    });

    donationKindInputs.forEach((input) => {
        input.addEventListener('change', updateDonationKind);
    });

    updatePaymentMode();
    updateDonationKind();
});
