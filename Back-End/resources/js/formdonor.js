document.addEventListener('DOMContentLoaded', () => {
    const requestImageInput = document.getElementById('requestImage');
    const fileName = document.getElementById('fileName');
    const requestCity = document.getElementById('requestCity');
    const cityMap = document.getElementById('cityMap');
    const urgencyButtons = document.querySelectorAll('.urgency-button');
    const urgencyLevelInput = document.getElementById('urgencyLevel');
    if (
        !requestImageInput ||
        !fileName ||
        !requestCity ||
        !cityMap ||
        !urgencyLevelInput
    ) {
        return;
    }

    const defaultCity = document.body.dataset.defaultCity || 'Casablanca';
    const existingImage = document.body.dataset.existingImage || '';

    const updateMap = () => {
        const cityValue = requestCity.value.trim() || defaultCity;
        cityMap.src = `https://www.google.com/maps?q=${encodeURIComponent(`${cityValue}, Morocco`)}&output=embed`;
    };

    const updateUrgencyButtons = (selectedValue) => {
        urgencyButtons.forEach((button) => {
            button.classList.remove('bg-red-500', 'bg-amber-500', 'bg-lime-600', 'text-white');
            button.classList.add('bg-white');

            if (button.dataset.urgency === selectedValue) {
                button.classList.remove('bg-white');

                if (selectedValue === 'urgent') {
                    button.classList.add('bg-red-500', 'text-white');
                } else if (selectedValue === 'critical') {
                    button.classList.add('bg-amber-500', 'text-white');
                } else {
                    button.classList.add('bg-lime-600', 'text-white');
                }
            }
        });
    };

    requestCity.addEventListener('input', updateMap);

    urgencyButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const selectedValue = button.dataset.urgency;
            urgencyLevelInput.value = selectedValue;
            updateUrgencyButtons(selectedValue);
        });
    });

    requestImageInput.addEventListener('change', () => {
        const file = requestImageInput.files[0];

        if (file) {
            fileName.textContent = file.name;
        } else {
            fileName.textContent = existingImage ? 'Current image selected' : 'No image selected';
        }
    });

    updateMap();
    updateUrgencyButtons(urgencyLevelInput.value);

});
