const hiddenInput = document.getElementById('remove_image');
const imageContainer = document.getElementById('imageContainer');

// Trigger file input
function triggerFileInput() {
    if (hiddenInput) hiddenInput.value = 'false';
    document.getElementById('image').click();
}


// Preview uploaded image
function previewImage(event) {
    imageContainer.innerHTML = '';

    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Image Preview';
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            imageContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

// Remove uploaded image
function removeImage() {
    document.getElementById('image').value = '';
    document.getElementById('imageContainer').innerHTML = '';
    if (hiddenInput) hiddenInput.value = 'true';
}