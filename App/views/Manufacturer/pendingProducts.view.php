<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Pending New Products</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar" >
               
                <button class="btn" onclick="addNewProduct()">Add new products</button>
            </div>
            <div class="scroll-box grid g-resp-200" id="scrollBox" >
           <!-- <?php
                foreach ($pendingProducts as $product)
                {
                $this->component('card/pending', $product); 
                }
            ?> --> 
            </div>
        </div>
    </div>

</div>

<!-- add new product request popup -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addNewProducts" class="hidden popUpDiv">
    <h2>Make a request to add new product</h2>
    <br>
    <form action="<?=LINKROOT?>/Manufacturer/newProductRequest" method="POST" id="addNewProductForm" enctype="multipart/form-data">

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
                <td><label for="barcode">Barcode</label></td>
                <td><input class="userInput" type="text" name="barcode" id="barcode"></td>
            </tr>
            <tr>
                <td colspan="2"><p>If your product do not have a barcode leave the above field empty. The system will generate a barcode for your product.</p></td>
            </tr>
            <tr>
                <td><label for="barcode">Barcode Registration Proof</label></td>
                <td><input type="file" id="barcodeProof" name="barcodeProof" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"></td>
            </tr>
            <tr>
                <td colspan="2"><p>If you add a barcode to the form, please upload the official barcode registration document, or a product wraper.</p></td>
            </tr>
            <tr>
                <td><label for="unit_price">Unit price</label></td>
                <td><input class="userInput" type="text" name="unit_price" id="unit_price" required></td>
            </tr>
            <tr>
                <td><label for="bulk_price">Bulk price</label></td>
                <td><input class="userInput" type="text" name="bulk_price" id="bulk_price" required></td>
            </tr>
        </table>
        <input type="submit" class="btn" id="formSubmitBtn" value="Make request">
    </form>
</div>

<div id="productDetails" class="hidden popUpDiv colomn">
    <h2>Product is sent to admin review</h2>
    <img id="popUpImage" src="<?=ROOT?>/images/Default/Product.jpeg" alt="" class="default big">
    <table>
        <h3 id="req-prd-name">Lorem ipsum dolor sit amet.</h3>
        <tr>
            <td>Barcode</td>
            <td id="req-prd-barcode"></td>
        </tr>
        <tr>
            <td>Unit Price</td>
            <td id="req-prd-price"></td>
        </tr>
        <tr>
            <td>Bulk Price</td>
            <td id="req-prd-bulk"></td>
        </tr>
    </table>
    <div class="row">
        <button class="btn fg1" id="update-btn">Update</button>
        <button class="btn fg1" id="delete-btn">Delete</button>
    </div>
</div>

<script>
    const LINKROOT = '<?=LINKROOT?>';
    const ROOT = '<?=ROOT?>';
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Manufacture/pending.js"></script>
<script src="<?=ROOT?>/js/imageUploadBox.js"></script>


<?php $this->component("footer") ?>