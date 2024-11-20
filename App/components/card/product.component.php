<a href="<?=LINKROOT?>/ShopOwner/product/<?=$barcode?>" class="card btn-card center-al <?php if($quantity < 100){?> low <?php } ?>">
    <div class="details h-100">
        <h4><?=$product_name?></h4>
        <h4><?=$quantity?></h4>
        <h4>Rs.<?= number_format($unit_price, 2) ?></h4>
    </div>
    <div class="product-img-container">
        <?php if(file_exists("./images/Products/".$barcode.".".$pic_format)){ ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/<?=$barcode?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
    </div>
</a>