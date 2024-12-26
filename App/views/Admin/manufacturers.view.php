<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All Manufacturers</h1>
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
    <?php for($x = 0; $x <20; $x++){ ?>
        <a href="<?=LINKROOT?>/Admin/manufacturer" class="card btn-card colomn asp-rtio">
            <img class="product-img" src="<?=ROOT?>/images/Profile/SA/0123456789.jpg" alt="">
            <div class="details h-50">
                <h4>Maliban</h4>
                <h4>111, colombo, srilanka</h4>
            </div>
        </a>
    <?php }?>
    </div>

<?php $this->component("footer") ?>