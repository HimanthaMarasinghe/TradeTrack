<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Products</h1>
        <div class="row gap-10">
          <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
          <?php $this->component("notification") ?>
          <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
      </div>
    </div>
    <div class="row">
      <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
    </div>

    <div class="grid g-resp-200 scroll-box" id="elements-Scroll-Div">
    </div>
    <div id="notification-container"></div>

  <script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const clickLink = "Customer/product";
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
  </script>
  <script src="<?=ROOT?>/js/loadAllProducts.js" type="module"></script>
  <script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>

<?php $this->component("footer") ?>