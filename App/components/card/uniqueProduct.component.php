<a href="<?=LINKROOT?>/ShopOwner/Product/x<?=$barcode?>" class="card btn-card center-al <?php if($special) echo 'card-js'; else if($quantity < $low_stock_level) echo 'low';?>" id="<?=$barcode?>">
    <div class="details h-100">
        <h4><?=$product_name?></h4>


        <?php if($special) {?>
            <h4 class="orange-text"><?=$special?></h4>
        <?php } else { ?>
            <h4 class="quantity"><?=$quantity > 0 ? $quantity : 'No'?> <?=$unit_type?> in stock</h4>
        <?php } ?>




        <h4>Rs.<?= number_format($unit_price, 2)?></h4>
    </div>
    <div class="product-img-container">
        <?php if(file_exists("./images/Products/".$_SESSION['shop_owner']['phone'].$barcode.".".$pic_format)){ ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/<?=$barcode?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img class="product-img" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>
    </div>
</a>