<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center done">

        <div class="p-20">
            <h1><?=$cusName?></h1>
        </div>

        <h1>Total</h1>
        <h1>10,000</h1>

        <h4>Customer's Phone number</h4>
        <input class="userInput" type="text">

        <h4>Customer's E-mail</h4>
        <input class="userInput" type="text">

        <div>
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h3>Order Status set to ready.</h3>
        </div>

        <a href="<?=LINKROOT?>/Supplier/home" class="btn">Home</a>
        <a href="<?=LINKROOT?>/Supplier/orders" class="btn">Orders</a>
        
    </div>
</div>

<?php $this->component("footer") ?>