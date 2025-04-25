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
        <?php if($loyalty) $this->component('chat', ['user' => $shop['first_name']." ".$shop['last_name'], 'chat' => $chat]) ?>
    </div>
    <div class="row gap-10 ovf-hdn fg1 mg-0">
        <div class="colomn fg1 panel">
            <h2 class="center-al">Available Products</h2>
            <div class="row mg-0">
                <input id="stockSearchBar" type="text" class="fg1 search-bar" placeholder="Search">
                <label class="row alitem-center mg-0" 
                title="Even if there is stock in the store, 
it might already be pre-ordered, 
so you won't be able to place 
a new pre-order for those items. 
The stock level is still shown 
because you can buy them at the shop 
before the pre-orders are processed, 
as in-store customers are prioritized.">
                    <input type="checkbox" id="preOrderable" class="stock-filter">
                    <span>Pre-orderable Products ⓘ</span>
                </label>
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
<?php $this->component("billDetails", ['role' => 'Customer']) ?>
<div id="notification-container"></div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const shopPhone = "<?=$shop['so_phone']?>";
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
<?php if($loyalty) { ?>
    const chatWith = "<?=$shop['so_phone']?>";
<?php } ?>
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Customer/shop.js" type="module"></script>

<?php $this->component("footer") ?>