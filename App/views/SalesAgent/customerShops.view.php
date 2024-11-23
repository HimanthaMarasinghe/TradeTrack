<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Customer Shops</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search">
      <button class="btn">Search</button>
    </div>

    <div class="grid g-resp-200 scroll-box">
        <?php
        $shops = [
            [
                "name" => "Galle Supermarket",
                "address" => "15 Matara Road, Galle"
            ],
            [
                "name" => "Sunrise Grocery Store",
                "address" => "21 Lighthouse Street, Fort, Galle"
            ],
            [
                "name" => "Green Valley Groceries",
                "address" => "45 Richmond Hill Road, Galle"
            ],
            [
                "name" => "Fort Fresh Market",
                "address" => "10 Rampart Street, Galle Fort"
            ],
            [
                "name" => "Ocean View Grocery",
                "address" => "27 Piyadigama Road, Unawatuna, Galle"
            ],
            [
                "name" => "Galle Essentials",
                "address" => "89 Wakwella Road, Galle"
            ],
            [
                "name" => "Southern Groceries",
                "address" => "33 Havelock Place, Galle"
            ],
            [
                "name" => "Cinnamon Market",
                "address" => "50 Hikkaduwa Road, Galle"
            ],
            [
                "name" => "Hilltop Grocery",
                "address" => "12 Labuduwa Junction, Galle"
            ],
            [
                "name" => "Galle Mart",
                "address" => "70 Pettigalawatta Road, Galle"
            ]
        ];        
        ?>
        
            <?php foreach ($shops as $shop): ?>
                <a href="<?=LINKROOT?>/SalesAgent/shopProfile" class="card btn-card colomn asp-rtio">
                    <img class="product-img" src="<?=ROOT?>/images/shops/default.jpeg" alt="<?= $shop['name']; ?>">
                    <div class="details h-50">
                        <h4><?= $shop['name']; ?></h4>
                        <h4><?= $shop['address']; ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>

    </div>

<?php $this->component("footer") ?>