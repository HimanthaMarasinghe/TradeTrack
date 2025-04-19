<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>My Distributors</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
      <!-- <button class="btn">Search</button> -->
      <!-- <a href="<?=LINKROOT?>/Manufacturer/addNewAgents" class="btn">Add new Agents</a> -->
       <button class="btn" onclick="viewPopUp('addNewAgent')">Add new Distributor</button>
    </div>

    <div class="grid g-resp-200 scroll-box" id="scrollBox">
      
      
    </div>
<!-- Your html code goes here -->

</div>

<!-- add new agent popup -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addNewAgent" class="popUpDiv hidden">
    <h2>Add a new Distributor</h2>
    <br>
    <form action="<?=LINKROOT?>/Manufacturer/addNewAgents" method="POST">

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
                <td><input class="userInput" type="text" name="phone" id="dis_phone" required></td>
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

<script>
    const LINKROOT = '<?=LINKROOT?>';
    const ROOT = '<?=ROOT?>';
</script>
<script src="<?=ROOT?>/js/Manufacture/distributor.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>