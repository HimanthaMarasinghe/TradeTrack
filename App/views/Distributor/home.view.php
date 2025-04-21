<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <div>
                <!-- <img src="<?=ROOT?>/images/icons/settings.svg" alt=""> -->
                <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <a href="#"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
            </div>
        </div>

        <div class="bar">
            <h1><?=$_SESSION['dis_busines_name']?></h1>
            <a class="btn" href="<?=LINKROOT?>/Distributor/newInventryRequest">
                <h4>New Inventory Request</h4>
            </a>
        </div>
    </div>

    <div class="grid-box fg1">
        <div class="panel pre-orders">
            <h2>Orders</h2>
            <div class="scroll-box">
            <!-- Order Cards -->
                <?php foreach ($order as $order){ ?>
                    <a href="<?=LINKROOT?>/Distributor/orderDetails/<?=$order['order_id']?>" class="card btn-card center-al">
                        <div class="profile-photo">
                            <img src="<?=ROOT?>/images/Shops/default.jpeg" alt=" ">
                        </div>
                        <div class="details center-al">
                            <h4><?= $order['shop_name']?></h4>
                            <h4><?= $order['time']?></h4>
                            <h4 class="status-<?= $order['status']?>"><?= $order['status']?></h4> <!-- Add the status class -->
                        </div>
                    </a>
                <?php }?>

            </div>
        </div>

        <div class="panel cash-drawer">
            <h2>Cash Drawer Balance</h2>
            <div class="balance">
                <h1>Rs. 150,000.00</h1>
            </div>
        </div>

        <div class="panel low-stocck">
            <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
            <?php
                    $products = [
                        [
                            "name" => "Maliban Chocolate Biscuit 100g",
                            "quantity" => 10,
                            "price" => 110.00,
                            "image" => "4791034072366.jpeg"
                        ],
                        [
                            "name" => "Maliban Sandwich Biscuit 200g",
                            "quantity" => 100,
                            "price" => 300.00,
                            "image" => "Maliban Sandwich Biscuit 200g.jpg"
                        ],
                        [
                            "name" => "Maliban Lemon Puff 200g",
                            "quantity" => 25,
                            "price" => 220.00,
                            "image" => "Maliban lemon puff 200g.jpg"
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
            </div>
        </div>
    </div>
</div>

<?php $this->component("footer") ?>