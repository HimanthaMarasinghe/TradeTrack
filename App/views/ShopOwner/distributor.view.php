<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
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
            <?php if($distributor['wallet'] > 0) { ?>
                <td><h2>Credit</h2></td>
                <td><h2>Rs.<?=number_format($distributor['wallet'], 2)?></h2></td>
                <?php } else { ?>
                    <td><h2>Debt</h2></td>
                    <td><h2>Rs.<?=number_format(-1*$distributor['wallet'], 2)?></h2></td>
                <?php } ?>
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
    <div class="row gap-10 ovf-hdn fg1 mg-0">
        <div class="colomn fg1 panel">
            <h2 class="center-al">Available Products</h2>
            <div class="row mg-0">
                <input id="stockSearchBar" type="text" class="fg1 search-bar" placeholder="Search">
            </div>
            <div class="scroll-box grid g-resp-300" id="stockScroll">
            </div>
        </div>
        <div class="colomn fg1 panel">
            <h2 class="center-al">History</h2>
            <div class="billScroll" id="billScroll">
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
                <td>Pay Amount</td>
                <td>
                    <input class="userInput" type="number" name="amount" required>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" id="exp_from_cash_drawer" name="cashDrawer" checked></td>
                <td>
                    <label for="exp_from_cash_drawer">
                        Payed from cash drawer
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
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/ShopOwner/distributor.js" type="module"></script>

<?php $this->component("footer") ?>