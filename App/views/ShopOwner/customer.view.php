<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$customer['first_name']." ".$customer['last_name']?></h2>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile w-100">
            <tr>
                <td>Phone number</td>
                <td><?=$customer['phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$customer['address']?></td>
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
                        <button class="btn fg1" id="revoke_btn">Revoke Loyalty Privilege</button>
                        <button class="btn fg1">Update wallet</button>
                    </div>
                </td>
            </tr>
        <?php }else{ ?>

            <tr>
                <td colspan="2"><h2>Not a Loyalty Customer</h2></td>
            </tr>

        <?php } ?>

        </table>
        <img 
            src="<?=ROOT?>/images/Profile/<?=$customer['phone']?>.<?=$customer['pic_format']?>" 
            class="profile-img big" 
            alt="Customers Profile Photo"
            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'"
        >
        <?php if($loyalty) $this->component('chat', ['user' => $customer['first_name']." ".$customer['last_name'], 'chat' => $chat]) ?>
    </div>
    <div class="row">
        <h2 class="fg1">History</h2>
        <input type="date" id="bill_Date" class="filter-js">
    </div>
    <div class="billScroll" id="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Bill Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="billTbody"></tbody>
        </table>
    </div>
</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<?php $this->component("billDetails", [$role = 'Shop_Owner']) ?>

<div id="notification-container"></div>
<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const loy_phone = "<?=$customer['phone']?>";
    const wallet_amount = "<?=$loyalty['wallet']?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const loyalty = <?=json_encode($loyalty)?>
</script>
<script src="<?=ROOT?>/js/ShopOwner/customer.js" type="module"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>