<?php
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">

        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <!-- <h1><?=$_SESSION['name']?></h1> -->
             <h1>Shop Name</h1>
            <div>
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
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

        <div class="panel new-lc-req">
            <h2>New Loyalty Customer Request</h2>
            <div class="scroll-box">
                <?php 
                    foreach ($newLoyalCusReq as $req)
                    {
                        $this->component('card/newLoyalCusReq', $req); 
                    }
                ?>
            </div>
        </div>

        <div class="panel loyalty-cus">
            <h2>Loyalty Customers</h2>
            <div class="scroll-box">
                <?php 
                    foreach ($loyalCus as $Cus)
                    {
                        $this->component('card/LoyCus', $Cus); 
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php $this->component("footer") ?>