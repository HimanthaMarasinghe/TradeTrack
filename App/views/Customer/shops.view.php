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
    <input type="text" class="search-bar fg1" id="searchBar" placeholder="Search">
    <button class="btn">Search</button>
  </div>

  <div class="grid g-resp-200 scroll-box" id="elements-Scroll-Div">
    <!-- <?php
      foreach ($shops as $shop)
      {
        $this->component('card/Customer/shop', $shop); 
      }
    ?> -->
  </div>

<script>
  const LINKROOT = '<?=LINKROOT?>';
  const ROOT = '<?=ROOT?>';
</script>
<script src="<?=ROOT?>/js/Customer/shops.js"></script>
<script src="<?=ROOT?>/js/apiFetcher.js"></script>

<?php $this->component("footer") ?>