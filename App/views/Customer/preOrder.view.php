<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Pre-Order</h2>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
      </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Order ID</td>
                <td>- <?=$preOrder['pre_order_id']?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td>- <?=explode(" ", $preOrder['date_time'])[0]?></td>
            </tr>
            <tr>
                <td>Time</td>
                <td>- <?=explode(" ", $preOrder['date_time'])[1]?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td id="status">- <?=$preOrder['status']?></td>
            </tr>
        </table>
        <table class="profile">
            <tr>
                <td>Shop Name</td>
                <td>- <a href="<?=LINKROOT?>/Customer/shop/<?=$preOrder['so_phone']?>" class="link"><?=$preOrder['shop_name']?></a></td>
            </tr>
            <tr>
                <td>Shop Owner's Name</td>
                <td>- <?=$preOrder['first_name']?> <?=$preOrder['last_name']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>- <?=$preOrder['so_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>- <?=$preOrder['shop_address']?></td>
            </tr>
        </table>
        <img 
            class="profile-img" 
            src="<?=ROOT?>/images/Shops/<?=$preOrder['so_phone'].$preOrder['shop_pic_format']?>" 
            onerror="this.src='<?=ROOT?>/images/Shops/Default.jpeg'"
            alt=""
        >
    </div>
    <div class="billScroll border-1">
        <table class="bill" id="preOrderItemsTable">
            <thead>
                <tr class="BillHeadings">
                    <th>No.</th>
                    <th class="left-al">Name</th>
                    <th class="right-al">Price</th>
                    <th class="right-al">Quntity</th>
                    <th class="right-al">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($preOrderItems as $i => $item) {
                    echo "<tr class='Item";
                    if($shouldCheckStock && $item['stock']['quantity'] < $item['quantity'])
                        echo " red-text";
                    echo "'>
                            <td class='center-al'>" . ($i + 1) . "</td>
                            <td class='left-al'>" . $item['product_name'] . "</td>
                            <td> Rs." . number_format($item['po_unit_price'], 2) . "</td>
                            <td>" . $item['quantity'] . "</td>
                            <td> Rs." . $item['row_total'] . "</td>
                        </tr>";
                }?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="row fg1 mg-0">
            <h2>Total</h2>
            <h2>Rs.<?=$preOrder['total']?></h2>
        </div>
        <?php if ($preOrder['status'] === 'Updated') {?>
            <h5 id="tip">Unfortunately, the store has run out of some products you pre-ordered after you placed the order. The above is the updated pre-order that the shop can fulfill. Please review it, and if you accept the changes, press the accept button.</h5>
            <button id="acceptBtn" class="btn">Accept the changes</button>
        <?php }
        if (in_array($preOrder['status'], ['Pending', 'Updated'])) {?>
            <button id="cancelBtn" class="btn">Cancel</button>
        <?php } ?>
    </div>
</div>
<div id="notification-container"></div>

<script>
    const ROOT = '<?=ROOT?>';
    const LINKROOT = '<?=LINKROOT?>';
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
    const pre_order_id = '<?=$preOrder['pre_order_id']?>';
    let status = '<?=$preOrder['status']?>';
</script>
<script src="<?=ROOT?>/js/Customer/preOrder.js" type="module"></script>

<?php $this->component("footer") ?>
