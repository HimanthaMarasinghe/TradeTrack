<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Product</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search">
      <button class="btn">Search</button>
    </div>

    <div class="grid g-resp-200 scroll-box">
      <?php
        foreach ($products as $product)
        {
          $this->component('card/productVert', $product); 
        }
      ?>
    </div>

<?php $this->component("footer") ?>