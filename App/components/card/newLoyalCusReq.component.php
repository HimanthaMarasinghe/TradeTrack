<div class="card center-al">
    <div class="profile-photo">


        <?php if(file_exists("./images/Profile/CUS/".$cus_phone.".".$pic_format)){ ?>
            <img src="<?=ROOT?>/images/Profile/CUS/<?=$cus_phone?>.<?=$pic_format?>" alt="">
        <?php } else { ?>
            <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
        <?php } ?>


        <!-- <img src="<?=ROOT?>/images/Profile/<?=$cus_phone?>.<?=$pic_format?>"> -->
    </div>
    <div class="m-b-auto fg1 center-al">
        <h4><?=$cus_first_name?> <?=$cus_last_name?></h4>
    </div>
    <div class="row m-b-auto fg1">
        <a href="" class="btn fg1">Accept</a>
        <a href="<?=LINKROOT?>/ShopOwner/addLoyalCus" class="btn fg1">More</a>
    </div>
</div>