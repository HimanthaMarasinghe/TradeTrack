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
            <tr>
            <td><h2>Wallet </h2></td>
            <td><h2>:Rs.<?=number_format($wallet['wallet'], 2)?></h2></td>
            </tr>
            <tr>
                <td>
                
        <button id="deleteDistributorBtn" class="btn">delete</button> <br>
        
                </td>
            </tr>
                
        </table>

        

        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/Profile/SA/<?=$dis['phone']?>.<?=$dis['pic_format']?>"
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'" 
        alt="shop image">
    </div>
    <div class="row gap-10 ovf-hdn fg1 mg-0">
    <div class="colomn fg1 panel">
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

        <div class="colomn fg1 panel">
            <div class="row">
                <h2 class="center-al">Payments</h2>
                <input type="text" class="search-bar fg1" placeholder="Search Payment" id="searchPayment">
                <!-- <input type="date" id="paymentDate" class="filter-js"> -->
            </div>
            <div class="billScroll">
                <table class="bill">
                    <thead>
                        <tr class="BillHeadings">
                            <th>Payment Id</th>
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

    <script src="<?=ROOT?>/js/popUp.js"></script>

    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const ws_id = "<?=$_SESSION['manufacturer']['phone']?>";
        const ws_token = "<?=$_SESSION['web_socket_token']?>";
        const dis_phone = "<?=$dis['phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Manufacture/prof.js"></script>
    <script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>

<?php $this->component("footer") ?>