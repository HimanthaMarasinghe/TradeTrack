<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <?=$_SESSION['shop_owner']['shop_name']?>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="center">
        <div class="p-20">
            <h2>Record Transaction</h2>
        </div>
        <h3 class="center-al">Amount</h3>
        <input class="userInput" type="text">
        <div class="row">
            <a href="" class="btn w-75 m-i-auto">Record</a>
        </div>
    </div>
</div>
<?php $this->component("footer") ?>