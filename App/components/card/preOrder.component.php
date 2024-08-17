<!-- <button href="<?=LINKROOT?>/ShopOwner/preOrder" class="card"> -->
<form id="preOrder-form-<?=$name?>" action="<?=LINKROOT?>/ShopOwner/preOrder" style="display:none" method="POST">
    <input type="hidden" name="phone" value="<?=$phone?>">
    <input type="hidden" name="name" value="<?=$name?>">
    <input type="hidden" name="total" value="<?=$total?>">
    <input type="hidden" name="time" value="<?=$time?>">
</form>
<div class="card" >
    <div class="profile-photo">
        <img src="<?=ROOT?>/images/Profile/<?=$phone?>.jpg" alt="J">
    </div>
    <div class="details center-al">
        <h4><?=$name?></h4>
        <h4>Rs. <?=$total?>.00</h4>
        <h4><?=$time?> ago</h4>
        <button class="btn" type="submit" form="preOrder-form-<?=$name?>">Process</button>
    </div>
</div>