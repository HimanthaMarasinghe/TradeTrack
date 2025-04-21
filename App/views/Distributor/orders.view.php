<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs);
    // Side menu is created here
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="Home Icon">
        <h1>Maliban Galle Distributor</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="Settings Icon">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="Profile Icon">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" id="search" placeholder="Search Order">
                <a class="btn" href="<?=LINKROOT?>/Distributor/orderHistory">
                    <h4>Order History</h4>
                </a>
            </div>
            <div class="scroll-box grid g-resp-300" id="elements">
                

            </div>
        </div>
    </div>

    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const customerId = "<?=$this->data['distributor']['id']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/orders.js"></script>

<?php $this->component("footer") ?>
