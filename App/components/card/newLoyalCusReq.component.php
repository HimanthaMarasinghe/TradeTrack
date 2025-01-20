<a href="<?=LINKROOT?>/ShopOwner/loyaltyCustomerRequest/<?=$cus_phone?>" class="card gap-10">
    <div class="profile-photo">

        <?php if(file_exists("./images/Profile/CUS/".$cus_phone.".".$pic_format)){ ?>
            <img src="<?=ROOT?>/images/Profile/CUS/<?=$cus_phone?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
        <?php } ?>

    </div>
    <div class="m-b-auto fg1">
        <h3><?=$first_name?> <?=$last_name?></h3>
        <h4><?=$cus_phone?></h4>
        <br>
        <h6>Request Created Time -</h6>
        <h5><?=$created_time?></h5>
    </div>
</a>