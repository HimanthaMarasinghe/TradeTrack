<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Manufacturer details</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Company name</td>
                <td><?=$manufacturer['company_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$manufacturer['company_address']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$manufacturer['man_phone']?></td>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/Profile/<?=$manufacturer['man_phone']?>.<?=$manufacturer['pic_format']?>" 
        alt=""
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
    </div>
    <h3>Sales agents</h3>
    <div class="grid g-resp-200 scroll-box">
    <?php for($x = 0; $x <4; $x++){?>
        <a href="" class="card btn-card colomn asp-rtio">
                <img class="product-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
                <div class="details h-50">
                    <h4>Chenuka</h4>
                    <h4>wijevardana stores</h4>
                    <h4>0771488164</h4>
                </div>
        </a>
    <?php } ?>
</div>
<?php $this->component("footer") ?>