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
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search">
                <button class="btn">Search</button>
            </div>
            <div class="scroll-box grid g-resp-300">
                <?php 
                    foreach ($stocks as $stock)
                    {
                        $this->component('card/product', $stock); 
                    }
                    foreach ($staticStocks as $stock)
                    {
                        $this->component('card/product', $stock); 
                    }
                ?>
            </div>
        </div>

        <div class="panel warning mg-10 fg1">
        <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
                <?php
                    foreach ($lowStocks as $stock)
                    {
                        $this->component('card/product', $stock); 
                    }
                ?>
            </div>
        </div>
    </div>

</div>

<?php $this->component("footer") ?>