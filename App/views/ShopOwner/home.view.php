<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="" style="visibility:hidden;">
            <h1><?=$_SESSION['shop_owner']['shop_name']?></h1>
            <div class="row gap-10">
                <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
            </div>
        </div>

        <div class="bar m-bot-10px ">
            <span></span>
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
            <div class="balance colomn">
                <h1>Rs.<?=number_format($cashDrawerBallance, 2)?></h1>
                <?php if($cashDrawerBallance < 0) { ?>
                    <h4 class="red-text">Warning: The Cash Drawer balance is below zero. You might have missed recording a cash inflow.</h4>
                <?php } ?>
            </div>
        </div>

        <div class="panel low-stocck">
            <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
                <?php 
                    foreach ($lowStocks as $stock)
                    {
                        if(strlen($stock['barcode']) == 13) {
                            $this->component('card/product', $stock, ['baseUrl' => "ShopOwner/Product"]); 
                        } else {
                            $this->component('card/uniqueProduct', $stock, ['baseUrl' => "ShopOwner/Products"]);
                        }
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

<?php 
    unset($_SESSION['web_socket_token']);
    $this->component("footer") 
?>