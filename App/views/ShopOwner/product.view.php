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
                <td>Barcode</td>
                <td><?=$product['barcode']?></td>
            </tr>
            <tr>
                <td>Unit Price</td>
                <td>Rs.<?= number_format($product['unit_price'], 2) ?></td>
            </tr>
            <tr>
                <td>Bulk Price</td>
                <td>Rs.<?= number_format($product['bulk_price'], 2) ?></td>
            </tr>
            <tr>
                <td>Curently In Stock</td>
                <td><span id="currentStk"><?=$stock > 0 ? $stock : 'No'?></span> <?=$product['unit_type']?></td>
            </tr>
            </tr>
            <tr title="Some stock might already be pre-ordered, so pre-orderable stock isn't always the same as what's currently in stock.">
                <td>Pre Orderable Stock ⓘ</td>
                <td><span id="currentStk"><?=$pre_orderable_stock > 0 ? $pre_orderable_stock : 'No'?></span> <?=$product['unit_type']?></td>
            </tr>
            <tr>
                <td colspan="2"><button class="btn" id="openPopUp">Record stock received from unregistered distributors.</button></td>
            </tr>
        </table>
        <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
    </div>
    
    <div class="colomn fg1 panel">
        <h3>Distributors that you can purchase this product from</h3>
        <div class="row mg-0">
            <input id="searchBar" type="text" class="fg1 search-bar" placeholder="Search">
        </div>
        <div class="scroll-box grid g-resp-200" id="elements-Scroll-Div">
        </div>
    </div>
</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addStock" class="popUpDiv hidden">
    <h3>Use this portal to record stock from distributors not registered in the system.</h3>
    <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
        <img class="profile-img big" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
    <?php } else { ?>
        <img class="profile-img big" src="<?=ROOT?>/images/Products/default.jpg" alt="">
    <?php } ?>
    <div class="details h-50 center-al">
        <h4 id="popUp-prdct-name"><?=$product['product_name']?></h4>
        <table>
            <tr>
                <td>Unit Price</td>
                <td id="popUp-prdct-unit-price">Rs.<?= number_format($product['unit_price'], 2) ?></td>
            </tr>
            <tr>
                <td>Bulk Price</td>
                <td id="popUp-prdct-bulk-price">Rs.<?= number_format($product['bulk_price'], 2) ?></td>
            </tr>
        </table>
    </div>
    <form class="colomn mg-10 gap-10" id="addStockForm">
        <input required type="hidden" id="popUp-prdct-barcode" name="barcode" value="<?=$product['barcode']?>">
        <input required type="hidden" name="unique" value="0">
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
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const barcode = "<?=$product['barcode']?>";
    const bulk_price = <?=$product['bulk_price']?>
</script>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<script src="<?=ROOT?>/js/ShopOwner/product.js" type="module"></script>

<?php $this->component("footer") ?>