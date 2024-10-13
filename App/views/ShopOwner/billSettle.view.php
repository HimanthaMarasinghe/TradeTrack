<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <form class="center" method="post" action="<?=LINKROOT?>/ShopOwner/purchaseDone" id="bill-form">
        
            <h1>Total</h1>
            <h1 id="total"><?=$total?></h1>
        
            <h2>Cash</h2>
            <input class="userInput red-text" type="text" id="cash">
        
            <h2>Change</h2>
            <span class="row">
                <h2 class="fg1 red-text" id="change">-<?=$total?></h2>
                <a href="" class="btn disabled-link" id="add-to-wallet">Add to wallet<br>
                    <h6>(Phone number required)</h6>
                </a>
            </span>
        
            <h4>Customer's Phone number</h4>
            <input class="userInput" type="tel" id="cus-phone" name="cus-phone" autocomplete="off">
        
            <h4>Customer's E-mail</h4>
            <input class="userInput" type="email" id="cus-email" name="cus-email" autocomplete="off">
        
                <button class="btn fg1" id="print">Print the bill</button>
                <button class="btn fg1" id="skip">Skip</button>
                <button class="btn fg1 disabled-link" id="sms-bill">Send the bill via SMS</button>
                <button class="btn fg1 disabled-link" id="email-bill">Send the bill via E-mail</button>

    </form>
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
    let change = -document.getElementById('total').innerHTML;
    let addToWallet = document.getElementById('add-to-wallet');
    let changeElement = document.getElementById('change');

    document.getElementById('cash').addEventListener('input', function(e) {
        change = e.target.value - document.getElementById('total').innerHTML;
        
        if(change !== 0 && vaildatePhone(document.getElementById('cus-phone').value)) {
            addToWallet.classList.remove('disabled-link');
        } else {
            addToWallet.classList.add('disabled-link');
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
        changeElement.innerHTML = change;
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
            if(change != 0)
                document.getElementById('add-to-wallet').classList.remove('disabled-link');
        } else {
            document.getElementById('sms-bill').classList.add('disabled-link');
            document.getElementById('add-to-wallet').classList.add('disabled-link');
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