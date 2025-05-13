<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <a href="<?=LINKROOT?>/Admin/products">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </a>
        <h1>Product Details</h1>
        <div style="opacity: 0;">
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
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
                <td>Rs.<?= number_format($product['unit_price']) ?></td>
            </tr>
            <td>Manufacturer</td>
                <td><?=$manufactuerer['company_name'] ?? 'Unregistered'?></td>
            </tr>
            <tr>
                <td>
                    <button class="btn" id="productButton">Update Details</button>
                    <button onclick="deleteProduct('<?=$product['barcode']?>')" class="btn">Delete Product</button>
                </td>
            </tr>
        </table>
        <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>



    </div>
</div>

<div id="popUpBackDrop" class="hidden"></div>
<div id="updateProducts" class="hidden popUpDiv">
    <h2>Update Product</h2>
    <br>
    <form action="<?=LINKROOT?>/Admin/updateProducts/<?=$product['barcode']?>" method="POST" id="addNewProductForm" enctype="multipart/form-data">

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
            <tr>
                <td><label for="barcode">Bar Code</label></td>
                <td><input class="userInput" type="text" name="barcode" id="product_code" required></td>
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
                <td><input class="userInput" type="text" name="unit_price" id="unit_price" required></td>
            </tr>
        </table>
        <button id="formSubmit" class="btn w-100px" type="submit">Update</button>
    </form>
</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const clickLink = "Admin/product";
    function deleteProduct(barcode){
        fetch(LINKROOT+'/Admin/deleteProduct', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'barcode=' + encodeURIComponent(barcode)
    })
    .then(
        () => location.reload()
    )
    .catch(error => console.error('Error:', error));
    }
</script>
<script src="<?=ROOT?>/js/loadAllProducts.js" type="module"></script>
<script src="<?=ROOT?>/js/Admin/updateProducts.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<script src="<?=ROOT?>/js/imageUploadBox.js"></script>
<!-- <script src="<?=ROOT?>/js/Admin/uploadImage.js"></script> -->

<?php $this->component("footer") ?>