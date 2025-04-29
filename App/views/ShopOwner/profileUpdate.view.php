<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">

<h2>Shop Owner Profile </h2>
<!-- Your html code goes here -->
 <form action="<?=LINKROOT?>/ShopOwner/profileUpdate" method="POST" class="row" enctype="multipart/form-data">
    <div class="colomn m-b-auto">
        <div class="imageUploadBox" id="pop">
            <h3>Profile Image</h3>
            <div id="imagePreview" class="imagePreviewBox">
                <div id="imageContainer">
                    <?php if(file_exists("./images/Profile/".$_SESSION['shop_owner']['phone'].".".$_SESSION['shop_owner']['pic_format'])) { ?>
                    <img 
                        src="<?=ROOT?>/images/Profile/<?= $_SESSION['shop_owner']['phone']?>.<?=$_SESSION['shop_owner']['pic_format']?>" 
                        alt="Profile Image" 
                        id="profileImage" 
                        class="existImage"
                        >
                    <?php } ?>
                    <input type="text" class="hidden" name="remove_image" id="remove_image" value="false">
                </div>
            </div>
            
            <input type="file" class="imageChooseInput" name="image" id="image" 
            accept="image/jpg, image/jpeg, image/png, image/webp" 
            onchange="previewImage(event)">
            
            <button type="button" class="imageChooseBtn" onclick="triggerFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeImage()">Remove</button>
        </div>
        <div class="imageUploadBox" id="shop_pop">
            <h3>Shop Image</h3>
            <div id="shop_imagePreview" class="imagePreviewBox">
                <div id="shop_imageContainer">
                    <?php if(file_exists("./images/Shops/".$_SESSION['shop_owner']['phone'].".".$_SESSION['shop_owner']['shop_pic_format'])) { ?>
                    <img 
                        src="<?=ROOT?>/images/Shops/<?= $_SESSION['shop_owner']['phone']?>.<?=$_SESSION['shop_owner']['shop_pic_format']?>" 
                        alt="Profile Image" 
                        id="shopImage" 
                        class="existImage"
                        >
                    <?php } ?>
                    <input type="text" class="hidden" name="remove_shop_image" id="remove_shop_image" value="false">
                </div>
            </div>
            
            <input type="file" class="imageChooseInput" name="shop_image" id="shop_image" 
            accept="image/jpg, image/jpeg, image/png, image/webp" 
            onchange="previewShopImage(event)">
            
            <button type="button" class="imageChooseBtn" onclick="triggerShopFileInput()">Choose</button>
            <button type="button" class="imageRemoveBtn" onclick="removeShopImage()">Remove</button>
        </div>
    </div>
    

    <table class="ProfileUpd">
            <tr>
                <td>Shop owner's Phone Number</td>
                <td><input class="userInput" type="text" name="phone" id="" value="<?=$_SESSION['shop_owner']['phone']?>"></td>
            </tr>
            <tr>
                <td>Shop Name</td>
                <td><input class="userInput" type="text" name="shop_name" id="" value="<?=$_SESSION['shop_owner']['shop_name']?>"></td>
            </tr>
            <tr>
                <td>Shop owner's  First Name</td>
                <td><input class="userInput" type="text" name="first_name" id="" value="<?=$_SESSION['shop_owner']['first_name']?>"></td>
            </tr>
            <tr>
                <td>Shop owner's  last name</td>
                <td><input class="userInput" type="text" name="last_name" id="" value="<?=$_SESSION['shop_owner']['last_name']?>"></td>
            </tr>
            <tr>
                <td>shop address </td>
                <td><input class="userInput" type="text" name="shop_address" id="" value="<?=$_SESSION['shop_owner']['shop_address']?>"></td>
            </tr>
            <tr>
                <td>shop owner address </td>
                <td><input class="userInput" type="text" name="address" id="" value="<?=$_SESSION['shop_owner']['address']?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <input type="submit" class="btn" value="Update">
                </td>
            </tr>
        </table>


 </form>

</div>
<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>

<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<script src="<?=ROOT?>/js/imageUploadBox.js"></script>
<script src="<?=ROOT?>/js/ShopOwner/profileUpdate.js"></script>

<?php $this->component("footer") ?>