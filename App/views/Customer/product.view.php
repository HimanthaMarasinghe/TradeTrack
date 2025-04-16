<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Product Details</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Product Name</td>
                <td><?=$product['product_name']?></td>
            </tr>
            <tr>
                <td>Barcode</td>
                <td><?=$product['barcode']?></td>
            </tr>
            <tr>
                <td>Unit Price</td>
                <td>Rs.<?= number_format($product['unit_price'], 2) ?></td>
            </tr>
        </table>

        <img src="<?=ROOT?>/images/Products/<?=$product['picture']?>" 
        onerror="this.src='<?=ROOT?>/images/Products/default.jpeg'"
        alt="Product Image" 
        class="profile-img big">
    </div>
    <h2>Shops where you can buy this product</h2>
    <div class="grid g-resp-200 scroll-box">
      <?php
        foreach ($shops as $shop)
        {
          $this->component('card/Customer/shop', $shop); 
        }
      ?>
    </div>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
</script>
<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>

<?php $this->component("footer") ?>