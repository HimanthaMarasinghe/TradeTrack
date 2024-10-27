<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Shop Name</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
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