<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1><?=$_SESSION['distributor']['dis_business_name']?></h1>
        <h1>Requested Manufacturers</h1>
        <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" id="search" class="search-bar fg1" placeholder="Search Manufacturer">
    </div>
    

    <div class="grid g-resp-200 scroll-box" id="elements">
    
    </div>

    <!-- Pop up model -->
    <div id="popUpBackDrop" class="hidden"></div>
    <div class="popUpDiv hidden" id="manPopUp">
        <div>
            <h2 id="popUpManCompanyName"></h2>
            <img id="popUpManImage" class="popup-image" src=""
            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'" 
            alt="Manufacturer Image">
            
            <table class="profile">
            <tr>
                <td><strong>Mnaufacturer Name</strong></td>
                <td>: <span id="popUpManName"></span></td>
            </tr>
            <tr>
                <td><strong>Contact Number</strong></td>
                <td>: <span id="popUpManPhone"></span></td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td>: <span id="popUpCompanyAddress"></span></td>
            </tr>
            <tr>
                <td colspan = "2">
                    <div class="row">
                        <form method ="post" id ="sendRquestBtn" action="<?=LINKROOT?>/DistributorNoMan/removeDisRequest">
                            <input type="hidden" id="man_phonehidden" name="man_phonehidden">
                            <button type="submit" class = "btn fg1" >Remove Request</button>
                        </form>
                    </div>
                </td>
            </tr>
            </table>
        </div>
    </div>
    
    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const ws_id = "<?=$_SESSION['Distributor']['phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/requestedManufacturers.js"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>
    <script src='<?=ROOT?>/js/notificationConfig.js' type="module"></script>


<?php $this->component("footer") ?>