<form id="LoyCus-<?=$phone?>" method="post" action="<?=LINKROOT?>/ShopOwner/loyaltyCustomer">
    <input type="hidden" name="phone" value="<?=$phone?>">
</form>

<div class="card">
    <div class="profile-photo">
        <img src="<?=ROOT?>/images/Profile/<?=$phone?>.jpg" alt="J">
    </div>
    <div class="LoyCus-Details">
        <div class="m-b-auto">
            <h2><?=$name?></h2>
        </div>
        <div class="m-b-auto">
            <h2>Rs.<?=$amount?></h2>
        </div>
        <div class="m-b-auto">
            <button class="btn" type="submit" form="LoyCus-<?=$phone?>">See more</button>
        </div>
    </div>
</div>