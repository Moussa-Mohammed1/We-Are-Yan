document.addEventListener('DOMContentLoaded', function () {
    const citySelect = document.getElementById('city');

    if (!citySelect) {
        return;
    }

    const selectedCity = citySelect.dataset.selectedCity || '';

    fetch('/data/morrocan_city.json')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }

            return response.json();
        })
        .then(cities => {
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city;
                option.textContent = city;

                if (city === selectedCity) {
                    option.selected = true;
                }

                citySelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading cities:', error);
        });
});
