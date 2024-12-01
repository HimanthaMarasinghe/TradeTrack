<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Shops</h1>
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
                "name" => "Beachside Groceries",
                "address" => "10 Pitiwella Road, Boossa, Galle"
            ],
            [
                "name" => "Golden Leaf Mart",
                "address" => "22 Kalegana Road, Galle"
            ],
            [
                "name" => "Fort Bazaar Grocery",
                "address" => "35 Parawa Street, Galle Fort"
            ],
            [
                "name" => "Coral Coast Groceries",
                "address" => "18 Mihiripenna Road, Thalpe, Galle"
            ],
            [
                "name" => "Southern Spice Market",
                "address" => "40 Karapitiya Road, Galle"
            ],
            [
                "name" => "Pearl Groceries",
                "address" => "7 Dangedara Junction, Galle"
            ],
            [
                "name" => "Harbor View Mart",
                "address" => "14 Mahamodara Road, Galle"
            ],
            [
                "name" => "Tropical Delights Grocery",
                "address" => "25 Wijayananda Mawatha, Galle"
            ],
            [
                "name" => "Coconut Grove Groceries",
                "address" => "9 Yaddehimulla Road, Unawatuna, Galle"
            ],
            [
                "name" => "Lighthouse Grocery Center",
                "address" => "5 Old Post Office Road, Fort, Galle"
            ]
        ];
        ?>

        <?php foreach ($shops as $shop): ?>
            <a href="#" class="card btn-card colomn asp-rtio">
                <img class="product-img" src="<?=ROOT?>/images/shops/default.jpeg" alt="<?= $shop['name']; ?>">
                <div class="details h-50">
                    <h4><?= $shop['name']; ?></h4>
                    <h4><?= $shop['address']; ?></h4>
                </div>
            </a>
        <?php endforeach; ?>

    </div>

<?php $this->component("footer") ?>