<a href="<?=LINKROOT?>/ShopOwner/Distributor/<?=$dis_phone?>" class="card btn-card colomn asp-rtio">
    <?php if(file_exists("./images/Profile/".$dis_phone.".".$pic_format)){ ?>
        <img class="product-img" src="<?=ROOT?>/images/Profile/<?=$dis_phone?>.<?=$pic_format?>" alt="">
    <?php }else{ ?>
        <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    <?php } ?>
    <div class="details h-50 ovf-hdn">
        <h4><?=$first_name?></h4>
        <h4><?=$last_name?></h4>
        <h4><?=$dis_busines_name?></h4>
        <h4><?=$dis_phone?></h4>
    </div>
</a>