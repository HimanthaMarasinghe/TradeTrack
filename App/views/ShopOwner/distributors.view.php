<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Distributors</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search Distributor" id="searchBar">
    </div>

    <div class="grid g-resp-200 scroll-box" id="elements-Scroll-Div">
    </div>

</div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/distributors.js"></script>
<script src="<?=ROOT?>/js/apiFetcher.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>


<?php $this->component("footer") ?>