<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="top">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <div>
                <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
                <a href="#"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
            </div>
        </div>

        <div class="bar">
            <h1><?=$_SESSION['name']?></h1>
            <a class="btn" href="<?=LINKROOT?>/SalesAgent/newRequest">
                <h4>New Request</h4>
            </a>
        </div>
    </div>

    <div class="grid-box fg1">
        <div class="panel pre-orders">
            <h2>Orders</h2>
            <div class="scroll-box">
            <?php for($x = 0; $x <20; $x++){ ?>
            <a href="<?=LINKROOT?>/SalesAgent/order" class="card btn-card center-al">
                <div class="profile-photo">
                    <img src="<?=ROOT?>/images/Shops/default.jpeg" alt="J">
                </div>
                <div class="details center-al">
                    <h4>Shop Name</h4>
                    <h4>1 hour ago</h4>
                </div>
            </a>
            <?php } ?>
            </div>
        </div>

        <div class="panel cash-drawer">
            <h2>Cash Drawer Balance</h2>
            <div class="balance">
                <h1>Rs. 150,000.00</h1>
            </div>
        </div>

        <div class="panel low-stocck">
            <h2>Low Stocks</h2>
            <div class="scroll-box grid g-resp-300">
                <?php for($x = 0; $x <20; $x++){ ?>
                    <a href="<?=LINKROOT?>/SalesAgent/stockProduct" class="card btn-card center-al">
                    <div class="details h-100">
                        <h4>Product Name</h4>
                        <h4>00</h4>
                        <h4>Rs.2000.00</h4>
                    </div>
                    <div class="product-img-container">
                        <img class="product-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php $this->component("footer") ?>