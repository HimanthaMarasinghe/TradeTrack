<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$man['company_name']?></h2>
        <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Manufacturer</td>
                <td>: <?=$man['first_name']?> <?=$man['last_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>: <?=$man['company_address']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>: <?=$man['phone']?></td>
            </tr>
            <tr>
                <td><h2>My Wallet</h2></td>
                <td><h2>Rs.<?=number_format($wallet['wallet'], 2)?></h2></td>
            <!-- <?php if($wallet['wallet'] > 0) { ?>
                <td><h2>Credit</h2></td>
                <td><h2>Rs.<?=number_format($wallet['wallet'], 2)?></h2></td>
                <?php } else { ?>
                    <td><h2>Debt</h2></td>
                    <td><h2>Rs.<?=number_format(-1*$wallet['wallet'], 2)?></h2></td>
                <?php } ?> -->
            </tr>
            <tr>
                <td><a href="<?=LINKROOT?>/Distributor/newInventryRequest" class="btn w-100">New Inventory Request</a></td>
                <td><button id="pay" class="btn w-100px">Pay</button></td>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/shops/<?=$man['phone']?>.<?=$man['pic_format']?>"
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'" 
        alt="shop image">
    </div>

    <div class="row gap-10 ovf-hdn fg1 mg-0">
        <!-- <div class="colomn fg1 panel">
            <div class="row">
                <h2 class="center-al">History</h2>
                <input type="text" class="search-bar fg1" placeholder="Search Orders" id="search">
                <input type="date" id="order_date" class="filter-js">
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
        </div> -->

        <div class="colomn fg1 panel">
            <div class="row">
                <h2 class="center-al">Payments</h2>
                <input type="text" class="search-bar fg1" placeholder="Search Payment" id="searchPayment">
                <input type="date" id="paymentDate" class="filter-js">
            </div>
            <div class="billScroll">
                <table class="bill">
                    <thead>
                        <tr class="BillHeadings">
                            <th>Payment Id</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="paymentElements">
            
                    </tbody>
                </table>
            </div>
        </div>
</div>

<!-- popup -->

<div id="popUpBackDrop" class="hidden"></div>
<div class="popUpDiv hidden" id="payPopUp">
    <h2>Pay to the Manufacturer</h2>
    
    <form id="payForm" action="<?=LINKROOT?>/Distributor/addManPayment" method = "post">
        <table class="profile">
            <tr>
                <td>Manufacturer Name</td>
                <td><?=$man['first_name']?> <?=$man['last_name']?></td>
            </tr>
            <tr>
                <td>Company Name</td>
                <td><?=$man['company_name']?></td>
            </tr>
            <tr>
                <td>Pay Amount</td>
                <td>
                    <input class="userInput" type="number" name="ammount" min =1 required>
                </td>
            </tr>
        </table>
        <button type="submit" id="payBtn" class="btn w-100px">Pay</button>
    </form>
</div>

    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const ws_id = "<?=$_SESSION['Distributor']['phone']?>"
        const man_phone = "<?=$man['man_phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/manufacturer.js"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>
    <script src='<?=ROOT?>/js/notificationConfig.js' type="module"></script>

<?php $this->component("footer") ?>