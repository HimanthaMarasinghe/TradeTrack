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
        <div class="colomn">
            <div class="row spc-btwn gap-10">
                <table class="profile">
                    <tr>
                        <td>Product Name</td>
                        <td><?=$product['product_name']?></td>
                    </tr>
                    <tr>
                        <td><?=strlen($product['barcode']) == 13 ? "Barcode" : "Product Code"?></td>
                        <td><?=$product['barcode']?></td>
                    </tr>
                    <tr>
                        <td>Unit Price</td>
                        <td>Rs.<span id="unit_Price"><?= number_format($product['unit_price'], 2) ?></span></td>
                    </tr>
                <?php if($stock) {?>
                    <tr>
                        <td>My Price</td>
                        <?php if($product['my_price'] == 0) { ?>
                            <td><span id="unit_Price">Not Set</span></td>
                        <?php } else { ?>
                            <td>Rs.<span id="unit_Price"><?= number_format($product['my_price'], 2) ?></span></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                    <tr>
                        <td>Bulk Price</td>
                        <td>Rs.<?= number_format($product['bulk_price'], 2) ?></td>
                    </tr>
                </table>
                <?php if($stock) {?>
                <table class="profile">
                    <tr><td colspan="2"><h2>Stock Details</h2></td></tr>
                    <tr>
                        <td>Curently In Stock</td>
                        <td><span id="currentStk"><?=$stock['quantity'] > 0 ? $stock['quantity'] : 'No'?></span> <?=$product['unit_type']?></td>
                    </tr>
                    <tr>
                        <td title="The system will warn you when the stock reaches the low stock limit.">Low Stock Level ⓘ</td>
                        <td><span id="currentStk"><?=$stock['low_stock_level']?></span> <?=$product['unit_type']?></td>
                    </tr>
                    <tr>
                        <td title="Customers can only pre-order a limited quantity of each product 
        to avoid large orders. Because if shop owners prepare these large orders 
        and they are never picked up, it leads to a big loss because the products 
        couldn't be sold to in-store customers either.">Amount alowed per pre-order  ⓘ</td>
                        <td><span id="amount_alowed_per_pre_Order"><?=$stock['amount_alowed_per_pre_Order'] > 0 ? $stock['amount_alowed_per_pre_Order'] : 'No'?></span> <?=$product['unit_type']?></td>
                    </tr>
                    <tr>
                        <td  title="Some stock might already be pre-ordered, 
        so pre-orderable stock isn't always 
        the same as what's currently in stock.">Pre Orderable Stock ⓘ</td>
                        <td><span id="pre_orderable_stock"><?=$stock['pre_orderable_stock'] > 0 ? $stock['pre_orderable_stock'] : 'No'?></span> <?=$product['unit_type']?></td>
                    </tr>
                </table>
                <?php } ?>
            </div>
            <div class="row">
                <?php if($stock) {?>
                    <button class="btn" id="editPopUp">Edit Details</button>
                    <button class="btn" id="openPopUp">Record stock received from unregistered distributors.</button>
                    <button class="btn" id="recordWaste">Record Waste</button>
                    <button class="btn" id="remove">Remove from my stock</button>
                <?php } else {?>
                    <button class="btn" id="editPopUp">Add to my stock</button>
                <?php } ?>
            </div>
        </div>
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
<?php if($stock) {?>
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
                <td>Bulk Price</td>
                <td id="popUp-prdct-bulk-price">Rs.<?= number_format($product['bulk_price'], 2) ?></td>
            </tr>
        </table>
    </div>
    <form class="colomn mg-10 gap-10" action="<?=LINKROOT?>/ShopOwner/addStock" method="post" id="addStockForm">
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
        <button type="submit" id="addStockBtn" class="btn">Add</button>
    </form>
</div>

<div id="wastePopUp" class="popUpDiv hidden">
    <h3>Record Waste</h3>
    <h4><?=$product['product_name']?></h4>
    <form action="<?=LINKROOT?>/ShopOwner/recordWaste/<?=$product['barcode']?>" method="post">
        <table>
            <tr>
                <td><label for="quantity">Quanitity</label></td>
                <td><input required type="number" class="userInput" id="quantity" name="quantity"></td>
            </tr>
        </table>
        <button type="submit" class="btn">Record Waste</button>
    </form>
</div>

<div id="removePopUp" class="popUpDiv hidden">
    <h2><?=$product['product_name']?></h2>
    <h4>There are <?=$stock['quantity'] > 0 ? $stock['quantity'] : 'No'?> <?=$product['unit_type']?> in the stock</h4>
    <h1 class="red-text center-al">Are you sure you want to remove this product from your stock ?</h1>
    <form action="<?=LINKROOT?>/ShopOwner/removeFromStock/<?=$product['barcode']?>" method="post" class="row">
        <button class="btn fg1" id="removeConfirm" type="submit"><h3>Yes</h3></button>
        <button class="btn fg1" id="removeCancel" type="button"><h3>No</h3></button>
    </form>
</div>

<?php } ?>
<div id="editProduct" class="popUpDiv hidden">
    <h2><?= $stock ? "Edit My Price" : "Add to My Stock" ?></h2>
    <h4><?=$product['product_name']?></h4>
    <form 
        action="<?=LINKROOT?>/ShopOwner/editProduct/<?=$product['barcode']?>/<?=$product['my_price']?>/<?=$stock['low_stock_level'] ?? 0?>/<?=$stock['amount_alowed_per_pre_Order'] ?? 0?>" 
        method="post" 
        class="colomn mg-10 gap-10" 
        id="editProductForm">
        <table>
            <tr>
                <td>My Price (leave empty to remove)</td>
                <td><input type="number" class="userInput" id="unitPrice" name="unitPrice" value="<?=$product['my_price'] == 0 ? null : $product['my_price']?>"></td>
            </tr>
            <tr>
                <td>Low Stock Level</td>
                <td><input type="number" class="userInput" id="lowStockLevel" name="lowStockLevel" value="<?=$stock['low_stock_level']?>" required></td>
            </tr>
            <tr>
            <td title="Customers can only pre-order a limited quantity of each product 
to avoid large orders. Because if shop owners prepare these large orders 
and they are never picked up, it leads to a big loss because the products 
couldn't be sold to in-store customers either.">Amount alowed per pre-order  ⓘ</td>
                <td><input type="number" name="aapp" id="aapp" class="userInput" value="<?=$stock['amount_alowed_per_pre_Order']?>" required></td>
            </tr>
        </table>
        <button type="submit" class="btn" id="editSubmit"><?=$stock ? "Edit" : "Add"?></button>
    </form>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const barcode = "<?=$product['barcode']?>";
    const bulk_price = <?=$product['bulk_price']?>;
</script>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<script src="<?=ROOT?>/js/ShopOwner/product.js" type="module"></script>

<?php $this->component("footer")?>