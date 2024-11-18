<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Loyalty Customer Request</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Name</td>
                <td><?=$newLoyalCusReq['cus_first_name']?> <?=$newLoyalCusReq['cus_last_name']?></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><?=$newLoyalCusReq['cus_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$newLoyalCusReq['cus_address']?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button onclick="addLoyCustmer('<?=$newLoyalCusReq['cus_phone']?>')" class="btn">Accept Loyalty Customer Request</button>
                </td>
            </tr>
        </table>
        <?php if(file_exists("./images/Profile/CUS/".$newLoyalCusReq['cus_phone'].".".$newLoyalCusReq['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Profile/CUS/<?=$newLoyalCusReq['cus_phone']?>.<?=$newLoyalCusReq['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big"  src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
        <?php } ?>
    </div>
</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
</script>
<script src="<?=ROOT?>/js/addLoyCustomer.js"></script>

<?php $this->component("footer") ?>