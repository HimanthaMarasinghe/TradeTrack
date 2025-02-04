<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

  <div class="bar">
    <img src="<?=ROOT?>/images/icons/home.svg" alt="">
    <h1>Shops</h1>
    <div>
      <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
      <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
    </div>
  </div>
  <div class="row">
    <input type="text" class="search-bar fg1" id="searchBar" placeholder="Search">
    <label class="row alitem-center">
      <input type="checkbox" id="loyalty" class="filter-js">
      <span>Loyalty shops only</span>
    </label>
  </div>

  <div class="grid g-resp-200 scroll-box" id="elements-Scroll-Div">
  </div>

<script>
  const LINKROOT = '<?=LINKROOT?>';
  const ROOT = '<?=ROOT?>';
</script>
<script src="<?=ROOT?>/js/Customer/shops.js" type="module"></script>

<?php $this->component("footer") ?>