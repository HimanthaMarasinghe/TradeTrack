<a class="card btn-card center-al" href="<?=LINKROOT?>/ShopOwner/customer/<?=$cus_phone?>">
    <div class="profile-photo">
        <?php if(file_exists("./images/Profile/".$cus_phone.".jpg")){ ?>
            <img src="<?=ROOT?>/images/Profile/<?=$cus_phone?>.jpg" alt="">
        <?php }else{ ?>
            <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
        <?php } ?>
    </div>
    <div class="LoyCus-Details fg1">
        <h2 class="center-al"><?=$cus_first_name." ".$cus_last_name?></h2>
        <h2>Rs.<?=number_format($wallet, 2)?></h2>
    </div>
</a>