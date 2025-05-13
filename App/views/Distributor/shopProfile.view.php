<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$shop['shop_name']?></h2>
        <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
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
                <td><h2>Wallet</h2></td>
                <td><h2>Rs.<?=number_format($wallet['wallet'], 2)?></h2></td>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/shops/<?=$shop['so_phone']?><?=$shop['shop_pic_format']?>"
        onerror="this.src='<?=ROOT?>/images/shops/Default.jpeg'" 
        alt="shop image">
        <?php $this->component('chat', ['user' => $shop['first_name']." ".$shop['last_name'], 'chat' => $chat]) ?>
    </div>

    <div class="row gap-10 ovf-hdn fg1 mg-0">
        <div class="colomn fg1 panel">
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
        </div>

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

<!-- Payment Confirm PopUP Modal -->
    <div id="popUpBackDrop" class="hidden"></div>
    <div id="confirmPaymentPopUp" class="popUpDiv hidden">
        <h2>Payment Datails</h2>
        <table class = "profile">
            <tr>
                <td><strong>Payment ID</strong></td>
                <td>: <span id="confirmPaymentId"></span></td>
            </tr>
            <tr>
                <td><strong>Date</strong></td>
                <td>: <span id="confirmPaymentDate"></span></td>
            </tr>
            <tr>
                <td><strong>Time</strong></td>
                <td>: <span id="confirmPaymentTime"></span></td>
            </tr>
            <tr>
                <td><strong>Ammount</strong></td>
                <td>: <span id="confirmPaymentAmmount"></span></td>
            </tr>
            <tr>
                <td><strong>Payment Status</strong></td>
                <td>: <span id="confirmPaymentStatus"></span></td>
            </tr>
        </table>
        
        <form 
            method="post" 
            class="colomn mg-10 gap-10" 
            id = "confirmPaymentForm">

            <input type="text" name='status' value="0" class="hidden">
            <button type = "submit" class="btn" id="confirmPaymentBtn">Confirm Payment</button>
        </form>
        
    </div>


    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const ws_id = "<?=$_SESSION['Distributor']['phone']?>"
        const so_phone = "<?=$shop['so_phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/shopProfile.js"></script>
    <script src="<?=ROOT?>/js/popUp.js"></script>
    <script src='<?=ROOT?>/js/notificationConfig.js' type="module"></script>

<?php $this->component("footer") ?>