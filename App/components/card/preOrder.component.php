<a class="card btn-card center-al alitem-center <?=$status?>-preOrder" href="<?=LINKROOT?>/ShopOwner/preOrder/<?=$pre_order_id?>">
    <div class="profile-photo">
        <img 
            src="<?=ROOT?>/images/Profile/<?=$cus_phone?>.<?=$pic_format?>" 
            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'"
            alt="J"
        >
    </div>
    <div class="details center-al">
        <h3>Order Id <?=$pre_order_id?></h3>
        <h4><?=$first_name?> <?=$last_name?></h4>
        <h4>Rs.<?=$total?></h4>
        <h4><?=$date_time?></h4>
        <h4 class="status"><?=$status?></h4>
    </div>
</a>