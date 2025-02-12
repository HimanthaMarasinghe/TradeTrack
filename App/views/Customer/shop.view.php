<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$shop['shop_name']?></h2>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop owner's name</td>
                <td><?=$shop['first_name']." ".$shop['last_name']?></td>
            </tr>
            <tr>
                <td>Shop owner's Phone number</td>
                <td><?=$shop['so_phone']?></td>
            </tr>
            <tr>
                <td>Shop Address</td>
                <td><?=$shop['shop_address']?></td>
            </tr>

        <?php if($loyalty){ ?>
            <tr>
                <td><h2>Wallet</h2></td>
                <td><h2>Rs.<?=number_format($loyalty['wallet'], 2)?></h2></td>
            </tr>
            <tr>
                <td colspan="2">Loyalty customer since <?=$loyalty['since']?></td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="row max-w-900">
                        <button class="btn fg1">Reject Loyalty Privilege</button>
                        <a class="btn fg1" href="<?=LINKROOT?>/Customer/placePreOrder/<?=$shop['so_phone']?>">Make A Pre-Order</a>
                    </div>
                </td>
            </tr>
        <?php }else if($loyaltyReq){ ?>

            <tr>
                <td colspan="2">Your request is pending. Request created on <?=$loyaltyReq['created_time']?></td>
            </tr>
        <?php }else{ ?>

            <tr>
                <td colspan="2"><h2>You are not a Loyalty Customer</h2></td>
            </tr>

            <tr>
                <td>
                    <div class="row max-w-900">
                        <button id="reqLoyalty" class="btn fg1">Request to be a Loyalty Customer</button>
                    </div>
                </td>
            </tr>

        <?php } ?>

        </table>
        <img
            class="profile-img big"
            src="<?=ROOT?>/images/shops/<?=$shop['so_phone'].$shop['shop_pic_format']?>"
            alt=""
            onerror="this.src='<?=ROOT?>/images/shops/default.jpeg'"
        >
    </div>
    <div class="row gap-10 ovf-hdn fg1">
        <div class="colomn fg1 panel">
            <h2 class="center-al">Available Products</h2>
            <input id="stockSearchBar" type="text" class="search-bar" placeholder="Search">
            <div class="scroll-box grid g-resp-300" id="stockScroll">
            </div>
        </div>
        <div class="colomn fg1 panel">
            <h2 class="center-al">History</h2>
            <div class="billScroll" id="billScroll">
                <table class="bill">
                    <thead>
                        <tr class="BillHeadings">
                            <th>Bill Id</th>
                            <th class='left-al'">Date</th>
                            <th class='left-al'>Time</th>
                            <th>Amount</th>
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
<div id="BillDetails" class="popUpDiv hidden">
<h1>Bill details</h1>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <p>Bill Id</p>
            <p>Date</p>
            <p>Time</p>
            <p>Shop Name</p>
        </div>
        <div class="colomn fg1">
            <p id="More-details-bill-id"></p>
            <p id="More-details-bill-date"></p>
            <p id="More-details-bill-time"></p>
            <p> - <?=$shop['shop_name']?></p>
        </div>
        <img
            class="profile-img"
            src="<?=ROOT?>/images/shops/<?=$shop['so_phone'].$shop['shop_pic_format']?>"
            alt=""
            onerror="this.src='<?=ROOT?>/images/shops/default.jpeg'"
        >
    </div>
    <div class="billScroll">
        <table class="bill min-w-1200">
            <thead>
                <tr class="BillHeadings">
                    <th class='center-al'>Barcode</th>
                    <th class='left-al'>Product Name</th>
                    <th class='left-al'>Quantity</th>
                    <th class='left-al'>Unit Price</th>
                    <th class="left-al">Total</th>
                </tr>
            </thead>
            <tbody id="billDetailsItems">
            </tbody>
        </table>
        <h1 class="right-al" id="More-details-bill-total"></h1>
    </div>
</div>
<div id="notification-container"></div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const shopPhone = "<?=$shop['so_phone']?>";
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Customer/shop.js" type="module"></script>

<?php $this->component("footer") ?>