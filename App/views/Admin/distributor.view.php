<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Distributor details</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Distributor name</td>
                <td><?=$distributor['first_name']?> <?=$distributor['last_name']?></td>
            </tr>
            <tr>
                <td>Business name</td>
                <td><?=$distributor['dis_busines_name']?></td>
            </tr>
            <tr>
                <td>Business address</td>
                <td><?=$distributor['dis_busines_address']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$distributor['dis_phone']?></td>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/Profile/<?=$distributor['dis_phone']?>.<?=$distributor['pic_format']?>" 
        alt=""
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
    </div>
    <h3>Distributing shops</h3>
    <div class="grid g-resp-200 scroll-box">
    <?php for($x = 0; $x <4; $x++){?>
        <a href="" class="card btn-card colomn asp-rtio">
                <img class="product-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
                <div class="details h-50">
                    <h4>vijewrdana stores</h4>
                    <h4>Maliban power milk</h4>
                    <h4>2300</h4>
                </div>
        </a>
    <?php } ?>
    </div>
</div>

<?php $this->component("footer") ?>