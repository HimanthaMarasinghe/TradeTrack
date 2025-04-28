<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>New Products</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
                <button id="addUniqueProductBtn" class="btn" title="Do you have a unique product that's not on this list? Add it to your products">Unique products</button>
            </div>
            <div class="scroll-box grid g-resp-200" id="elements-Scroll-Div">
            </div>
        </div>
    </div>

</div>

<div id="notification-container"></div>
<div id="popUpBackDrop" class="hidden"></div>
<div id="addNewProducts" class="hidden popUpDiv">
    <h2>New Unique Product</h2>
    <p>Do you have a unique product that's not on this list? Add it to your products</p>
    <br>
    <form action="<?=LINKROOT?>/ShopOwner/addUniqueProduct" method="POST" id="addNewProductForm" enctype="multipart/form-data">

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
                <td><input class="userInput" type="text" name="product_name" id="name" required></td>
            </tr>
            <tr title="Product code is used to uniquely identify the product. Should have 3 charaters and start from 'x'">
                <td><label for="barcode">Product Code (Eg : x2A)</label></td>
                <td><input class="userInput red-text" type="text" name="product_code" id="product_code" value="x" required></td>
            </tr>
            <tr>
                <td colspan="2"><div class="center-al red-text" id="tip">Code should have 3 characters</div></td>
            </tr>
            <tr>
                <td><label for="unit_type">Unit Type</label></td>
                <td><select class="userInput" type="text" name="unit_type" id="unit_type" required>
                        <option value="Units">Units</option>
                        <option value="Packets">Packets</option>
                        <option value="Bottles">Bottles</option>
                        <option value="Kg">Kg (Kilograms)</option>
                        <option value="L">L (Liter)</option>
                        <option value="Tubes">Tubes</option>
                        <option value="Cans">Cans</option>
                        <option value="Bars">Bars</option>
                        <option value="Pieces">Pieces</option>
                        <option value="Boxes">Boxes</option>
                    </select>
                </td>
            </tr>
            </tr>
            <tr>
                <td><label for="unit_price">Unit price</label></td>
                <td><input class="userInput" type="number" name="unit_price" id="unit_price" min="1" required></td>
            </tr>
            <tr>
                <td><label for="low_stock_level" title="The system will warn you when the stock reaches the low stock limit.">Low Stock Level ⓘ</label></td>
                <td><input class="userInput" type="number" name="low_stock_level" id="low_stock_level" min="1" required></td>
            </tr>
            <tr>
                <td><label for="pre_orderable_stock" title="Customers can only pre-order a limited quantity of each product 
to avoid large orders. Because if shop owners prepare these large orders 
and they are never picked up, it leads to a big loss because the products 
couldn't be sold to in-store customers either.">Amount alowed per pre-order  ⓘ</label></td>
                <td><input class="userInput" type="number" name="amount_alowed_per_pre_Order" value="<?=$product['amount_alowed_per_pre_Order']?>" min="0" required></td>
            </tr>
        </table>
        <button id="formSubmit" class="btn disabled-link w-100px" type="submit">Add</button>
    </form>
</div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/addStock.js" type="module"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/imageUploadBox.js"></script>

<?php $this->component("footer") ?>