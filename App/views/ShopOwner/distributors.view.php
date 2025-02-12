<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Distributors</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search Distributor" id="searchBar">
    </div>

    <div class="grid g-resp-200 scroll-box" id="elements-Scroll-Div">
    </div>

</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="distributor" class="popUpDiv hidden">
    <h2 id="popUp-distributor-name" class="center-al ">Distributor Name</h2>
    <div class="row alitem-center">
        <div class="colomn fg1">
            <div class="row">
                <div class="colomn">
                    <p>Busines Name</p>
                    <p>Address</p>
                    <p>Phone</p>
                </div>
                <div class="colomn fg1">
                    <p id="popUp-distributor-busines-name">Email</p>
                    <p id="popUp-distributor-address">Address</p>
                    <p id="popUp-distributor-phone">Phone</p>
                </div>
            </div>
            <div class="row">
                <a href="<?=LINKROOT?>/ShopOwner/orderStocks" class="btn">Order stock</a>
                <a href="<?=LINKROOT?>/ShopOwner/stockHistory" class="btn">Stock history</a>
            </div>
        </div>
        <img src="" alt="distibutor image" id="popUp-distributor-image" class="profile-img big" onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
    </div>
    <h4>Distributing products</h4>
    <div class="row product-image-slider" id="slider-container">
        <div class="slider gap-10" id="popUp-distributor-products"></div>
    </div>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/distributors.js" type="module"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>


<?php $this->component("footer") ?>