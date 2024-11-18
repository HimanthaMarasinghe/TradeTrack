<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>


<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Supplier's Shop Name</h1>
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

            <?php for($x = 0; $x <20; $x++){ ?>
                <a href="<?=LINKROOT?>/SalesAgent/stockProduct" class="card btn-card center-al">
                    <div class="details h-100">
                        <h4>Maliban Milk Powder 400g</h4>
                        <h4>5000</h4>
                        <h4>Rs.1260.00</h4>
                    </div>
                    <div class="product-img-container">
                        <img class="product-img" src="<?=ROOT?>/images/Products/4790015950624.png" alt="">
                    </div>
                </a>
                <?php }?>
             </div>
        </div>

        <div class="panel warning mg-10 fg1">
        <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
            <?php for($x = 0; $x <20; $x++){ ?>
                <a href="<?=LINKROOT?>/SalesAgent/stockProduct" class="card btn-card center-al">
                    <div class="details h-100">
                        <h4>Maliban Milk Powder 400g</h4>
                        <h4>10</h4>
                        <h4>Rs.1260.00</h4>
                    </div>
                    <div class="product-img-container">
                        <img class="product-img" src="<?=ROOT?>/images/Products/4790015950624.png" alt="">
                    </div>
                </a>
                <?php }?>
            </div>
        </div>
    </div>

</div>

<?php $this->component("footer") ?>