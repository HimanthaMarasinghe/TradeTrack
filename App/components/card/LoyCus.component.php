<div class="card btn-card center-al" onclick="document.getElementById('LoyCus-<?=$phone?>').submit()">
    <form id="LoyCus-<?=$phone?>" method="post" action="<?=LINKROOT?>/ShopOwner/loyaltyCustomer">
        <input type="hidden" name="phone" value="<?=$phone?>">
    </form>
    <div class="profile-photo">
        <img src="<?=ROOT?>/images/Profile/<?=$phone?>.jpg" alt="J">
    </div>
    <div class="LoyCus-Details fg1">
        <h2 class="center-al"><?=$name?></h2>
        <h2>Rs.<?=$amount?></h2>
        <!-- <div class="m-b-auto">
            <button class="btn" type="submit" form="LoyCus-<?=$phone?>">See more</button>
        </div> -->
    </div>
</div>