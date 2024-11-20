<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Shop Owner details</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop owner name</td>
                <td>Chenuka</td>
            </tr>
            <tr>
                <td>Shop name</td>
                <td>Maliban</td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>0771488164</td>
            </tr>
        </table>
        <img class="profile-img big" src="<?=ROOT?>/images/Profile/0987654321.jpg" alt="">
    </div>
</div>

<?php $this->component("footer") ?><?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<?php $this->component("footer") ?>