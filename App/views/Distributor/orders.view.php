<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs);
    // Side menu is created here
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="Home Icon">
        <h1><?= $_SESSION['distributor']['dis_busines_name']?></h1>
        <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" id="search" placeholder="Search Order">
                <select id="Filter" class="filter-js">
                    <option value="">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Delivering">Delivering</option>
                    <option value="Delivered">Delivered</option>
                </select>
                <input type="date" id="order_date" class="filter-js">
                </a>
            </div>
            <div class="scroll-box grid g-resp-300" id="elements">
                

            </div>
        </div>
    </div>

    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const ws_id = "<?=$_SESSION['Distributor']['phone']?>";
        const customerId = "<?=$this->data['distributor']['id']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/orders.js"></script>

<?php $this->component("footer") ?>
