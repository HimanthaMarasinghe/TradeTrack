<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center done">

        <h1>Total</h1>
        <h1><?=$total?></h1>

        <h4>Customer's Phone number</h4>
        <!-- <h4><?=$cus_phone?></h4> -->
        <input class="userInput" type="text" value="<?=$cus_phone?>" readonly>

        <h4>Customer's E-mail</h4>
        <!-- <h4><?=$cus_email?></h4> -->
        <input class="userInput" type="text" value="<?=$cus_email?>" readonly>

        <div>
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h1>Done!</h1>
        </div>

        <a href="<?=LINKROOT?>/ShopOwner/Home" class="btn" id="home">Home</a>
        <a href="<?=LINKROOT?>/ShopOwner/newPurchase" class="btn" id="next">Next Customer</a>

    </div>
</div>

<script>
    document.addEventListener('keydown', function(event) {
            if (event.key === 'Home') {
                document.getElementById('home').click();
            }
            if (event.key === 'Enter') {
                document.getElementById('next').click();
            }
        });
</script>

<?php $this->component("footer") ?>