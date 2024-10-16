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
        <h1 id="bill-Total">0</h1>
    </div>
    <hr>

    <div class="row col-max-1024">

        <div class="product-img-container">
            <img id="product-pic" class="product-img" src="<?=ROOT?>/images/Default/Product.jpeg" alt="">
        </div>

        <div class="colomn fg1">

            <div class="row scan">
                <input class="userInput" type="number" id="barCode" name="itemcode" placeholder="BarCode" autofocus>
                <input class="userInput fg1" type="text" id="product-name" placeholder="Product Name" readonly tabindex="-1">
            </div>

            <div class="row scan">
                <div>
                    <label for="qty">Qty.</label>
                    <input class="userInput short" type="number" id="qty" name="qty">
                </div>
                <div>
                    <label for="unit-price">Unit Price</label>
                    <input class="userInput short" type="text" id="unit-price" readonly tabindex="-1">
                </div>
                <div>
                    <label for="total">Total Price</label>
                    <input class="userInput short" type="text" id="total" readonly tabindex="-1">
                </div>
                <button class="btn" id="addBtn">+</button>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <a class="btn fg1 disabled-link">Card Payment</a>
        <a href="<?=LINKROOT?>/ShopOwner/billSettle" class="btn fg1 disabled-link" id="cashPayBtn">Cash Payment</a>
    </div>

    <script>
        let qtyElement = document.getElementById('qty');
        let barCodeElement = document.getElementById('barCode');
        let validBill = false; //set to true when at least one item is in the bill.

        barCodeElement.addEventListener('input', function (e) {
            e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;    
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
                fetch('<?=LINKROOT?>/ShopOwnerPost/addBillItem', {
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
                        product_pic.src = '<?=ROOT?>/images/Products/' + data.barcode + '.' + data.pic_format;
                        qtyElement.value = 1;
                        qtyElement.focus();
                    })
                    .catch(error => console.error('Error:', error));
                e.target.focus();
            }
        });

        qtyElement.addEventListener('input', function (e) {
            e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
            var qty = e.target.value;
            var unitPrice = document.getElementById('unit-price').value;
            document.getElementById('total').value = qty * unitPrice;

        });


        document.getElementById("addBtn").addEventListener('click', function (e) {
            var barcode = barCodeElement.value;
            var product_name = document.getElementById('product-name').value;
            var unit_price = document.getElementById('unit-price').value;
            var qty = document.getElementById('qty').value;
            var total = document.getElementById('total').value;

            if (barcode === '' || product_name === '' || unit_price === '') {
                barCodeElement.focus();
                return;
            }

            if (qty === '') {
                document.getElementById('qty').focus();
                return;
            }

            validBill = true;
            fetch('<?=LINKROOT?>/ShopOwnerPost/addBillItemToSession', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: '&qty=' + encodeURIComponent(qty)
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('bill').innerHTML = '';
                        data.bill.forEach(element => {
                            document.getElementById('bill').innerHTML += `<tr class='Item'>
                                                                        <td class='center-al'></td>
                                                                        <td class='left-al'>${element['name']}</td>
                                                                        <td>${element['price']}</td>
                                                                        <td>${element['qty']}</td>
                                                                        <td>${element['qty']*element['price']}</td>
                                                                        </tr>`;
                        });
                        document.getElementById('bill-Total').innerText = data.total;
                    })
                    .catch(error => console.error('Error:', error));
            document.getElementById('cashPayBtn').classList.remove('disabled-link');
            barCodeElement.focus();
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === '+') {
                document.getElementById('addBtn').click();
            }
            if (event.key === 'Enter' && validBill) {
                document.getElementById('cashPayBtn').click();
            }
        });

    </script>

    <?php $this->component("footer") ?>