<?php
    $this->component("header");
    $this->component("sidebar", $tabs);
?>

<div class="main-content">

        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <!-- <h1><?=$_SESSION['name']?></h1> -->
             <h1>Add New Product</h1>
        </div>

    <!-- Success and error messages -->
    <?php if (isset($data['success'])): ?>
        <p class="success"><?= $data['success']; ?></p>
    <?php elseif (isset($data['error'])): ?>
        <p class="error"><?= $data['error']; ?></p>
    <?php endif; ?>

    <!-- Product Form -->
    <form action="/admin/addNewProducts" method="POST" enctype="multipart/form-data">
        <label for="barcode">Barcode:</label>
        <input type="text" class="userInput" id="barcode" name="barcode" placeholder="Enter barcode" required>

        <label for="product_name">Product Name:</label>
        <input type="text" class="userInput" id="product_name" name="product_name" placeholder="Enter product name" required>

        <!-- Unit Price with Increment/Decrement buttons -->
        <label for="unit_price">Unit Price:</label>
        <div class="unit-price-container">
            <button type="button" class="price-btn" onclick="changePrice(-0.01)">-</button>
            <input type="number" step="0.01" class="userInput unit-price" id="unit_price" name="unit_price" value="0.00" min="0" required>
            <button type="button" class="price-btn" onclick="changePrice(0.01)">+</button>
        </div>

        <!-- Image Upload Section -->
        <label for="unit_price">Product Image:</label>
        <div>
            <div id="productImagePreview" class="imagePreviewBox">
                <div id="productImageContainer"></div>
            </div>
            <input type="file" class="imageChooseInput" name="productImage" id="productImage" accept="image/*" onchange="previewProductImage(event)">
            <button type="button" class="imageChooseBtn" onclick="triggerProductFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeProductImage()">Remove</button>
        </div>

        
        <input type="submit" class="btn" value="Add Product">
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
    }
}

// Function to remove the selected image
function removeProductImage() {
    document.getElementById('productImage').value = '';
    document.getElementById('productImageContainer').innerHTML = '';
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