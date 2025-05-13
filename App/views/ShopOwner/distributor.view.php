<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="scroll-box">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h2><?=$distributor['dis_busines_name']?></h2>
            <div class="row gap-10">
                <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
            </div>
        </div>
        <div class="row spc-btwn">
            <table class="profile">
                <tr>
                    <td>Distributor's name</td>
                    <td><?=$distributor['first_name']." ".$distributor['last_name']?></td>
                </tr>
                <tr>
                    <td>Distributor's Phone number</td>
                    <td><?=$distributor['dis_phone']?></td>
                </tr>
                <tr id="creditTR">
                    <td><h2>Wallet</h2></td>
                    <td><h2>Rs.<?=number_format($distributor['wallet'], 2)?></h2></td>
                </tr>
                <tr>
                    <td><a href="<?=LINKROOT?>/ShopOwner/orderStocks/<?=$distributor['dis_phone']?>" class="btn w-100">Place an Order</a></td>
                    <td><button id="pay" class="btn w-100px">Pay</button></td>
                </tr>
            </table>
            <img
                class="profile-img big"
                src="<?=ROOT?>/images/Profile/<?=$distributor['dis_phone']?>.<?=$distributor['pic_format']?>"
                alt=""
                onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'"
            >
        </div>
        <div class="row gap-10 ovf-hdn fg1 mg-10">
            <div class="colomn fg1 panel">
                <div class="mg-0 row col-max-1024">
                    <h2 class="fg1">Order History</h2>
                    <select id="order-state" class="filter-js-order">
                        <option value="all">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Delivering">Delivering</option>
                        <option value="Delivered">Recived</option>
                    </select>
                    <input id="order-date" type="date" class="filter-js-order">
                </div>
                <div class="billScroll h-350" id="billScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th>Order Id</th>
                                <th class='left-al'">Date</th>
                                <th class='left-al'>Time</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="billTable">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="colomn fg1 panel">
                <div class="mg-0 row col-max-1024">
                    <h2 class="fg1">Payment History</h2>
                    <input type="date" id="pay-date" class="filter-js-payment">
                </div>
                <div class="billScroll h-350" id="paymentScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th>Payment Id</th>
                                <th class='left-al'">Date</th>
                                <th class='left-al'>Time</th>
                                <th>Confirmed</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="paymentTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="colomn fg1 panel">
            <h2 class="center-al">Available Products</h2>
            <div class="row mg-0">
                <input id="stockSearchBar" type="text" class="fg1 search-bar" placeholder="Search">
            </div>
            <div class="scroll-box grid g-resp-300 h-400px" id="stockScroll">
            </div>
        </div>
    </div>
</div>

<!-- popup -->

<div id="popUpBackDrop" class="hidden"></div>
<?php $this->component("orderDetails") ?>
<div class="popUpDiv hidden" id="payPopUp">
    <h2>Pay to the Distributor</h2>
    <img
        class="profile-img"
        src="<?=ROOT?>/images/Profile/<?=$distributor['dis_phone']?>.<?=$distributor['pic_format']?>"
        alt=""
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'"
        >
    <form id="payForm">
        <table class="profile">
            <tr>
                <td>Distributor Name</td>
                <td><?=$distributor['first_name']." ".$distributor['last_name']?></td>
            </tr>
            <tr>
                <td>Busines Name</td>
                <td><?=$distributor['dis_busines_name']?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><input type="date" class="userInput" name="date" id="task-date" required></td>
            </tr>
            <tr>
                <td>Pay Amount</td>
                <td>
                    <input class="userInput" type="number" name="amount" min="1" id="payAmount" required>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" id="exp_from_cash_drawer" name="cashDrawer" checked></td>
                <td>
                    <label for="exp_from_cash_drawer">
                        Paied from cash drawer
                    </label>
                </td>
            </tr>
        </table>
        <input type="text" name="dis_phone" class="hidden" value="<?=$distributor['dis_phone']?>" readonly required>
    </form>
    <button type="button" id="payBtn" class="btn w-100px">Pay</button>
</div>
<div id="notification-container"></div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const dis_phone = "<?=$distributor['dis_phone']?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";

    var now = new Date();

    var currentDateTime = now.toISOString().slice(0, 10);
    console.log(currentDateTime);

    document.getElementById("task-date").min = currentDateTime;
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/ShopOwner/distributor.js" type="module"></script>

<?php $this->component("footer") ?>