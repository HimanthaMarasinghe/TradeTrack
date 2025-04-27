<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
         <a href="<?=LINKROOT?>/Manufacturer/home"><img src="<?=ROOT?>/images/icons/home.svg" alt=""> </a>
        <h1>Inventory Request</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Manufacturer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/Manufacturer/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>

    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
        <div class="row">
            <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search"  >
            
        </div>
        <div class="grid g-resp-200 scroll-box" id="scrollBox">
      
        </div>
</div>

</div>
<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div class="popUpDiv hidden" id="requestDetails">
    <h2>Inventory Request Details</h2>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <h3>Disbutor name:</h3>
            <h3>Business Name:</h3>
            <h3>Date:</h3>
            <h3>Time:</h3>
        </div>
        <div class="colomn fg1">
            <h3 id="req_dis_name"></h3>
            <h3 id="req_buis_name"></h3>
            <h3 id="req_date"></h3>
            <h3 id="req_time"></h3>
            
        </div>
        <img id="req_pic" class="profile-photo" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    </div>
    <button id="submitButton" class="btn">Accept</button> <br>
    <button id="submitButton2" class="btn">Reject</button>
</div>


<script>
    const LINKROOT = '<?=LINKROOT?>';
    const ROOT = '<?=ROOT?>';
    const ws_id = "<?=$_SESSION['manufacturer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Manufacture/DisReq.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<?php $this->component("footer") ?>