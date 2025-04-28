<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h1><?=$_SESSION['distributor']['dis_busines_name']?></h1>
            <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
            </div>
        </div>

        <div class="bar">
            <h1></h1>
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

        <div class="panel cash-drawer row spc-btwn">
        <table class="profile">
            <tr>
                <td>Name</td>
                <td>: <?=$_SESSION['distributor']['first_name']?> <?=$_SESSION['distributor']['last_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>: <?=$_SESSION['distributor']['dis_busines_address']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>: <?=$_SESSION['distributor']['phone']?></td>
            </tr>
        </table>
        <div>
            <img 
            class="profile-img" 
            style="height: 115px;"
            src="<?=ROOT?>/images/Profile/SA/<?=$_SESSION['distributor']['phone']?>.<?=$_SESSION['distributor']['pic_format']?>"
            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'" 
            alt="Profile image">
        </div>
        </div>

        <div class="panel low-stocck">
            <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
                    <?php foreach ($product as $product): ?>
                        <a href="#" 
                            class="card btn-card center-al low" id="lowQuantityProductCard">
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

                       <!-- Product popup -->
                        <div id="popUpBackDrop" class="hidden"></div>
                        <div class="popUpDiv hidden" id="productViewPopUp">
                            <div>
                                <img id="popUpProductImage" class="popup-image" 
                                src="<?= ROOT ?>/images/Products/<?= $product['barcode']; ?>.<?= $product['pic_format']; ?>"
                                onerror="this.src='<?=ROOT?>/images/Default/Product.jpeg'" 
                                alt="Product Image">
                                <h2 id="popUpProductName"><?= $product['product_name']; ?></h2>
                                <table class="profile">
                                <tr>
                                    <td><strong>Barcode</strong></td>
                                    <td>: <?= $product['barcode']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Quantity</strong></td>
                                    <td class = "quantity">: <?= $product['quantity']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Low Quantity Level</strong></td>
                                    <td>: <?= $product['low_quantity_level']; ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Bulk Price</strong></td>
                                    <td>: Rs.<?= number_format($product['bulk_price'], 2); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Unit Price</strong></td>
                                    <td>: Rs.<?= number_format($product['unit_price'], 2); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Commission Percentage</strong></td>
                                    <td>: <?= $product['commission_percentage']; ?>%</td>
                                </tr>
                                <tr>
                                    <td colspan = "2">
                                        <div class="row">
                                            <a class = "btn fg1" href = "<?=LINKROOT?>/Distributor/newInventryRequest">Request Inventory</a>
                                        </div>
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
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
<script src='<?=ROOT?>/js/Distributor/home.js'></script>
<script src ="<?=ROOT?>/js/popUp.js"></script>


<?php $this->component("footer") ?>