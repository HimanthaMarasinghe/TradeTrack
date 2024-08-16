<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center done">

        <h1>Total</h1>
        <h1>10,000</h1>

        <h4>Customer's Phone number</h4>
        <input class="billSettle" type="text">

        <h4>Customer's E-mail</h4>
        <input class="billSettle" type="text">

        <div>
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h1>Done!</h1>
        </div>

        <a href="<?=LINKROOT?>/ShopOwner/Home" class="btn">Home</a>
        <a href="<?=LINKROOT?>/ShopOwner/newPurchase" class="btn">Next Customer</a>

    </div>
</div>

<?php $this->component("footer") ?>