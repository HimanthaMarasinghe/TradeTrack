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
            <tbody id="bill">
                <!-- <tr class="Item">
                    <td class="center-al">1</td>
                    <td class="left-al">Product Name</td>
                    <td>100</td>
                    <td>2</td>
                    <td>200</td>
                </tr> -->
            </tbody>
        </table>
    </div>

    <hr>
    <div class="total">
        <h1>12,300</h1>
    </div>
    <hr>

    <div class="row col-max-1024">

        <div class="product-img">
            <img id="product-pic" src="<?=ROOT?>/images/Default/Product.jpeg" alt="">
        </div>

        <div class="colomn fg1">

            <div class="row scan">
                <!-- <label for="barCode">Enter Item code/ Scan BarCode</label> -->
                <input class="userInput" type="text" id="barCode" name="itemcode" placeholder="BarCode" autofocus>
                <!-- <label for="product-name">Product Name</label> -->
                <input class="userInput fg1" type="text" id="product-name" placeholder="Product Name" readonly>
            </div>

            <div class="row scan">
                <div>
                    <label for="qty">Qty.</label>
                    <input class="userInput short" type="number" id="qty" name="qty">
                </div>
                <div>
                    <label for="unit-price">Unit Price</label>
                    <input class="userInput short" type="text" id="unit-price" readonly>
                </div>
                <div>
                    <label for="total">Total Price</label>
                    <input class="userInput short" type="text" id="total" readonly>
                </div>
                <button class="btn" id="addBtn">+</button>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <a href="" class="btn fg1">Card Payment</a>
        <a href="http://localhost/TradeTrack/ShopOwner/billSettle" class="btn fg1">Cash Payment</a>
    </div>

    <script>
        document.getElementById('barCode').addEventListener('input', function (e) {
            
            var product_name = document.getElementById('product-name');
            var unit_price = document.getElementById('unit-price');
            var product_pic = document.getElementById('product-pic');
            product_name.value = '';
            unit_price.value = '';
            product_pic.src = '<?=ROOT?>/images/Default/Product.jpeg';
            document.getElementById('qty').value = '';
            document.getElementById('total').value = '';

            if (e.target.value.length > 13) {
                e.target.value = e.target.value.substring(13);
            }

            if (e.target.value.length === 13) {
                fetch('<?=LINKROOT?>/ShopOwnerPost/addBillItem', { // Replace with your controller method URL
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'barcodeIn=' + encodeURIComponent(e.target.value)
                    })
                    .then(response => response.json())
                    .then(data => {
                        product_name.value = data.product_name;
                        unit_price.value = data.unit_price;
                        product_pic.src = '<?=ROOT?>/images/Products/' + data.barcode + '.jpeg';
                    })
                    .catch(error => console.error('Error:', error));
                e.target.focus();
            }
        });

        document.getElementById('qty').addEventListener('input', function (e) {
            var qty = e.target.value;
            var unitPrice = document.getElementById('unit-price').value;
            document.getElementById('total').value = qty * unitPrice;
        });


        document.getElementById("addBtn").addEventListener('click', function (e) {
            var barcode = document.getElementById('barCode').value;
            var product_name = document.getElementById('product-name').value;
            var unit_price = document.getElementById('unit-price').value;
            var qty = document.getElementById('qty').value;
            var total = document.getElementById('total').value;

            if (barcode === '' || product_name === '' || unit_price === '') {
                document.getElementById('barCode').focus();
                return;
            }

            if (qty === '') {
                document.getElementById('qty').focus();
                return;
            }

            document.getElementById('bill').innerHTML += `<tr class='Item'>
                <td class='center-al'></td>
                <td class='left-al'>${product_name}</td>
                <td>${unit_price}</td>
                <td>${qty}</td>
                <td>${total}</td>`;
        });
    </script>

    <?php $this->component("footer") ?>