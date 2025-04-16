<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Product Details</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Product Name</td>
                <td><?=$product['product_name']?></td>
            </tr>
            <tr>
                <td>Product Code</td>
                <td>x<?=$product['product_code']?></td>
            </tr>
            <tr>
                <td>Unit Price</td>
                <td>Rs.<?= number_format($product['unit_price'], 2) ?></td>
            </tr>
            <tr>
                <td>Curently In Stock</td>
                <td><span id="currentStk"><?=$product['quantity']?></span> <?=$product['unit_type']?></td>
            </tr>
            <tr>
                <td colspan="2"><button class="btn" id="openPopUp">Record stock.</button></td>
            </tr>
        </table>
        <img src="<?=ROOT?>/images/Products/<?=$_SESSION['shop_owner']['phone'].$product['product_code'].".".$product['pic_format']?>" 
            onerror="this.src='<?=ROOT?>/images/Products/default.jpeg'"
            alt="Product Image" 
            class="profile-img big">
    </div>
</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addStock" class="popUpDiv hidden">
    
    <img src="<?=ROOT?>/images/Products/<?=$_SESSION['shop_owner']['phone'].$product['product_code'].".".$product['pic_format']?>" 
        onerror="this.src='<?=ROOT?>/images/Products/default.jpeg'"
        alt="Product Image" 
        class="profile-img big">
    <div class="details h-50 center-al">
        <h4 id="popUp-prdct-name"><?=$product['product_name']?></h4>
        <table>
            <tr>
                <td>Unit Price</td>
                <td id="popUp-prdct-unit-price">Rs.<?= number_format($product['unit_price'], 2) ?></td>
            </tr>
        </table>
    </div>
    <form class="colomn mg-10 gap-10" id="addStockForm">
        <input required type="hidden" id="popUp-prdct-barcode" name="barcode" value="<?=$product['product_code']?>">
        <input required type="hidden" name="unique" value="1">
        <table>
            <tr>
                <td><label for="quantity">Quanitity</label></td>
                <td><input required type="number" class="userInput" id="quantity" name="quantity"></td>
            </tr>
            <tr>
                <td><label for="cost">Cost</label></td>
                <td><input required type="number" class="userInput" id="cost" name="cost"></td>
            </tr>
            <tr>
                <td><input required type="radio" id="onCash-radio" name="purchaseType" value="fromDrawer" checked></td>
                <td><label for="onCash-radio">Payed from Cash Drawer. (Cash Drawer will be reduced)</label></td>
            </tr>
            <tr>
                <td><input required type="radio" id="none-radio" name="purchaseType" value="personal"> </td>
                <td><label for="none-radio">Payment made with personal money.</label></td>
            </tr>
            <tr>
                <td><input required type="radio" id="onCredit-radio" name="purchaseType" value="onCredit"></td>
                <td><label for="onCredit-radio">Purchased On Credit (Creditor value is increased)</label></td>
            </tr>
        </table>
        <button type="button" id="addStockBtn" class="btn">Add</button>
    </form>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const barcode = "<?=$product['product_code']?>";
</script>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<script src="<?=ROOT?>/js/ShopOwner/uniqueProduct.js" type="module"></script>

<?php $this->component("footer") ?>