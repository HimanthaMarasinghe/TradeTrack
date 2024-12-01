<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Orders</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <h2>New Orders</h2>
            <div class="scroll-box grid g-resp-300">
                <?php for($x = 0; $x < 10; $x++) { ?>
            <a href="<?=LINKROOT?>/Supplier/new/orderdetails" class="card btn-card center-al">
                <div class="profile-photo">
                    <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="J">
                </div>
                <div class="details center-al">
                    <h4>Name</h4>
                    <h4>Rs.200</h4>
                    <h4>1 hour ago</h4>
                </div>
            </a> <?php } ?>
            </div>  
        </div>

        <div class="panel mg-10 fg1">
        <h2>Orders in process</h2>
            <div class="scroll-box grid g-resp-300">
            <?php for($x = 0; $x < 10; $x++) { ?>
            <a href="<?=LINKROOT?>/Supplier/new/orderdetails" class="card btn-card center-al">
                <div class="profile-photo">
                    <img src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="J">
                </div>
                <div class="details center-al">
                    <h4>Name</h4>
                    <h4>Rs.200</h4>
                    <h4>1 hour ago</h4>
                </div>
            </a> <?php } ?>
            </div>
        </div>
    </div>

</div>

<?php $this->component("footer") ?>