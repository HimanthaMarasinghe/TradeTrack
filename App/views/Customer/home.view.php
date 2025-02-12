<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content">

  <div class="bar">
    <img src="<?=ROOT?>/images/icons/home.svg" alt="">
    <h1><?=$_SESSION['customer']['first_name']?> <?=$_SESSION['customer']['last_name']?></h1>
    <div class="row gap-10">
      <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
      <?php $this->component("notification") ?>
      <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
    </div>
  </div>

  <div class="slideshow-container">

    <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <img src="<?=ROOT?>/images/AdBanners/1.jpg" style="width:100%">
      <div class="text">Caption Text</div>
    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <img src="<?=ROOT?>/images/AdBanners/2.jpg" style="width:100%">
      <div class="text">Caption Two</div>
    </div>

    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <img src="<?=ROOT?>/images/AdBanners/3.jpg" style="width:100%">
      <div class="text">Caption Three</div>
    </div>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>

  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>
<script src="<?=ROOT?>/js/Customer/home.js" type="module"></script>

<?php 
    unset($_SESSION['web_socket_token']);
    $this->component("footer") 
?>