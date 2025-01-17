<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <div class="coloum center-al">
            <h1><?=$_SESSION['shop_owner']['shop_name']?></h1>
            <h2>Pre-Order History</h2>
        </div>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
        <div class="row">
            <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
        </div>
        <div class="scroll-box grid g-resp-300" id="elements-Scroll-Div">
        </div>
    </div>

</div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/preOrderHistory.js"></script>
<script src="<?=ROOT?>/js/apiFetcher.js"></script>

<?php $this->component("footer") ?>