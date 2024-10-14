<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content flex-wrap">
    <form class="center" method="post" action="<?=LINKROOT?>/ShopOwner/purchaseDone" id="bill-form">
        
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

    </form>
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

        <!-- <div class="row alitem-center m-i-auto hidden" id="wallet-div"> -->
            <h4 class="right-al">Curently in wallet</h4>
            <input id="wallet" class="userInput max-w-140" type="text" readonly tabindex="-1">
        <!-- </div> -->

        <div><hr></div>
        <div><hr></div>

            <h4 class="right-al">Return to customer</h4>
            <input class="userInput max-w-140" type="text">

        <span></span><p class="center-al">+</p>
            
            <h4 class="right-al">Add to wallet</h4>
            <input class="userInput max-w-140" type="text" readonly tabindex="-1">

        <span></span><p class="center-al">=</p>

            <h4 class="right-al">Change</h4>
            <input class="userInput max-w-140" type="text" readonly tabindex="-1">
            

        <!-- <div id="wallet-btn" class="hidden">
            <button class="btn" id="w-btn">Reduse wallet by <?=$total?></button>
        </div> -->
    </div>
</div>

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
    // let addToWallet = document.getElementById('add-to-wallet');
    let changeElement = document.getElementById('change');

    document.getElementById('cash').addEventListener('input', function(e) {
        change = e.target.value - document.getElementById('total').value;
        
        if(change !== 0 && vaildatePhone(document.getElementById('cus-phone').value)) {
            // addToWallet.classList.remove('disabled-link');
        } else {
            // addToWallet.classList.add('disabled-link');
        }

        if(change < 0) {
            changeElement.classList.remove('green-text');
            e.target.classList.remove('green-text');
            changeElement.classList.add('red-text');
            e.target.classList.add('red-text');
        } else {
            changeElement.classList.remove('red-text');
            e.target.classList.remove('red-text');
            changeElement.classList.add('green-text');
            e.target.classList.add('green-text');
        }
        changeElement.value = change;
    });

    document.getElementById('cus-email').addEventListener('input', function(e) {
        if(e.target.checkValidity() && e.target.value.length > 0) {
            document.getElementById('email-bill').classList.remove('disabled-link');
        } else {
            document.getElementById('email-bill').classList.add('disabled-link');
        }
    });

    document.getElementById('cus-phone').addEventListener('input', function(e) {
        if (vaildatePhone(e.target.value)) {
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
                    console.log(data);
                    document.getElementById('cus-img').src = '<?=ROOT?>/images/Profile/' + e.target.value + '.jpg';
                    document.getElementById('cus-name').innerText = data.cus_first_name + ' ' + data.cus_last_name;
                    document.getElementById('cus-address').innerText = data.cus_address;
                    document.getElementById('loayalty').innerText = data.loyalty ? 'Is a loyalty customer' : 'Not a loyalty customer';
                    if(data.loyalty){
                        document.getElementById('wallet').value = 'Rs. ' + data.loyalty.wallet;
                        // document.getElementById('wallet-div').classList.remove('hidden');
                        // document.getElementById('wallet-btn').classList.remove('hidden');
                    }
                    else{
                        // document.getElementById('wallet-div').classList.add('hidden');
                        // document.getElementById('wallet-btn').classList.add('hidden');
                    }
                    document.getElementById('cus-details').classList.remove('hidden');
                }
            }).catch(error => console.error('Error:', error));
            // if(change != 0)
                // document.getElementById('add-to-wallet').classList.remove('disabled-link');
        } else {
            document.getElementById('sms-bill').classList.add('disabled-link');
            // document.getElementById('add-to-wallet').classList.add('disabled-link');
            document.getElementById('cus-details').classList.add('hidden');
        }
    });

    function vaildatePhone(phone) {
        const regex = /^\d{10}$/;
        return regex.test(phone);
    }

    document.getElementById('skip').addEventListener('click', function(e) {
        e.preventDefault();
        // window.location.href = '<?=LINKROOT?>/ShopOwner/purchaseDone';
        document.getElementById('bill-form').submit();
    });

    document.getElementById('print').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('bill-date').innerText = 'Date : ' + new Date().toLocaleDateString();
        document.getElementById('bill-time').innerText = 'Time : ' + new Date().toLocaleTimeString();
        window.print();
        // window.location.href = '<?=LINKROOT?>/ShopOwner/purchaseDone';
        document.getElementById('bill-form').submit();
    });
</script>

<?php $this->component("footer") ?>