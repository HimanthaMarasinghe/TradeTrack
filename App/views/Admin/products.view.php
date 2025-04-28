<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>


<div class="main-content colomn">

    <div class="bar">
        <a href="<?=LINKROOT?>/Admin/home">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </a>
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All Products</h1>
        <div style="opacity: 0;">
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
                <button class="btn" id="productButton">Add new product</button>
                <a class="btn"  href="<?=LINKROOT?>/Admin/newProductRequests">New product add requests</a>
            </div>
            <div class="scroll-box grid g-resp-200" id="elements-Scroll-Div">
             </div>
        </div>
    </div>

</div>

<div id="popUpBackDrop" class="hidden"></div>
<div id="addNewProducts" class="hidden popUpDiv">
    <h2>Add new Product</h2>
    <br>
    <form action="<?=LINKROOT?>/Admin/addNewProducts" method="POST" id="addNewProductForm" enctype="multipart/form-data">

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
                <td><input class="userInput" type="number" name="barcode" id="product_code" required></td>
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
        </table>
        <button id="formSubmit" class="btn w-100px" type="submit">Add</button>
    </form>
</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const clickLink = "Admin/product";
  </script>
  <script src="<?=ROOT?>/js/loadAllProducts.js" type="module"></script>
  <script src="<?=ROOT?>/js/Admin/addNewProducts.js"></script>
  <script src="<?=ROOT?>/js/popUp.js"></script>

  <script src="<?=ROOT?>/js/uploadImage.js"></script>
  <script src="<?=ROOT?>/js/Admin/uploadImage.js"></script>

<?php $this->component("footer") ?>