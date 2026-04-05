document.addEventListener('DOMContentLoaded', () => {
    const requestImageInput = document.getElementById('requestImage');
    const previewImage = document.getElementById('previewImage');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const fileName = document.getElementById('fileName');
    const requestTitle = document.getElementById('requestTitle');
    const requestCategory = document.getElementById('requestCategory');
    const requestQuantity = document.getElementById('requestQuantity');
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
    const progressText = document.getElementById('progressText');
    const progressBar = document.getElementById('progressBar');

    if (
        !requestImageInput ||
        !previewImage ||
        !previewPlaceholder ||
        !fileName ||
        !requestTitle ||
        !requestCategory ||
        !requestQuantity ||
        !requestDescription ||
        !requestCity ||
        !previewTitle ||
        !previewCategoryBadge ||
        !previewDescription ||
        !previewCity ||
        !cityMap ||
        !urgencyLevelInput ||
        !previewUrgencyBadge ||
        !progressText ||
        !progressBar
    ) {
        return;
    }

    const defaultCity = document.body.dataset.defaultCity || 'Casablanca';
    const existingImage = document.body.dataset.existingImage || '';

    const updatePreview = () => {
        const titleValue = requestTitle.value.trim();
        const categoryValue = requestCategory.value.trim();
        const descriptionValue = requestDescription.value.trim();
        const cityValue = requestCity.value.trim();

        previewTitle.textContent = titleValue || 'Request Title Preview ...';
        previewCategoryBadge.textContent = categoryValue || 'Clothing';
        previewDescription.textContent =
            descriptionValue ||
            'Your detailed description will appear here. Provide as much context as possible to help donors understand your situation.';
        previewCity.textContent = cityValue || defaultCity;
    };

    const updateProgress = () => {
        const trackedFields = [
            requestTitle.value.trim(),
            requestCategory.value.trim(),
            requestQuantity.value.trim(),
            requestDescription.value.trim(),
            requestCity.value.trim(),
            urgencyLevelInput.value.trim(),
            requestImageInput.files.length || existingImage ? 'image-selected' : '',
        ];
        const completedFields = trackedFields.filter(Boolean).length;
        const completionPercentage = Math.round((completedFields / trackedFields.length) * 100);

        progressText.textContent = `${completionPercentage}% Complete`;
        progressBar.style.width = `${completionPercentage}%`;
    };

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
                    previewUrgencyBadge.textContent = 'Urgent';
                    previewUrgencyBadge.className =
                        'bg-red-500 text-white text-[14px] font-semibold px-5 py-2 rounded-full';
                } else if (selectedValue === 'critical') {
                    button.classList.add('bg-amber-500', 'text-white');
                    previewUrgencyBadge.textContent = 'Critical';
                    previewUrgencyBadge.className =
                        'bg-amber-500 text-white text-[14px] font-semibold px-5 py-2 rounded-full';
                } else {
                    button.classList.add('bg-lime-600', 'text-white');
                    previewUrgencyBadge.textContent = 'Normal';
                    previewUrgencyBadge.className =
                        'bg-lime-600 text-white text-[14px] font-semibold px-5 py-2 rounded-full';
                }
            }
        });
    };

    requestTitle.addEventListener('input', updatePreview);
    requestTitle.addEventListener('input', updateProgress);
    requestCategory.addEventListener('input', updatePreview);
    requestCategory.addEventListener('input', updateProgress);
    requestQuantity.addEventListener('input', updateProgress);
    requestDescription.addEventListener('input', updatePreview);
    requestDescription.addEventListener('input', updateProgress);
    requestCity.addEventListener('input', updatePreview);
    requestCity.addEventListener('input', updateMap);
    requestCity.addEventListener('input', updateProgress);

    urgencyButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const selectedValue = button.dataset.urgency;
            urgencyLevelInput.value = selectedValue;
            updateUrgencyButtons(selectedValue);
            updateProgress();
        });
    });

    requestImageInput.addEventListener('change', () => {
        const file = requestImageInput.files[0];

        if (file) {
            fileName.textContent = file.name;

            const reader = new FileReader();

            reader.onload = (event) => {
                previewImage.src = event.target.result;
                previewImage.classList.remove('hidden');
                previewPlaceholder.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        } else {
            fileName.textContent = existingImage ? 'Current image selected' : 'No image selected';
            previewImage.src = existingImage;

            if (existingImage) {
                previewImage.classList.remove('hidden');
                previewPlaceholder.classList.add('hidden');
            } else {
                previewImage.classList.add('hidden');
                previewPlaceholder.classList.remove('hidden');
            }
        }

        updateProgress();
    });

    updatePreview();
    updateMap();
    updateUrgencyButtons(urgencyLevelInput.value);

    if (existingImage) {
        previewImage.src = existingImage;
        previewImage.classList.remove('hidden');
        previewPlaceholder.classList.add('hidden');
    }

    updateProgress();
});
