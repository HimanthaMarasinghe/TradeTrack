<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content">

        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <!-- <h1><?=$_SESSION['name']?></h1> -->
             <h1>Shop Name</h1>
            <div>
                <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
            </div>
        </div>


    <div class="grid-box">
        <div class="panel-removeUser loyalty-cus-adminRem">
            <h2>Loyalty Customers</h2>
            <div class="scroll-box">
                <?php 
                    foreach ($loyalCus as $Cus)
                    {
                        $this->component('card/LoyCusAdmin', $Cus); 
                    }
                ?>
            </div>
        </div>
    </div>
    
</div>

<?php $this->component("footer") ?>