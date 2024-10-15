<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<form class="main-content flex-wrap" method="post" action="<?=LINKROOT?>/ShopOwner/purchaseDone" id="bill-form">
    <!-- <div class="center" method="post" action="<?=LINKROOT?>/ShopOwner/purchaseDone" id="bill-form"> -->
    <div class="center">
        <h1>Total</h1>
        <input id="total" type="text" class="userInput" value="<?=$total?>" readonly tabindex="-1">
        <!-- <h1 id="total"><?=$total?></h1> -->
    
        <h2>Cash</h2>
        <input class="userInput red-text" type="text" id="cash">
    
        <h2>Change</h2>
        <input id="change" type="text" class="userInput red-text" value="-<?=$total?>" readonly tabindex="-1">
        <!-- <h2 class="fg1 red-text" id="change">-<?=$total?></h2> -->
    
        <h4>Customer's Phone number</h4>
        <input class="userInput" type="tel" id="cus-phone" name="cus-phone" autocomplete="off">
    
        <h4>Customer's E-mail</h4>
        <input class="userInput" type="email" id="cus-email" name="cus-email" autocomplete="off">
    
        <div><hr></div>

        <button class="btn fg1" id="print">Print the bill</button>
        <button class="btn fg1" id="skip">Skip</button>
        <button class="btn fg1 disabled-link" id="sms-bill">Send the bill via SMS</button>
        <button class="btn fg1 disabled-link" id="email-bill">Send the bill via E-mail</button>

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

        <!-- <div class="row alitem-center m-i-auto hidden" id="wallet-div"> -->
        <h4 class="lc right-al">Curently in wallet</h4>
        <input id="wallet" class="lc userInput max-w-140" type="text" readonly tabindex="-1">
        <!-- </div> -->

        <div class="hw0 lc hidden"><hr></div>
        <div class="hw0 lc hidden"><hr></div>

        <h4 class="hw0 hwl lc right-al hidden">Return to customer</h4>
        <input class="hw0 hwl lc userInput max-w-140 hidden" type="text" id="return-to-cus">

        <span class="hw0 hwl lc hidden"></span><p class="hw0 hwl lc center-al hidden">+</p>
            
        <h4 class="hw0 hwl lc right-al hidden">Add to wallet</h4>
        <h4 class="hw0 hwg lc right-al hidden">Reduse from wallet</h4>
        <input class="hw0 lc userInput max-w-140 hidden" type="text" id="wallet-update" name="wallet" value="-<?=$total?>" disabled readonly tabindex="-1">

        <span class="hw0 hwl lc hidden"></span><p class="hw0 hwl lc center-al hidden">=</p>

        <h4 class="hw0 hwl lc right-al hidden">Change</h4>
        <input class="hw0 hwl lc userInput max-w-140 hidden" id="change-loyaltyBox" type="text" readonly tabindex="-1">
            

        <!-- <div id="wallet-btn" class="hidden">
            <button class="btn" id="w-btn">Reduse wallet by <?=$total?></button>
        </div> -->
    </div>
</form>

<!-- Printable Bill format -->

<div id="bill-content" class="bill-content">
        <h1 id="bill-shopName">Shop Name</h1>
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

<script>
    let change = -document.getElementById('total').value;
    let changeElement = document.getElementById('change');
    let walletUpdate = document.getElementById('wallet-update');
    let cus_details = document.getElementById('cus-details');

    let hw0 = document.querySelectorAll('.hw0');
    let hwl = document.querySelectorAll('.hwl');
    let hwg = document.querySelector('.hwg');
    let lc  = document.querySelectorAll('.lc');

    let isRegistered = false;
    let isLoyalty = false;

    document.getElementById('cash').addEventListener('input', function(e) {
        change = e.target.value - document.getElementById('total').value;
        
        if(change !== 0) {
            hw0.forEach(element => {
                element.classList.remove('hidden');
            });
            document.getElementById('wallet-update').disabled = false;
        } else {
            hw0.forEach(element => {
                element.classList.add('hidden');
            });
            document.getElementById('wallet-update').disabled = true;
        }

        if(change < 0) {
            changeElement.classList.remove('green-text');
            e.target.classList.remove('green-text');
            changeElement.classList.add('red-text');
            e.target.classList.add('red-text');
            document.getElementById('wallet-update').value = change;
            hwl.forEach(element => {
                element.classList.add('hidden');
            });
        } else {
            changeElement.classList.remove('red-text');
            e.target.classList.remove('red-text');
            changeElement.classList.add('green-text');
            e.target.classList.add('green-text');
            hwg.classList.add('hidden');
            document.getElementById('wallet-update').value = 0;
        }
        changeElement.value = change;
        document.getElementById('change-loyaltyBox').value = change;
        document.getElementById('return-to-cus').value =change;
    });

    document.getElementById('cus-email').addEventListener('input', function(e) {
        if(e.target.checkValidity() && e.target.value.length > 0) {
            document.getElementById('email-bill').classList.remove('disabled-link');
            e.target.classList.remove('red-text');
            e.target.classList.add('green-text');
        } else {
            document.getElementById('email-bill').classList.add('disabled-link');
            e.target.classList.remove('green-text');
            e.target.classList.add('red-text');
        }
    });

    document.getElementById('cus-phone').addEventListener('input', function(e) {
        if (vaildatePhone(e.target.value)) {
            e.target.classList.remove('red-text');
            e.target.classList.add('green-text');
            document.getElementById('sms-bill').classList.remove('disabled-link');
            fetch('<?=LINKROOT?>/ShopOwner/checkCustomer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'cus-phone=' + encodeURIComponent(e.target.value)
            }).then(response => response.json())
            .then(data => {
                if(data){
                    isRegistered = true;
                    console.log(data);
                    document.getElementById('cus-img').src = '<?=ROOT?>/images/Profile/' + e.target.value + '.jpg';
                    document.getElementById('cus-name').innerText = data.cus_first_name + ' ' + data.cus_last_name;
                    document.getElementById('cus-address').innerText = data.cus_address;
                    document.getElementById('loayalty').innerText = data.loyalty ? 'Is a loyalty customer' : 'Not a loyalty customer';
                    if(data.loyalty){
                        isLoyalty = true;
                        document.getElementById('wallet').value = 'Rs. ' + data.loyalty.wallet;
                    }
                    else{
                        isLoyalty = false;
                    }
                }else{
                    isRegistered = false;
                    isLoyalty = false;
                }
                updateUI();
            }).catch(error => console.error('Error:', error));
        } else {
            isRegistered = false;
            isLoyalty = false;
            e.target.classList.remove('green-text');
            e.target.classList.add('red-text');
            updateUI();
            document.getElementById('sms-bill').classList.add('disabled-link');
            cus_details.classList.add('hidden');
        }
    });

    document.getElementById('return-to-cus').addEventListener('input', function(e) {
        document.getElementById('wallet-update').value = change - e.target.value;
    });

    function vaildatePhone(phone) {
        const regex = /^\d{10}$/;
        return regex.test(phone);
    }

    document.getElementById('skip').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('bill-form').submit();
    });

    document.getElementById('print').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('bill-date').innerText = 'Date : ' + new Date().toLocaleDateString();
        document.getElementById('bill-time').innerText = 'Time : ' + new Date().toLocaleTimeString();
        window.print();
        document.getElementById('bill-form').submit();
    });

    function updateUI(){
        if(isRegistered){
            cus_details.classList.remove('hidden');
            if(isLoyalty){
                lc.forEach(element => {
                    element.classList.remove('hidden');
                });
                if(change < 0){
                    hwl.forEach(element => {
                        element.classList.add('hidden');
                    });
                }else if(change > 0){
                    hwg.classList.add('hidden');
                }else{
                    hw0.forEach(element => {
                        element.classList.add('hidden');
                    });
                }
            }else{
                lc.forEach(element => {
                    element.classList.add('hidden');
                });
            }
        } else {
            cus_details.classList.add('hidden');
        }

        if(isLoyalty && change != 0){
            walletUpdate.disabled = false;
        } else {
            walletUpdate.disabled = true;
        }
    }

</script>

<?php $this->component("footer") ?>