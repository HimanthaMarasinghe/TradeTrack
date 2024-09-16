<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Orders</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <h2>New Orders</h2>
            <div class="scroll-box grid g-resp-300">
                <?php 
                    foreach ($newOrders as $nOrder)
                    {
                        $this->component('card/order', $nOrder); 
                    }
                ?>
            </div>
        </div>

        <div class="panel mg-10 fg1">
        <h2>Orders in process</h2>
            <div class="scroll-box grid g-resp-300">
                <?php
                    foreach ($processingOrders as $pOrder)
                    {
                        $this->component('card/order', $pOrder); 
                    }
                ?>
            </div>
        </div>
    </div>

</div>

<?php $this->component("footer") ?>