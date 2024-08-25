<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center done">

        <div>
            <h1><?=$cusName?></h1>
        </div>

        <h1>Total</h1>
        <h1>10,000</h1>

        <h4>Customer's Phone number</h4>
        <input type="text">

        <h4>Customer's E-mail</h4>
        <input type="text">

        <div>
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h3>Order Status set to ready.</h3>
        </div>

        <a href="<?=LINKROOT?>/ShopOwner/Home" class="btn">Home</a>
        <a href="<?=LINKROOT?>/ShopOwner/LoyaltyCustomers" class="btn">Loyalty Customers</a>
        
    </div>
</div>

<?php $this->component("footer") ?>