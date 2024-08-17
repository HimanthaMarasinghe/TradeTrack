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
        <div>
            <label for="barCode">Enter Item code/ Scan BarCode</label>
            <input type="text" id="barCode" name="itemcode">
        </div>
        <div>
            <label for="qty">Qty.</label>
            <input type="number" id="qty" name="qty">
        </div>
        <button class="btn">+</button>
    </div>

    <div class="newItem">
        <table class="bill">
            <tbody>
                <tr class='Item'>
                    <td>0</td>
                    <td>Rice 10kg</td>
                    <td>150</td>
                    <td>3</td>
                    <td>450</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="row">
        <a href="" class="btn fg1">Card Payment</a>
        <a href="http://localhost/TradeTrack/ShopOwner/billSettle" class="btn fg1">Cash Payment</a>
    </div>

    <?php $this->component("footer") ?>