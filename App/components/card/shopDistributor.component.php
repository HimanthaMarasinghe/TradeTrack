<!-- <a href="<?=LINKROOT?>/Manufacturer/Agent/<?=$dis_phone?>" class="card btn-card colomn asp-rtio"> -->
<a href="<?=LINKROOT?>/ShopOwner/orderStocks" class="card btn-card colomn asp-rtio">
    <?php if(file_exists("./images/Profile/SA/".$dis_phone.".".$sa_pic_format)){ ?>
        <img class="product-img" src="<?=ROOT?>/images/Profile/SA/<?=$dis_phone?>.<?=$sa_pic_format?>" alt="">
    <?php }else{ ?>
        <img class="product-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    <?php } ?>
    <div class="details h-50 ovf-hdn">
        <h4><?=$first_name?></h4>
        <h4><?=$last_name?></h4>
        <h4><?=$sa_busines_name?></h4>
        <h4><?=$dis_phone?></h4>
    </div>
</a>