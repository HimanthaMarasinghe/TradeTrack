<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
    <a href="<?=LINKROOT?>/Manufacturer/home"><img src="<?=ROOT?>/images/icons/home.svg" alt=""> </a>
        <h1><?=$_SESSION['manufacturer']['company_name']?></h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Manufacturer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/Manufacturer/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Distrubutor</td>
                <td>: <?=$dis['first_name']?> <?=$dis['last_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>: <?=$dis['dis_busines_address']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>: <?=$dis['dis_phone']?></td>
            </tr>
            <!-- <tr>
            <?php if($wallet['wallet'] > 0) { ?>
                <td><h2>Debt</h2></td>
                <td><h2>Rs.<?=number_format($wallet['wallet'], 2)?></h2></td>
                <?php } else { ?>
                    <td><h2>Credit</h2></td>
                    <td><h2>Rs.<?=number_format(-1*$wallet['wallet'], 2)?></h2></td>
                <?php } ?>
            </tr> -->
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/Profile/SA/<?=$dis['phone']?>.<?=$dis['pic_format']?>"
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'" 
        alt="shop image">
    </div>
    <div class="row">
        <h2 class="center-al">Stocks</h2>
        <input type="text" class="search-bar fg1" placeholder="Search products" id="search">
        
    </div>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Product name</th>
                    <th>Bar code</th>
                    <th>Quantity</th>
                    
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
        const ws_id = "<?=$_SESSION['manufacturer']['phone']?>";
        const ws_token = "<?=$_SESSION['web_socket_token']?>";
        const dis_phone = "<?=$dis['phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Manufacture/prof.js"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>
    <script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>

<?php $this->component("footer") ?>