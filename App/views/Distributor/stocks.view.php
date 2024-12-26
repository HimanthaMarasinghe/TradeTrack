
<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs);
    // Side menu is created here
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="Home Icon">
        <h1>Maliban Galle Distributor</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="Settings Icon">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="Profile Icon">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search Product">
                <button class="btn">Search</button>
                <a class="btn" href="<?=LINKROOT?>/Distributor/newInventryRequest">
                    <h4>New Inventory Request</h4>
                </a>
                <a class="btn" href="<?=LINKROOT?>/Distributor/requestDetails">
                    <h4>Request Details</h4>
                </a>
            </div>
            <div class="scroll-box grid g-resp-300">
                <!-- Product Cards -->
                <?php
                    $products = [
                        [
                            "name" => "Maliban Milk Powder 400g",
                            "quantity" => 5000,
                            "price" => 1260.00,
                            "image" => "4790015950624.png"
                        ],
                        [
                            "name" => "Maliban Chocolate Biscuit 100g",
                            "quantity" => 10,
                            "price" => 110.00,
                            "image" => "4791034072366.jpeg"
                        ],
                        [
                            "name" => "Maliban Cream Cracker 200g",
                            "quantity" => 500,
                            "price" => 250.00,
                            "image" => "Maliban Cream Cracker 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Marie Biscuit 200g",
                            "quantity" => 1500,
                            "price" => 220.00,
                            "image" => "Maliban Marie Biscuit 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Sandwich Biscuit 200g",
                            "quantity" => 100,
                            "price" => 300.00,
                            "image" => "Maliban Sandwich Biscuit 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Milk Cream Biscuit 100g",
                            "quantity" => 5000,
                            "price" => 150.00,
                            "image" => "Maliban Milk Cream Biscuit 100g.jpeg"
                        ],
                        [
                            "name" => "Maliban Digestive Biscuit 250g",
                            "quantity" => 10000,
                            "price" => 300.00,
                            "image" => "Maliban Digestive Biscuit 250g.jpg"
                        ],
                        [
                            "name" => "Maliban Oaty Biscuit 200g",
                            "quantity" => 5000,
                            "price" => 180.00,
                            "image" => "Maliban Oaty Biscuit 200g.webp"
                        ],
                        [
                            "name" => "Maliban Lemon Puff 200g",
                            "quantity" => 25,
                            "price" => 220.00,
                            "image" => "Maliban lemon puff 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Sweet Milk Biscuit 200g",
                            "quantity" => 2500,
                            "price" => 240.00,
                            "image" => "Maliban Sweet Milk Biscuit 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Ginger Biscuit 200g",
                            "quantity" => 5000,
                            "price" => 210.00,
                            "image" => "Maliban Ginger Biscuit 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Krisco Biscuit 170g",
                            "quantity" => 5000,
                            "price" => 170.00,
                            "image" => "Maliban Krisco Biscuit 170g.jpg"
                        ],
                        [
                            "name" => "Maliban Chocolate Puff Biscuit 200g",
                            "quantity" => 5000,
                            "price" => 260.00,
                            "image" => "Maliban Chocolate Puff Biscuit 200g.png"
                        ],
                        [
                            "name" => "Maliban Orange Cream Biscuit 200g",
                            "quantity" => 5000,
                            "price" => 230.00,
                            "image" => "Maliban Orange Cream Biscuit 200g.webp"
                        ]
                    ];
                    

                   // Separate low inventory products
                    $low_inventory = array_filter($products, fn($product) => $product['quantity'] <= 100);
                    $regular_inventory = array_filter($products, fn($product) => $product['quantity'] > 100);

                    // Merge arrays: low inventory first
                    $sorted_products = array_merge($low_inventory, $regular_inventory);
                    ?>

                    <?php foreach ($sorted_products as $product): ?>
                        <a href="#" 
                            class="card btn-card center-al" 
                            style="background-color: <?= $product['quantity'] <= 100 ? '#ffcccc' : '#ffffff'; ?>;"
                            onclick="showProductDetails(
                                '<?= addslashes($product['name']); ?>', 
                                '<?= $product['quantity']; ?>', 
                                '<?= number_format($product['price'], 2); ?>', 
                                '<?= ROOT ?>/images/Products/<?= $product['image']; ?>'
                            )">
                            <div class="details h-100">
                                <h4><?= $product['name']; ?></h4>
                                <h4><?= $product['quantity']; ?></h4>
                                <h4>Rs.<?= number_format($product['price'], 2); ?></h4>
                            </div>
                            <div class="product-img-container">
                                <img class="product-img" src="<?= ROOT ?>/images/Products/<?= $product['image']; ?>" 
                                    alt="<?= $product['name']; ?>">
                            </div>
                        </a>
                    <?php endforeach; ?>

            </div>
        </div>
    </div>

    <!-- Popup -->
    <div class="productViewPopup" id="productViewPopup" style="display: none;">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">×</span>
            <img id="popupProductImage" class="popup-image" src="" alt="Product Image">
            <h2 id="popupProductName">Product Name</h2>
            <p><strong>Quantity:</strong> <span id="popupProductQuantity"></span></p>
            <p><strong>Unit Price:</strong> Rs.<span id="popupProductPrice"></span></p>
            <button class="btn" onclick="requestInventory()">Request Inventory</button>
        </div>
    </div>
</div>

<script>
    // Function to show product details in a popup
    function showProductDetails(name, quantity, price, imageUrl) {
        document.getElementById('popupProductName').innerText = name;
        document.getElementById('popupProductQuantity').innerText = quantity;
        document.getElementById('popupProductPrice').innerText = price;
        document.getElementById('popupProductImage').src = imageUrl;
        document.getElementById('productViewPopup').style.display = 'flex';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('productViewPopup').style.display = 'none';
    }

    // Close popup when clicking outside the content
    document.getElementById('productViewPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closePopup();
        }
    });

    //Request iventory
    function requestInventory() {
    window.location.href = '<?=LINKROOT?>/Distributor/newInventryRequest';
    }



    // Search bar functionality
    document.querySelector('.search-bar').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase().trim(); // Get the search term
    const cards = document.querySelectorAll('.scroll-box .card'); // Adjust to match your card container

    cards.forEach(card => {
        const productName = card.querySelector('.details h4:first-child').textContent.toLowerCase(); // Match the title
        card.style.display = productName.includes(searchValue) ? '' : 'none'; // Show or hide card
    });
});

</script>

<?php $this->component("footer") ?>
