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
                <td>Customer Name</td>
                <td>- <a href="<?=LINKROOT?>/ShopOwner/Customer/<?=$preOrder['cus_phone']?>" class="link"><?=$preOrder['first_name']?> <?=$preOrder['last_name']?></a></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>- <?=$preOrder['cus_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>- <?=$preOrder['address']?></td>
            </tr>
            <tr>
                <td>Wallet</td>
                <td id="walletElem">- <b class="green-text">Rs.<?=number_format($preOrder['wallet'], 2)?></b></td>
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

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="popUp" class="popUpDiv hidden">
    <form class="row w-1000px" method="post" action="<?=LINKROOT?>/ShopOwner/purchaseDone" id="bill-form" autocomplete="off">
        <div class="center">
            <h1>Total</h1>
            <input id="total" type="text" class="userInput" value="<?=$preOrder['total']?>" readonly tabindex="-1">
        
            <h2>Cash</h2>
            <input class="userInput red-text" type="number" id="cash" min="0" autofocus>
        
            <h2>Change</h2>
            <input id="change" type="text" class="userInput red-text" value="-<?=$preOrder['total']?>" readonly tabindex="-1">
        
            <div><hr></div>

            <button class="btn fg1" id="print" tabindex="-1">Print the bill</button>
            <button class="btn fg1" id="skip" tabindex="-1">Skip the bill</button>
            <button class="btn fg1 disabled-link" id="sms-bill" tabindex="-1">Send the bill via SMS</button>
            <button class="btn fg1 disabled-link" id="email-bill" tabindex="-1">Send the bill via E-mail</button>

        </div>
        <div id="cus-details" class="center">

            <div class="max-w-330">
                <h1 id="cus-name"><?=$preOrder['first_name']?> <?=$preOrder['last_name']?></h1>
            </div>
            
            <div>
                <img 
                    class="profile-img" 
                    id="cus-img"
                    src="<?=ROOT?>/images/Profile/<?=$preOrder['cus_phone']?>.<?=$preOrder['pic_format']?>" 
                    onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'"
                    alt=""
                >
            </div>

            <!-- 
            in below elements, "hw_" and "lc" classes are used to query elements in the script 
            "hw0" - hidden when the change is 0
            "hwl" - hidden when the change is less than 0
            "hwg" - hidden when the change is greater than 0
            "lc"  - hidden when the customer is not a loyalty customer
            -->

            <h4 class="lc right-al">Curently in wallet</h4>
            <input id="wallet" class="lc userInput max-w-140" type="text" readonly tabindex="-1" value="<?=number_format($preOrder['wallet'], 2)?>">

            <div class="hw0 lc hidden"><hr></div>
            <div class="hw0 lc hidden"><hr></div>

            <h4 class="hw0 hwl lc right-al hidden">Return to customer</h4>
            <input class="hw0 hwl lc userInput max-w-140 hidden" type="number" id="return-to-cus">

            <span class="hw0 hwl lc hidden"></span><p class="hw0 hwl lc center-al hidden">+</p>
                
            <h4 class="hw0 hwl lc right-al hidden">Add to wallet</h4>
            <h4 class="hw0 hwg lc right-al">Reduse from wallet</h4>
            <input class="hw0 lc userInput max-w-140" type="text" id="wallet-update" name="wallet" value="-<?=$preOrder['total']?>" disabled readonly tabindex="-1">

            <span class="hw0 hwl lc hidden"></span><p class="hw0 hwl lc center-al hidden">=</p>

            <h4 class="hw0 hwl lc right-al hidden">Change</h4>
            <input class="hw0 hwl lc userInput max-w-140 hidden" id="change-loyaltyBox" type="text" readonly tabindex="-1">
        </div>
    </form>
</div>

<script>
    const ROOT = '<?=ROOT?>';
    const LINKROOT = '<?=LINKROOT?>';
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const pre_order_id = '<?=$preOrder['pre_order_id']?>';
    const walletAmount = <?=$preOrder['wallet']?>;
    const preOrderTotal = '<?=$preOrder['total']?>';
    let shouldBeUpdated = '<?=$shouldBeUpdated?>';
    let shouldBeRejected = '<?=$shouldBeRejected?>'
    let status = '<?=$preOrder['status']?>';
    if(shouldBeUpdated)
        var preOrderItems = <?= json_encode($preOrderItems) ?>;
</script>
<script src="<?=ROOT?>/js/ShopOwner/preOrder.js" type="module"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>
