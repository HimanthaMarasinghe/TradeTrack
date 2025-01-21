<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1><?=$_SESSION['shop_owner']['shop_name']?></h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="panel mg-10 fg1">
        <div class="row">
            <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
            <a class="btn" href="<?=LINKROOT?>/ShopOwner/addStock">Add stocks</a>
            <a class="btn" href="<?=LINKROOT?>/ShopOwner/distributors">Order Stocks</a>
        </div>
        <div class="scroll-box grid g-resp-300" id="elements-Scroll-Div">
        </div>
    </div>

</div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/stocks.js" type="module"></script>

<?php $this->component("footer") ?>