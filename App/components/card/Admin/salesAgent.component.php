<a href="<?=LINKROOT?>/Supplier/Agent/<?=$sa_phone?>" class="card btn-card colomn asp-rtio">
    <?php if(file_exists("./images/Profile/SA/".$sa_phone.".".$sa_pic_format)){ ?>
        <img class="product-img" src="<?=ROOT?>/images/Profile/SA/<?=$sa_phone?>.<?=$sa_pic_format?>" alt="">
        <!-- <img src="<?=ROOT?>/images/Profile/<?=$cus_phone?>.jpg" alt=""> -->
    <?php }else{ ?>
        <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    <?php } ?>
    <div class="details h-50 ovf-hdn">
        <h4><?=$sa_first_name?></h4>
        <h4><?=$sa_last_name?></h4>
        <h4><?=$sa_busines_name?></h4>
        <h4><?=$sa_phone?></h4>
    </div>
</a>