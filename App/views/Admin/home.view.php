<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">
            <div class="bar">
                <img src="<?=ROOT?>/images/icons/home.svg" alt="">
                <h1>Dashboard</h1>
                <div>
                    <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
                    <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
                </div>
            </div>
    <div class="dashboard">
        <div class="card card-blue">
        <h2><?=$totalCustomers?></h2>
        <p>Total Customers</p>
        <a href="<?=LINKROOT?>/Admin/Customers">More info</a>
        </div>

        <div class="card card-orange">
        <h2><?=$totalLoyalCustomers?></h2>
        <p>Loyal Customers</p>
        <a href="<?=LINKROOT?>/Admin/Customers">More info</a>
        </div>

        <div class="card card-red">
        <h2><?=$shopOwners?></h2>
        <p>Shop Owners</p>
        <a href="<?=LINKROOT?>/Admin/Shops">More info</a>
        </div>

        <div class="card card-green">
        <h2><?=$distributors?></h2>
        <p>Distributors</p>
        <a href="<?=LINKROOT?>/Admin/Distributors">More info</a>
        </div>

        <div class="card card-teal">
        <h2><?=$manufacturers?></h2>
        <p>Manufacturers</p>
        <a href="<?=LINKROOT?>/Admin/Manufacturers">More info</a>
        </div>

        <div class="card card-purple">
        <h2><?=$products?></h2>
        <p>Products</p>
        <a href="<?=LINKROOT?>/Admin/Products">More info</a>
        </div>
        <!-- Separator line -->
    </div>
    <hr class="separator">

    <!-- Announcement card section -->
    <div class="announcement-section">
        <div class="card card-announcement">
        <h2>Make Announcements</h2>
        <a href="<?=LINKROOT?>/Admin/announcements">Go to Announcements</a>
        </div>
    </div>
</div>


<?php $this->component("footer") ?>