<a href="<?php if($url) echo LINKROOT.'/Manufacturer/'.$url; else echo '#';?>" id="<?=$order_id?>" class="card btn-card center-al">
    <div class="profile-photo">
        <!-- <img src="<?=ROOT?>/images/Profile/<?=$dis_phone?>.jpg" alt="J"> -->
        <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="J">
    </div>
    <div class="details center-al">
        <h4><?=$dis_busines_name?></h4>
        <h4>Rs. <?= number_format($total, 2) ?></h4>
        <h4><?=$timeAgo?> ago</h4>
    </div>
</a>