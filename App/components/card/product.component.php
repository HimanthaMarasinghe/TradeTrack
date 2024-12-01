<a href="<?php if($baseUrl) {echo LINKROOT."/".$baseUrl."/".$barcode;} else echo "#" ?>" class="card btn-card center-al <?php if($special) echo 'card-js'; else if($quantity < $low_stock_level) echo 'low';?>" id="<?=$barcode?>">
<!-- <a href="<?=LINKROOT?>/<?=$baseUrl?>/<?=$barcode?>" class="card btn-card center-al <?php if($quantity < 100){?> low <?php } ?>"></a> -->
    <div class="details h-100">
        <h4><?=$product_name?></h4>


        <?php if($special) {?>
            <h4 class="orange-text"><?=$special?></h4>
        <?php } else { ?>
            <h4 class="quanity"><?=$quantity?> Units in stock</h4>
        <?php } ?>




        <h4>Rs.<?= number_format($unit_price, 2)?></h4>
    </div>
    <div class="product-img-container">
        <?php if(file_exists("./images/Products/".$barcode.".".$pic_format)){ ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/<?=$barcode?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
    </div>
</a>