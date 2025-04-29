const shop_hiddenInput = document.getElementById('remove_shop_image');
const shop_imageContainer = document.getElementById('shop_imageContainer');

// Trigger file input
function triggerShopFileInput() {
    if (shop_hiddenInput) shop_hiddenInput.value = 'false';
    document.getElementById('shop_image').click();
}


// Preview uploaded image
function previewShopImage(event) {
    shop_imageContainer.innerHTML = '';

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
            shop_imageContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

// Remove uploaded image
function removeShopImage() {
    document.getElementById('shop_image').value = '';
    shop_imageContainer.innerHTML = '';
    if (shop_hiddenInput) shop_hiddenInput.value = 'true';
}