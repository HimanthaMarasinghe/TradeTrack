<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All Shop Owners</h1>
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
$shopOwners = [
    ["name" => "Amal", "address" => "111, Colombo, Sri Lanka", "image" => "0987654321.jpg"],
    ["name" => "Amila", "address" => "22, Kandy, Sri Lanka", "image" => "0372222701.jpg"],
    ["name" => "Saman", "address" => "33, Galle, Sri Lanka", "image" => "0372222702.jpg"],
    ["name" => "Nimal", "address" => "44, Jaffna, Sri Lanka", "image" => "0372222703.jpg"],
    ["name" => "Priya", "address" => "55, Anuradhapura, Sri Lanka", "image" => "0372222704.jpg"],
    ["name" => "Ravi", "address" => "66, Negombo, Sri Lanka", "image" => "0372222705.jpeg"],
    ["name" => "Lasitha", "address" => "77, Matara, Sri Lanka", "image" => "0372222706.jpg"],
    ["name" => "Dilani", "address" => "88, Batticaloa, Sri Lanka", "image" => "0372222701.jpg"],
    ["name" => "Kavinda", "address" => "99, Kurunegala, Sri Lanka", "image" => "0372222704.jpg"],
    ["name" => "Shanika", "address" => "100, Colombo, Sri Lanka", "image" => "0372222692.jpg"]
];

for ($x = 0; $x < 10; $x++) {
    $shopOwner = $shopOwners[$x]; 
    ?>
    <a href="<?=LINKROOT?>/Admin/shopOwner" class="card btn-card colomn asp-rtio">
        <img class="product-img" src="<?=ROOT?>/images/Profile/<?= $shopOwner['image'] ?>" alt="">
        <div class="details h-50">
            <h4><?= $shopOwner['name'] ?></h4>
            <h4><?= $shopOwner['address'] ?></h4>
        </div>
    </a>
    <?php
}
?>
    </div>

<?php $this->component("footer") ?>