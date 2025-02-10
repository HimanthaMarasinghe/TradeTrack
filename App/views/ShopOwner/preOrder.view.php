<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Pre-Order</h2>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
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
                <td>- <?=$preOrder['date_time']?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td id="status">- <?=$preOrder['status']?></td>
            </tr>
        </table>
        <table class="profile">
            <tr>
                <td>Customer Name</td>
                <td>- <?=$preOrder['first_name']?> <?=$preOrder['last_name']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>- <?=$preOrder['cus_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>- <?=$preOrder['address']?></td>
            </tr>
        </table>
        <img 
            class="profile-img" 
            src="<?=ROOT?>/images/Profile/<?=$preOrder['cus_phone']?>.<?=$preOrder['pic_format']?>" 
            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'"
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
                    <?php
                        if($shouldCheckStock)
                            echo "<th class='right-al'>In Stock</th>"
                    ?>
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
                            <td>" . $item['quantity'] . "</td>";

                    if($shouldCheckStock)
                        echo "<td>".$item['stock']['quantity']."</td>";

                    echo "
                            <td> Rs." . $item['row_total'] . "</td>
                            <td><input id=". $item['barcode'] ." class='hidden' type='checkbox'></td>
                        </tr>";
                }
            ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="row fg1 mg-0">
            <h2>Total</h2>
            <h2>Rs.<?=$preOrder['total']?></h2>
        </div>
        <h5 id="tip" class=""></h5>
        <a id="rejectBtn" href="#" class="btn">Reject the Order</a>
        <a id="updateBtn" href="#" class="btn hidden">Update</a>
        <a id="changeStatusBtn" href="#" class="btn">Start Processing</a>
    </div>
</div>
<div id="notification-container"></div>

<script>
    const ROOT = '<?=ROOT?>';
    const LINKROOT = '<?=LINKROOT?>';
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
    const pre_order_id = '<?=$preOrder['pre_order_id']?>';
    let shouldBeUpdated = '<?=$shouldBeUpdated?>';
    let status = '<?=$preOrder['status']?>';
    if(shouldBeUpdated)
        var preOrderItems = <?= json_encode($preOrderItems) ?>;
</script>
<script src="<?=ROOT?>/js/ShopOwner/preOrder.js" type="module"></script>

<?php $this->component("footer") ?>
