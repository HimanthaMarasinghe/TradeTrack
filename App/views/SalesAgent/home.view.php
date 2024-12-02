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
            <h1><?=$_SESSION['name']?></h1>
            <a class="btn" href="<?=LINKROOT?>/SalesAgent/newInventryRequest">
                <h4>New Inventory Request</h4>
            </a>
        </div>
    </div>

    <div class="grid-box fg1">
        <div class="panel pre-orders">
            <h2>Orders</h2>
            <div class="scroll-box">
            <!-- Order Cards -->
            <?php
                    // Define orders
                    $orders = [
                        [
                            "name" => "Galle Supermarket",
                            "time" => "30 minutes ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Sunrise Grocery Store",
                            "time" => "1 hour ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Green Valley Groceries",
                            "time" => "2 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Fort Fresh Market",
                            "time" => "3 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Ocean View Grocery",
                            "time" => "4 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Galle Essentials",
                            "time" => "5 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Southern Groceries",
                            "time" => "6 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Cinnamon Market",
                            "time" => "7 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Hilltop Grocery",
                            "time" => "8 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Galle Mart",
                            "time" => "9 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Pearl Groceries",
                            "time" => "10 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Harbor View Mart",
                            "time" => "11 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Beachside Groceries",
                            "time" => "12 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Golden Leaf Mart",
                            "time" => "13 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Coral Coast Groceries",
                            "time" => "14 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Southern Spice Market",
                            "time" => "15 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Tropical Delights Grocery",
                            "time" => "16 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Coconut Grove Groceries",
                            "time" => "17 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Fort Bazaar Grocery",
                            "time" => "18 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Lighthouse Grocery Center",
                            "time" => "19 hours ago",
                            "status" => "pending"
                        ]
                    ];

                    // Sorting orders by time (latest first)
                    usort($orders, function($a, $b) {
                        // Convert time string to number of minutes or hours
                        $aTime = convertToTimestamp($a['time']);
                        $bTime = convertToTimestamp($b['time']);
                        return $bTime - $aTime; // Sort in descending order
                    });

                    // Helper function to convert time to timestamp for comparison
                    function convertToTimestamp($timeStr) {
                        $now = time();
                        if (strpos($timeStr, 'minute') !== false) {
                            preg_match('/(\d+)\sminute/', $timeStr, $matches);
                            return $now - $matches[1] * 60;
                        } elseif (strpos($timeStr, 'hour') !== false) {
                            preg_match('/(\d+)\shour/', $timeStr, $matches);
                            return $now - $matches[1] * 3600;
                        }
                        return $now; // Default to current time if the format is not matched
                    }

                    // Separate orders by status
                    $pendingOrders = [];
                    $readyOrders = [];
                    
                    foreach ($orders as $order) {
                        switch ($order['status']) {
                            case 'pending':
                                $pendingOrders[] = $order;
                                break;
                            case 'ready':
                                $readyOrders[] = $order;
                                break;
                        }
                    }

                    // Display orders grouped by status
                    $allOrders = array_merge($pendingOrders, $readyOrders);
                ?>

                <?php foreach ($allOrders as $order): ?>
                    <a href="<?=LINKROOT?>/SalesAgent/orderDetails" class="card btn-card center-al">
                        <div class="profile-photo">
                            <img src="<?=ROOT?>/images/Shops/default.jpeg" alt="<?= $order['name']; ?>">
                        </div>
                        <div class="details center-al">
                            <h4><?= $order['name']; ?></h4>
                            <h4><?= $order['time']; ?></h4>
                            <h4 class="status-<?= $order['status']; ?>"><?= $order['status']; ?></h4> <!-- Add the status class -->
                        </div>
                    </a>
                <?php endforeach; ?>

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
                        window.location.href = '<?=LINKROOT?>/SalesAgent/newInventryRequest';
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