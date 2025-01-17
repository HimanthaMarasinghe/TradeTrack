<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center done">

        <div class="p-20">
            <h1><?=$preOrderDetails['first_name']?> <?=$preOrderDetails['last_name']?></h1>
        </div>

        <h1>Total</h1>
        <h1>Rs.<?=$preOrderDetails['total']?></h1>

        <h4>Customer's Phone number</h4>
        <h4><?=$preOrderDetails['cus_phone']?></h4>

        <div>
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h3>Order Status set to ready.</h3>
        </div>

        <a href="<?=LINKROOT?>/ShopOwner/Home" class="btn">Home</a>
        <a href="<?=LINKROOT?>/ShopOwner/customers" class="btn">Customers</a>
        
    </div>
</div>

<script>
    localStorage.removeItem('processingPreOrder'+<?=$preOrderDetails['pre_order_id']?>);
</script>

<?php $this->component("footer") ?>