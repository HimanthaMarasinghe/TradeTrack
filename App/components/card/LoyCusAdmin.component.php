<form id="LoyCus-<?=$phone?>" method="post" action="<?=LINKROOT?>/Admin/removeUserDetails">
    <input type="hidden" name="phone" value="<?=$phone?>">
</form>

<div class="card center-al">
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
            <button class="btn btn-danger" type="button" onclick="deleteProfile('<?=$phone?>')">Delete Profile</button>
        </div>
    </div>
</div>