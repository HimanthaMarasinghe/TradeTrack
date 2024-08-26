<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>No.</th>
                    <th class="w-50">Name</th>
                    <th>Price</th>
                    <th>Quntiti</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 1; $i<25; $i++){
                    echo "<tr class='Item'>
                            <td class='center-al'>$i</td>
                            <td class='left-al'>Rice 10kg</td>
                            <td>150</td>
                            <td>3</td>
                            <td>450</td>
                        </tr>";
                }
            ?>
                <tr></tr>
            </tbody>
        </table>
    </div>

    <hr>
    <div class="total">
        <h1>12,300</h1>
    </div>
    <hr>

    <div class="row scan">
            <label for="barCode">Enter Item code/ Scan BarCode</label>
            <input class="userInput" type="text" id="barCode" name="itemcode" autofocus>
            <label for="product-name">Product Name</label>
            <input class="userInput fg1" type="text" id="product-name" readonly>
    </div>

    <div class="row scan">
        <div>
            <label for="qty">Qty.</label>
            <input class="userInput" type="number" id="qty" name="qty">
        </div>
        <div>
            <label for="unit-price">Unit Price</label>
            <input class="userInput" type="text" id="unit-price" readonly>
        </div>
        <div>
            <label for="total">Total Price</label>
            <input class="userInput" type="text" id="total" readonly>
        </div>
        <button class="btn">+</button>
    </div>

    <hr>

    <div class="row">
        <a href="" class="btn fg1">Card Payment</a>
        <a href="http://localhost/TradeTrack/ShopOwner/billSettle" class="btn fg1">Cash Payment</a>
    </div>

    <script>
        document.getElementById('barCode').addEventListener('input', function(e) {
            if (e.target.value.length === 13) {
                var barcode = e.target.value;
                var product_name = document.getElementById('product-name');
                var unit_price = document.getElementById('unit-price');
                product_name.value = '';
                unit_price.value = '';
                document.getElementById('qty').value = '';
                document.getElementById('total').value = '';

                e.target.value = '';
                fetch('<?=LINKROOT?>/ShopOwnerPost/addBillItem', { // Replace with your controller method URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'barcodeIn=' + encodeURIComponent(barcode)
                })
                .then(response => response.json())
                .then(data => {
                    product_name.value = data.product_name;
                    unit_price.value = data.unit_price;
                })
                .catch(error => console.error('Error:', error));
                e.target.focus();
            }
        });
    
        document.getElementById('qty').addEventListener('input', function(e) {
            var qty = e.target.value;
            var unitPrice = document.getElementById('unit-price').value;
            document.getElementById('total').value = qty * unitPrice;
        });
    </script>

    <?php $this->component("footer") ?>