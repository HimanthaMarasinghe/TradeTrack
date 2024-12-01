<a href="<?=LINKROOT?>/Customer/shop/<?=$so_phone?>" class="card btn-card colomn asp-rtio">
    <?php if(file_exists("./images/shops/".$so_phone.$shop_pic_format)){ ?>
        <img class="product-img" src="<?=ROOT?>/images/shops/<?=$so_phone.$shop_pic_format?>" alt="">
    <?php }else{ ?>
        <img class="product-img" src="<?=ROOT?>/images/shops/default.jpeg" alt="">
    <?php } ?>
    <div class="details h-50">
        <h4><?=$shop_name?></h4>
        <h4><?=$shop_address?></h4>
    </div>
</a>