<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs);
?>

<div class="main-content">

<div class="bar">
    <img src="<?=ROOT?>/images/icons/home.svg" alt="">
    <h1>Update products</h1>
    <div>
      <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
      <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
    </div>
  </div>

    <!-- Success and error messages -->
    <?php if (isset($data['success'])): ?>
        <p class="success"><?= $data['success']; ?></p>
    <?php elseif (isset($data['error'])): ?>
        <p class="error"><?= $data['error']; ?></p>
    <?php endif; ?>

    <!-- Product Form -->
    <form action="<?=LINKROOT?>/admin/updateProducts/<?=$product['barcode']?>" method="POST" enctype="multipart/form-data">
        <label for="barcode">Barcode:</label>
        <input type="text" class="userInput" id="barcode" name="barcode" placeholder="Enter barcode" value="<?=$product['barcode']?>" required>

        <label for="product_name">Product Name:</label>
        <input type="text" class="userInput" id="product_name" name="product_name" placeholder="Enter product name" value="<?=$product['product_name']?>" required>

        <!-- Unit Price with Increment/Decrement buttons -->
        <label for="unit_price">Unit Price:</label>
        <div class="unit-price-container">
            <button type="button" class="price-btn" onclick="changePrice(-0.01)">-</button>
            <input type="number" step="0.01" class="userInput unit-price" id="unit_price" name="unit_price" value="<?= number_format($product['unit_price'], 2) ?>" min="0" required>
            <button type="button" class="price-btn" onclick="changePrice(0.01)">+</button>
        </div>

        <!-- Image Upload Section -->
        <label for="unit_price">Product Image:</label>
        <div>
            <div id="productImagePreview" class="imagePreviewBox">
                <div id="productImageContainer">
                <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
                <img src="<?=LINKROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" 
                    alt="Image Preview" 
                    style="width: 100%; height: 100%; object-fit: cover;">
                <?php } ?>
                </div>
            </div>
            <input type="file" class="imageChooseInput" name="productImage" id="productImage" accept="image/*" onchange="previewProductImage(event)">
            <button type="button" class="imageChooseBtn" onclick="triggerProductFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeProductImage()">Remove</button>
        </div>

        
        <!-- Hidden checkbox for removing the image -->
        <input type="checkbox" name="remove_image" id="removeImageCheckbox" style="display: none;">
        
        <input type="submit" class="btn" value="Update">
    </form>
</div>

<script>
// Function to trigger file input
function triggerProductFileInput() {
    document.getElementById('productImage').click();
}

// Function to preview the selected image
function previewProductImage(event) {
    const productImageContainer = document.getElementById('productImageContainer');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            productImageContainer.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
        };
        reader.readAsDataURL(file);

        // Uncheck the "remove image" checkbox since a new image is selected
        document.getElementById('removeImageCheckbox').checked = false;
    }
}

// Function to remove the selected image
function removeProductImage() {
    document.getElementById('productImage').value = '';
    document.getElementById('productImageContainer').innerHTML = '';

    
    // Check the "remove image" checkbox
    document.getElementById('removeImageCheckbox').checked = true;
}

// Function to change the unit price incrementally
function changePrice(value) {
    const unitPriceInput = document.getElementById('unit_price');
    const currentValue = parseFloat(unitPriceInput.value);
    const newValue = (currentValue + value).toFixed(2);
    
    // Ensure the value doesn't go below zero
    if (newValue >= 0) {
        unitPriceInput.value = newValue;
    }
}
</script>

<?php $this->component("footer"); ?>