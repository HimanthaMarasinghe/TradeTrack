<?php
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">

    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <div>
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            </div>
        </div>

        <div class="bar">
            <h1><?=$_SESSION['name']?></h1>
            <a class="btn" href="http://localhost/TradeTrack/ShopOwner/newPurchase">
                <h4>New Purchase</h4>
            </a>
        </div>
    </div>

    <div class="grid-box fg1">
        <div class="panel pre-orders">
            <h2>Pre-Orders</h2>
            <div class="scroll-box">
                <?php 
                    foreach ($preOrders as $order)
                    {
                        $this->component('card/preOrder', $order); 
                    }
                ?>
            </div>
        </div>

        <div class="panel cash-drawer">
            <h2>Cash Drawer Balance</h2>
            <div class="balance">
                <h1>Rs. 150,000.00</h1>
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

<?php $this->component("footer") ?>