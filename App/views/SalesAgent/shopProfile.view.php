<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Shop Name</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop Name</td>
                <td>ABC Traders</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>12,Galle Road,Colombo</td>
            </tr>
            <tr>
                <td>Tp No</td>
                <td>0771234567</td>
            </tr>
        </table>
        <img class="profile-img big" src="<?=ROOT?>/images/Shops/default.jpeg" alt="">
    </div>
</div>

<?php $this->component("footer") ?>