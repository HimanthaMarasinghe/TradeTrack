<a href="<?=LINKROOT?>/Customer/product/<?=$barcode?>" class="card btn-card colomn asp-rtio">
        <?php if(file_exists("./images/Products/".$barcode.".".$pic_format)){ ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/<?=$barcode?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
    <div class="details h-50">
        <h4><?=$product_name?></h4>
        <h4>Rs.<?= number_format($unit_price, 2) ?></h4>
    </div>
</a>