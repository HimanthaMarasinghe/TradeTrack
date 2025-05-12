<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        
        <a href="<?=LINKROOT?>/Manufacturer/home"><img src="<?=ROOT?>/images/icons/home.svg" alt=""> </a>
        <h1>Pending New Products</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Manufacturer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/Manufacturer/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
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
                <td><input class="userInput" type="text" name="barcode" id="barcode" pattern="[0-9]{13}" title="Please enter exactly 13 digits"></td>
            </tr>
            <tr>
                <td colspan="2"><p>If your product do not have a barcode leave the above field empty. The system will generate a barcode for your product.</p></td>
            </tr>
            <tr>
                <td><label for="barcode">Barcode Registration Proof</label></td>
                <td><input type="file" id="barcodeProof" name="barcodeProof" accept=".jpg, .jpeg, .png, .pdf"></td>
            </tr>
            <tr>
                <td colspan="2"><p>If you add a barcode to the form, please upload the official barcode registration document, or a product wraper.</p></td>
            </tr>
            <tr>
                <td><label for="unit_price">Unit price</label></td>
                <td><input class="userInput" type="number" name="unit_price" id="unit_price" required></td>
            </tr>
            <tr>
                <td><label for="bulk_price">Bulk price</label></td>
                <td><input class="userInput" type="number" name="bulk_price" id="bulk_price" required></td>
            </tr>
            <tr>
                <td><label for="Commission">Commission</label></td>
                <td><input class="userInput" type="number" min='1' max='99' name="commission_percentage" id="Commission" required></td>
            </tr>
        </table>
        <input type="submit" class="btn" id="formSubmitBtn" value="Make request">
        <!-- <button type="submit" class="btn">Make Request</button> -->
    </form>
</div>

<div id="productDetails" class="hidden popUpDiv colomn">
    <h2>Product is sent to admin review</h2>
    <div class="row">
        <img id="popUpImage" src="<?=ROOT?>/images/Default/Product.jpeg" alt="" class="default big">
        <!-- <img id="popUpProofImage" src="<?=ROOT?>/images/Default/Product.jpeg" alt="" class="default big"> -->
    </div>
    <table>
        <h3 id="req-prd-name"></h3>
        <tr>
            <td>Barcode</td>
            <td id="req-prd-barcode"></td>
        </tr>
        <tr id="req-prd-barcodeProofRow">
            <td>Barcode Proof</td>
            <td><a id="req-prd-barcodeProof" href="" class="btn">Download</a></td>
        </tr>
        <tr>
            <td>Unit Price</td>
            <td id="req-prd-price"></td>
        </tr>
        <tr>
            <td>Bulk Price</td>
            <td id="req-prd-bulk"></td>
        </tr>

        <tr>
            <td>commission</td>
            <td id="req-prd-com"></td>
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
    const ws_id = "<?=$_SESSION['manufacturer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
    
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Manufacture/pending.js"></script>
<script src="<?=ROOT?>/js/imageUploadBox.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>


<?php $this->component("footer") ?>