<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Pre-Order</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
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
        <img class="profile-img" src="<?=ROOT?>/images/Profile/<?=$preOrder['cus_phone']?>.<?=$preOrder['pic_format']?>" alt="">
    </div>
    <div class="billScroll border-1">
        <table class="bill">
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
                    $row_total = number_format($item['po_unit_price'] * $item['quantity'], 2);
                    echo "<tr class='Item'>
                            <td class='center-al'>" . ($i + 1) . "</td>
                            <td class='left-al'>" . $item['product_name'] . "</td>
                            <td> Rs." . number_format($item['po_unit_price'], 2) . "</td>
                            <td>" . $item['quantity'] . "</td>
                            <td> Rs." . $row_total . "</td>
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
        <a id="changeStatusBtn" href="#" class="btn">Start Processing</a>
    </div>
</div>

<script>
    const ROOT = '<?=ROOT?>';
    const LINKROOT = '<?=LINKROOT?>';
    const pre_order_id = '<?=$preOrder['pre_order_id']?>';
    const status = '<?=$preOrder['status']?>';
</script>
<script src="<?=ROOT?>/js/ShopOwner/preOrder.js"></script>

<?php $this->component("footer") ?>
