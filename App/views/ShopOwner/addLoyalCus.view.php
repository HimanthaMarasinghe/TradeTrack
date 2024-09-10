<?php
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1><?=$newLoyalCusReq['name']?></h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Phone Number</td>
                <td><?=$newLoyalCusReq['phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$newLoyalCusReq['address']?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="" class="btn">Add Loyalty Customer</a>
                </td>
            </tr>
        </table>
        <img class="profile-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    </div>
</div>

<?php $this->component("footer") ?>