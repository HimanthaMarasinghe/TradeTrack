<?php 
    $this->component("header", $styleSheet);
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
        <a class="btn fg1 disabled-link" style="visibility:hidden;">Card Payment</a>
        <a href="<?=LINKROOT?>/ShopOwner/billSettle" class="btn fg1 disabled-link" id="cashPayBtn">Cash Payment</a>
    </div>

    <div id="notification-container"></div>

    <script>
        const ROOT = "<?=ROOT?>";
        const LINKROOT = "<?=LINKROOT?>"
        const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
        const ws_token = "<?=$_SESSION['web_socket_token']?>";
    </script>
    <script src="<?=ROOT?>/js/newPurchase.js" type="module"></script>

    <?php $this->component("footer") ?>