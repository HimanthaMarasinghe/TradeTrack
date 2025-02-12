<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Loyalty Customer Request</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Name </td>
                <td>- <?=$newLoyalCusReq['first_name']?> <?=$newLoyalCusReq['last_name']?></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>- <?=$newLoyalCusReq['phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>- <?=$newLoyalCusReq['address']?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button id="accept_lcr_btn" class="btn">Accept Loyalty Customer Request</button>
                </td>
            </tr>
        </table>
        <?php if(file_exists("./images/Profile/CUS/".$newLoyalCusReq['phone'].".".$newLoyalCusReq['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Profile/CUS/<?=$newLoyalCusReq['cus_phone']?>.<?=$newLoyalCusReq['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big"  src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
        <?php } ?>
    </div>
</div>
<div id="notification-container"></div>
<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const cus_phone = "<?=$newLoyalCusReq['phone']?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>
<script src="<?=ROOT?>/js/addLoyCustomer.js" type="module"></script>

<?php $this->component("footer") ?>