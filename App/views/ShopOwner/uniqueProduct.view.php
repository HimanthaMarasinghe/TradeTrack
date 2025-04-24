<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Unique Product Details</h1>
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
                <td><span id="currentStk"><?=$product['quantity']> 0 ? $product['quantity'] : 'No'?></span> <?=$product['unit_type']?></td>
            </tr>
            <tr>
                <td title="The system will warn you when the stock reaches the low stock limit.">Low Stock Level ⓘ</td>
                <td><span id="currentStk"><?=$product['low_stock_level']?></span> <?=$product['unit_type']?></td>
            </tr>
            <tr>
                <td title="Customers can only pre-order a limited quantity of each product 
to avoid large orders. Because if shop owners prepare these large orders 
and they are never picked up, it leads to a big loss because the products 
couldn't be sold to in-store customers either.">Amount alowed per pre-order  ⓘ</td>
                <td><span id="amount_alowed_per_pre_Order"><?=$product['amount_alowed_per_pre_Order'] > 0 ? $product['amount_alowed_per_pre_Order'] : 'No'?></span> <?=$product['unit_type']?></td>
            </tr>
            <tr>
                <td  title="Some stock might already be pre-ordered, 
so pre-orderable stock isn't always 
the same as what's currently in stock.">Pre Orderable Stock ⓘ</td>
                <td><span id="pre_orderable_stock"><?=$product['pre_orderable_stock'] > 0 ? $product['pre_orderable_stock'] : 'No'?></span> <?=$product['unit_type']?></td>
            </tr>
        </table>
        <img src="<?=ROOT?>/images/Products/<?=$_SESSION['shop_owner']['phone'].$product['product_code'].".".$product['pic_format']?>" 
            onerror="this.src='<?=ROOT?>/images/Products/default.jpeg'"
            alt="Product Image" 
            class="profile-img big">
    </div>
    <div class="row">
        <button class="btn" id="editPopUp">Edit Details</button>
        <button class="btn" id="openPopUp">Record stock</button>
        <button class="btn" id="recordWaste">Record Waste</button>
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
    <form class="colomn mg-10 gap-10" id="addStockForm" method="post" action="<?=LINKROOT?>/ShopOwner/addStock">
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
        <button type="submit" id="addStockBtn" class="btn">Add</button>
    </form>
</div>

<div id="wastePopUp" class="popUpDiv hidden">
    <h3>Record Waste</h3>
    <h4><?=$product['product_name']?></h4>
    <form action="<?=LINKROOT?>/ShopOwner/recordUniqueWaste/<?=$product['product_code']?>" method="post">
        <table>
            <tr>
                <td><label for="quantity">Quanitity</label></td>
                <td><input required type="number" class="userInput" id="quantity" name="quantity"></td>
            </tr>
        </table>
        <button type="submit" class="btn">Record Waste</button>
    </form>
</div>

<div id="editProduct" class="hidden popUpDiv">
    <h2>Edit Unique Product</h2>
    <br>
    <form action="<?=LINKROOT?>/ShopOwner/editUniqueProduct" method="POST" id="updateProductForm" enctype="multipart/form-data">

        <div class="imageUploadBox" id="pop">
            <div id="imagePreview" class="imagePreviewBox">
                <div id="imageContainer"></div>
            </div>
            
            <input type="file" class="imageChooseInput" name="image" id="image" 
            accept="image/jpg, image/jpeg, image/png, image/webp" 
            onchange="previewImage(event)">
            
            <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>
        </div>

        <table>
            <tr>
                <td><label for="name">Product Name</label></td>
                <td><input class="userInput" type="text" name="product_name" id="name" value="<?=$product['product_name']?>" required></td>
            </tr>
            <tr title="Product code is used to uniquely identify the product. Should have 3 charaters and start from 'x'">
                <td><label for="barcode">Product Code</label></td>
                <td><input class="userInput green-text" type="text" name="product_code" id="product_code" value="x<?=$product['product_code']?>" required readonly></td>
            </tr>
            <tr>
                <td><label for="unit_type">Unit Type</label></td>
                <td><select class="userInput" type="text" name="unit_type" id="unit_type" required>
                        <option value="Units" <?=$product['unit_type'] == 'Units' ? 'selected' : ''?>>Units</option>
                        <option value="Packets" <?=$product['unit_type'] == 'Packets' ? 'selected' : ''?>>Packets</option>
                        <option value="Bottles" <?=$product['unit_type'] == 'Bottles' ? 'selected' : ''?>>Bottles</option>
                        <option value="Kg" <?=$product['unit_type'] == 'Kg' ? 'selected' : ''?>>Kg (Kilograms)</option>
                        <option value="L" <?=$product['unit_type'] == 'L' ? 'selected' : ''?>>L (Liter)</option>
                        <option value="Tubes" <?=$product['unit_type'] == 'Tubes' ? 'selected' : ''?>>Tubes</option>
                        <option value="Cans" <?=$product['unit_type'] == 'Cans' ? 'selected' : ''?>>Cans</option>
                        <option value="Bars" <?=$product['unit_type'] == 'Bars' ? 'selected' : ''?>>Bars</option>
                        <option value="Pieces" <?=$product['unit_type'] == 'Pieces' ? 'selected' : ''?>>Pieces</option>
                        <option value="Boxes" <?=$product['unit_type'] == 'Boxes' ? 'selected' : ''?>>Boxes</option>
                    </select>
                </td>
            </tr>
            </tr>
            <tr>
                <td><label for="unit_price">Unit price</label></td>
                <td><input class="userInput" type="number" name="unit_price" id="unit_price" value="<?=$product['unit_price']?>" required></td>
            </tr>
            <tr>
                <td><label for="low_stock_level" title="The system will warn you when the stock reaches the low stock limit.">Low Stock Level ⓘ</label></td>
                <td><input class="userInput" type="number" name="low_stock_level" id="low_stock_level" value="<?=$product['low_stock_level']?>" required></td>
            </tr>
            <tr>
                <td><label for="pre_orderable_stock" title="Customers can only pre-order a limited quantity of each product 
to avoid large orders. Because if shop owners prepare these large orders 
and they are never picked up, it leads to a big loss because the products 
couldn't be sold to in-store customers either.">Amount alowed per pre-order  ⓘ</label></td>
                <td><input class="userInput" type="number" name="amount_alowed_per_pre_Order" value="<?=$product['amount_alowed_per_pre_Order']?>" required></td>
            </tr>
        </table>
        <button id="formSubmit" class="btn w-100px" type="submit">Edit</button>
    </form>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const product = <?=json_encode($product)?>;
</script>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<script src="<?=ROOT?>/js/ShopOwner/uniqueProduct.js" type="module"></script>

<?php $this->component("footer") ?>