<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <a href="<?=LINKROOT?>/Manufacturer/home"><img src="<?=ROOT?>/images/icons/home.svg" alt=""> </a>
        <h1>My Distributors</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Manufacturer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/Manufacturer/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
      <!-- <button class="btn">Search</button> -->
      <a href="<?=LINKROOT?>/Manufacturer/pendingdisrequest" class="btn">Pending Distributor Request</a>
       <!-- <button class="btn" onclick="viewPopUp('addNewAgent')">Add new Distributor</button> -->
    </div>

    <div class="grid g-resp-200 scroll-box" id="scrollBox">
      
      
    </div>
</div>


<!-- add new agent popup -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addNewAgent" class="popUpDiv hidden">
    <h2>Add a new Distributor</h2>
    <br>
    <form action="<?=LINKROOT?>/Manufacturer/addNewAgents" method="POST" >

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
                <td><label for="dis_phone">Distributor's Phone Number</label></td>
                <td><input class="userInput" type="text" name="phone" required></td>
            </tr>
            <tr>
                <td><label for="sa_busines_name">Business Name</label></td>
                <td><input class="userInput" type="text" name="sa_busines_name" id="" required></td>
            </tr>
            <tr>
                <td><label for="sa_first_name">Distributor's First Name</label></td>
                <td><input class="userInput" type="text" name="first_name" id="sa_first_name" required></td>
            </tr>
            <tr>
                <td><label for="sa_last_name">Distributor's Last Name</label></td>
                <td><input class="userInput" type="text" name="last_name" id="sa_last_name" required></td>
            </tr>
            <tr>
                <td><label for="sa_address">Distributor's Address</label></td>
                <td><input class="userInput" type="text" name="address" id="sa_address" required></td>
            </tr>
        </table>
        <input type="submit" class="btn" value="Add new Distributor">
    </form>
</div>

<div class="popUpDiv hidden"  id="distributor_details">
    <h2>Details of Distributor</h2>
    <div class="row spc-btwn w-100">
        <div class="column">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="font-weight: bold; padding: 8px;">Distributor Name:</td>
                        <td style="padding: 8px;" id="dis_name"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding: 8px;">Distributor Business Name:</td>
                        <td style="padding: 8px;" id="dis_business_name"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding: 8px;">Distributor Phone:</td>
                        <td style="padding: 8px;" id="dis_phone"></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding: 8px;">Distributor Business Address:</td>
                        <td style="padding: 8px;" id="dis_business_address"></td>
                    </tr>
                </table>
        </div>

        <img id="dis-img" class="profile-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    
</div>

<script>
    const LINKROOT = '<?=LINKROOT?>';
    const ROOT = '<?=ROOT?>';
    const ws_id = "<?=$_SESSION['manufacturer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>
<script src="<?=ROOT?>/js/Manufacture/distributor.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/imageUploadBox.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>

<?php $this->component("footer") ?>