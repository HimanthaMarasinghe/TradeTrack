<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
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
                            <h4><?= $order['date']?></h4>
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
                    <?php foreach ($product as $product): ?>
                        <a href="#" 
                            class="card btn-card center-al low" 
                            onclick="showProductDetails(
                                '<?= addslashes($product['product_name']); ?>', 
                                '<?= $product['quantity']; ?>', 
                                '<?= number_format($product['bulk_price'], 2); ?>', 
                                '<?= ROOT ?>/images/Products/<?= $product['barcode']; ?>.<?= $product['pic_format']; ?>'
                            )">
                            <div class="details h-100">
                                <h4><?= $product['product_name']; ?></h4>
                                <h4 class = "quantity"><?= $product['quantity']; ?> <?= $product['unit_type']; ?></h4>
                                <h4>Rs.<?= number_format($product['bulk_price'], 2); ?></h4>
                            </div>
                            <div class="product-img-container">
                                <img class="product-img" src="<?= ROOT ?>/images/Products/<?= $product['barcode']; ?>.<?= $product['pic_format']; ?>" 
                                    onerror="this.src='<?=ROOT?>/images/Default/Product.jpeg'"
                                    alt="<?= $product['product_name']; ?>">
                            </div>
                        </a>
                    <?php endforeach; ?>

                    <!-- Popup -->
                    <div class="productViewPopup" id="productViewPopup" style="display: none;">
                        <div class="popup-content">
                            <img id="popupProductImage" class="popup-image" src="" alt="Product Image">
                            <h2 id="popupProductName">Product Name</h2>
                            <p><strong>Quantity:</strong> <span id="popupProductQuantity"></span></p>
                            <p><strong>Unit Price:</strong> Rs.<span id="popupProductPrice"></span></p>
                            <button class="btn" onclick="requestInventory()">Request Inventory</button>
                        </div>
                    </div>
                    
                    <!-- <script>
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

                    </script> -->
            </div>
        </div>
    </div>
</div>
<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const ws_id = "<?=$_SESSION['Distributor']['phone']?>";
</script>
<script src='<?=ROOT?>/js/notificationConfig.js' type="module"></script>

<?php $this->component("footer") ?>