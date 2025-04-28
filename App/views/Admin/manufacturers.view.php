<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <a href="<?=LINKROOT?>/Admin/home">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </a>
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All Manufacturers</h1>
        <div style="opacity: 0;">
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
    </div>

    <div class="grid g-resp-200 scroll-box" id="elements-Scroll-Div">
    </div>

    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
    </script>
    <script src="<?=ROOT?>/js/Admin/manufacturers.js" type="module"></script>

<?php $this->component("footer") ?>