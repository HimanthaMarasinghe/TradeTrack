<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">

    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="" style="visibility:hidden;">
            <div>
                <!-- <img src="<?=ROOT?>/images/icons/settings.svg" alt=""> -->
                <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
            </div>
        </div>

        <div class="bar">
            <h1><?=$_SESSION['name']?></h1>
            <a class="btn" href="<?=LINKROOT?>/ShopOwner/newPurchase">
                <h4>New Purchase</h4>
            </a>
        </div>
    </div>

    <div class="grid-box fg1">
        <div class="panel pre-orders">
            <h2>New Pre-Orders</h2>
                <div class="scroll-box" id="elements-Scroll-Div"></div>
        </div>

        <div class="panel cash-drawer">
            <h2>Cash Drawer Balance</h2>
            <div class="balance">
                <h1>Rs.<?=$cashDrawerBallance?>.00</h1>
            </div>
        </div>

        <div class="panel low-stocck">
            <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
                <?php 
                    foreach ($stocks as $stock)
                    {
                        $this->component('card/product', $stock); 
                    }
                    
                    foreach ($lowStocks as $stock)
                    {
                        $this->component('card/product', $stock); 
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>

<script src="<?=ROOT?>/js/ShopOwner/home.js" type="module"></script>


<?php $this->component("footer") ?>