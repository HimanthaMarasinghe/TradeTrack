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
        <h2>20</h2>
        <p>Total Customers</p>
        <a href="#">More info</a>
        </div>

        <div class="card card-orange">
        <h2>8</h2>
        <p>Loyal Customers</p>
        <a href="#">More info</a>
        </div>

        <div class="card card-red">
        <h2>10</h2>
        <p>Shop Owners</p>
        <a href="#">More info</a>
        </div>

        <div class="card card-green">
        <h2>15</h2>
        <p>Sales Agents</p>
        <a href="#">More info</a>
        </div>

        <div class="card card-teal">
        <h2>12</h2>
        <p>Suppliers</p>
        <a href="#">More info</a>
        </div>

        <div class="card card-purple">
        <h2>45</h2>
        <p>Products</p>
        <a href="#">More info</a>
        </div>

        <div class="card card-pink">
        <h2>7</h2>
        <p>Total Enquiries</p>
        <a href="#">More info</a>
        </div>
        <br>

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