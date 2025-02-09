<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<form class="main-content flex-wrap" method="post" action="<?=LINKROOT?>/ShopOwner/purchaseDone" id="bill-form" autocomplete="off">
    <div class="center">
        <h1>Total</h1>
        <input id="total" type="text" class="userInput" value="<?=$total?>" readonly tabindex="-1">
    
        <h2>Cash</h2>
        <input class="userInput red-text" type="number" id="cash" autofocus>
    
        <h2>Change</h2>
        <input id="change" type="text" class="userInput red-text" value="-<?=$total?>" readonly tabindex="-1">
    
        <h4>Customer's Phone number</h4>
        <input class="userInput" type="number" id="cus-phone" name="cus-phone" autocomplete="off">
        <!-- type = tel still allows characters other than numbers, so here we have used type = number -->
    
        <h4>Customer's E-mail</h4>
        <input class="userInput" type="email" id="cus-email" name="cus-email" autocomplete="off">
    
        <div><hr></div>

        <button class="btn fg1" id="print" tabindex="-1">Print the bill</button>
        <button class="btn fg1" id="skip" tabindex="-1">Skip the bill</button>
        <button class="btn fg1 disabled-link" id="sms-bill" tabindex="-1">Send the bill via SMS</button>
        <button class="btn fg1 disabled-link" id="email-bill" tabindex="-1">Send the bill via E-mail</button>

    </div>
    <div id="cus-details" class="center hidden">

        <div>
            <h1>Registerd Customer</h1>
        </div>
        
        <div>
            <img class="profile-img" id="cus-img" src="#" alt="Customer profile image">
        </div>

        <div class="max-w-330">
            <h3 id="cus-name">Customer's Name</h3>
        </div>

        <div class="max-w-330">
            <h5 id="cus-address">Customer's Address what if this is way too long what if this is way too long what if this is way too long</h5>
        </div>

        <div>
            <h5 id="loayalty">Is a loyalty customer</h5>
        </div>

        <!-- 
        in below elements, "hw_" and "lc" classes are used to query elements in the script 
        "hw0" - hidden when the change is 0
        "hwl" - hidden when the change is less than 0
        "hwg" - hidden when the change is greater than 0
        "lc"  - hidden when the customer is not a loyalty customer
        -->

        <h4 class="lc right-al">Curently in wallet</h4>
        <input id="wallet" class="lc userInput max-w-140" type="text" readonly tabindex="-1">

        <div class="hw0 lc hidden"><hr></div>
        <div class="hw0 lc hidden"><hr></div>

        <h4 class="hw0 hwl lc right-al hidden">Return to customer</h4>
        <input class="hw0 hwl lc userInput max-w-140 hidden" type="number" id="return-to-cus">

        <span class="hw0 hwl lc hidden"></span><p class="hw0 hwl lc center-al hidden">+</p>
            
        <h4 class="hw0 hwl lc right-al hidden">Add to wallet</h4>
        <h4 class="hw0 hwg lc right-al hidden">Reduse from wallet</h4>
        <input class="hw0 lc userInput max-w-140 hidden" type="text" id="wallet-update" name="wallet" value="-<?=$total?>" disabled readonly tabindex="-1">

        <span class="hw0 hwl lc hidden"></span><p class="hw0 hwl lc center-al hidden">=</p>

        <h4 class="hw0 hwl lc right-al hidden">Change</h4>
        <input class="hw0 hwl lc userInput max-w-140 hidden" id="change-loyaltyBox" type="text" readonly tabindex="-1">
    </div>
</form>

<!-- Printable Bill format -->

<div id="bill-content" class="bill-content">
        <h1 id="bill-shopName">Gamunu Stores</h1>
        <p id="bill-date"></p>
        <p id="bill-time"></p>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>U.Prz</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($bill as $item){
                    $itemTotal = $item['price'] * $item['qty'];
                    echo "<tr>
                        <td>{$item['name']}</td>
                        <td>{$item['price']}</td>
                        <td>{$item['qty']}</td>
                        <td>{$itemTotal}</td>";
                }?>
                <tr><td colspan="3">Total : </td><td><?=$total?></td></tr>
            </tbody>
        </table>
        <hr>
        <p>Thank you for your purchase!</p>
</div>

<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>
<script src="<?=ROOT?>/js/billSettle.js" type="module"></script>

<?php $this->component("footer") ?>