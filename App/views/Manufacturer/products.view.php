<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <a href="<?=LINKROOT?>/Manufacturer/home"><img src="<?=ROOT?>/images/icons/home.svg" alt=""> </a>
        <h1>Products</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Manufacturer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/Manufacturer/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
                <a class="btn" href="<?=LINKROOT?>/Manufacturer/pendingProducts">Pending Products</a>
            </div>
            <div class="scroll-box grid g-resp-200" id="scrollBox">
             
            </div>
        </div>
    </div>

</div>

<script>
    const LINKROOT = '<?=LINKROOT?>';
    const ROOT = '<?=ROOT?>';
    const ws_id = "<?=$_SESSION['manufacturer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>
<script src="<?=ROOT?>/js/Manufacture/products.js"></script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
<?php $this->component("footer") ?>