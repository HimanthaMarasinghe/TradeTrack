<a href="" class="card btn-card colomn asp-rtio">
        <?php if(file_exists("./images/Products/".$barcode.".".$pic_format)){ ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/<?=$barcode?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
    <div class="details h-50">
        <h4><?=$product_name?></h4>
        <h4><?=$barcode?></h4>
        <h4>Unit price Rs.<?= number_format($unit_price, 2) ?></h4>
        <h4>Bulk price Rs.<?= number_format($bulk_price, 2) ?></h4>
    </div>

</a>