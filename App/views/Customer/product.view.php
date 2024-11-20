<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Product Details</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
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
        <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
            <img class="profile-img" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
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

<?php $this->component("footer") ?>