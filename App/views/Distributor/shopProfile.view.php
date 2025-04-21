<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$shop['shop_name']?></h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop Owner</td>
                <td>: <?=$shop['first_name']?> <?=$shop['last_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>: <?=$shop['address']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>: <?=$shop['phone']?></td>
            </tr>
            <tr>
            <?php if($wallet['wallet'] > 0) { ?>
                <td><h2>Debt</h2></td>
                <td><h2>Rs.<?=number_format($wallet['wallet'], 2)?></h2></td>
                <?php } else { ?>
                    <td><h2>Credit</h2></td>
                    <td><h2>Rs.<?=number_format(-1*$wallet['wallet'], 2)?></h2></td>
                <?php } ?>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/shops/<?=$shop['so_phone']?><?=$shop['shop_pic_format']?>"
        onerror="this.src='<?=ROOT?>/images/shops/Default.jpeg'" 
        alt="shop image">
    </div>
    <div class="row">
        <h2 class="center-al">History</h2>
        <input type="text" class="search-bar fg1" placeholder="Search Orders" id="search">
        <input type="date" class="filter-js" id="date">
    </div>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Order Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="elements">
    
            </tbody>
        </table>
    </div>
</div>

<!-- popup -->
<!-- 
<div id="popUpBackDrop" class=""></div>
<div id="OrderDetails" class="popUpDiv">
    <h1>Order details</h1>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <p>Order Id</p>
            <p>Date</p>
            <p>Time</p>
            <p>Shop Name</p>
            <p>Shop Owner</p>
            <p>Contact Number</p>
            <p>Order Status</p>
        </div>
        <div class="colomn fg1">
            <p id="More-details-Order-id"></p>
            <p id="More-details-Order-date"></p>
            <p id="More-details-Order-time"></p>
            <p id="More-details-Order-shopname"></p>
            <p id="More-details-Order-ownername"></p>
            <p id="More-details-Order-phone"></p>
            <p id="More-details-Order-status"></p>
        </div>
    </div>
    <div class="billScroll">
        <table class="bill min-w-1200">
            <thead>
                <tr class="BillHeadings">
                    <th class="center-al">Barcode</th>
                    <th class="left-al">Product Name</th>
                    <th class="left-al">Quantity</th>
                    <th>Sold Bulk Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="OrderDetailsItems">
            </tbody>
        </table>
        <h1 class="right-al" id="More-details-Order-total"></h1>
    </div>
</div> -->

<script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const so_phone = "<?=$shop['so_phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/shopProfile.js"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>