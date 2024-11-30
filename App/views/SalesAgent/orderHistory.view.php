<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Galle Maliban Distributors</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>

    <div class="row">
        <input type="text" class="search-bar fg1" placeholder="Search Shop Name">
        <button class="btn">Search</button>
     </div>
    
    <h2 class="center-al">Order History</h2>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Order Id</th>
                    <th>Date</th>
                    <th>Shop Name</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>More Details</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $orders = [
        ["id" => "1", "date" => "2024-11-25", "name" => "Galle Supermarket", "amount" => "50", "status" => "failed"],
        ["id" => "2", "date" => "2024-11-25", "name" => "Sunrise Grocery Store", "amount" => "75", "status" => "failed"],
        ["id" => "3", "date" => "2024-11-24", "name" => "Green Valley Groceries", "amount" => "120", "status" => "success"],
        ["id" => "4", "date" => "2024-11-24", "name" => "Fort Fresh Market", "amount" => "45", "status" => "success"],
        ["id" => "5", "date" => "2024-11-23", "name" => "Ocean View Grocery", "amount" => "85", "status" => "success"],
        ["id" => "6", "date" => "2024-11-23", "name" => "Galle Essentials", "amount" => "60", "status" => "success"],
        ["id" => "7", "date" => "2024-11-22", "name" => "Southern Groceries", "amount" => "40", "status" => "success"],
        ["id" => "8", "date" => "2024-11-22", "name" => "Cinnamon Market", "amount" => "90", "status" => "success"],
        ["id" => "9", "date" => "2024-11-21", "name" => "Hilltop Grocery", "amount" => "110", "status" => "success"],
        ["id" => "10", "date" => "2024-11-21", "name" => "Galle Mart", "amount" => "30", "status" => "success"],
        ["id" => "11", "date" => "2024-11-20", "name" => "Pearl Groceries", "amount" => "95", "status" => "success"],
        ["id" => "12", "date" => "2024-11-20", "name" => "Harbor View Mart", "amount" => "80", "status" => "success"],
        ["id" => "13", "date" => "2024-11-19", "name" => "Beachside Groceries", "amount" => "25", "status" => "success"],
        ["id" => "14", "date" => "2024-11-19", "name" => "Golden Leaf Mart", "amount" => "55", "status" => "success"],
        ["id" => "15", "date" => "2024-11-18", "name" => "Coral Coast Groceries", "amount" => "100", "status" => "success"],
        ["id" => "16", "date" => "2024-11-18", "name" => "Southern Spice Market", "amount" => "35", "status" => "success"],
        ["id" => "17", "date" => "2024-11-17", "name" => "Tropical Delights Grocery", "amount" => "70", "status" => "success"],
        ["id" => "18", "date" => "2024-11-17", "name" => "Coconut Grove Groceries", "amount" => "130", "status" => "success"],
        ["id" => "19", "date" => "2024-11-16", "name" => "Fort Bazaar Grocery", "amount" => "95", "status" => "failed"],
        ["id" => "20", "date" => "2024-11-16", "name" => "Lighthouse Grocery Center", "amount" => "45", "status" => "success"]
    ];
    ?>

    <?php foreach ($orders as $order): ?>
        <tr class='Item'>
            <td class='center-al'><?= $order['id']; ?></td>
            <td class='left-al'><?= $order['date']; ?></td>
            <td class='left-al'><?= $order['name']; ?></td>
            <td>Rs <?= $order['amount']; ?>.00</td>
            <td class='center-al status-<?= $order['status']; ?>'><?= $order['status']; ?></td>
            <td><button class='center-al btn btn-mini' onclick="openModal(<?= $order['id']; ?>)">More</button></td>
        </tr>
    <?php endforeach; ?>
</tbody>


        </table>
    </div>
</div>

<!-- Popup Window -->
<div id="orderSuccessModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2><?=$orders['id']?></h2>
            <h2><?=$orders['name']?></h2>
            <h2><?=$orders['date']?></h2>
            <table class="order-details-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php
    $orderProducts =[
        ["no" => "1", "productName" => "Maliban Milk Powder 400g", "price" => "1260.00", "quantity" => "50", "total" => "63000.00"],
        ["no" => "2", "productName" => "Maliban Chocolate Biscuit 100g", "price" => "110.00", "quantity" => "10", "total" => "1100.00"],
        ["no" => "3", "productName" => "Maliban Cream Cracker 200g", "price" => "250.00", "quantity" => "50", "total" => "12500.00"],
        ["no" => "4", "productName" => "Maliban Marie Biscuit 200g", "price" => "220.00", "quantity" => "150", "total" => "33000.00"],
        ["no" => "5", "productName" => "Maliban Sandwich Biscuit 200g", "price" => "300.00", "quantity" => "100", "total" => "30000.00"],
        ["no" => "6", "productName" => "Maliban Milk Cream Biscuit 100g", "price" => "150.00", "quantity" => "50", "total" => "7500.00"],
        ["no" => "7", "productName" => "Maliban Digestive Biscuit 250g", "price" => "300.00", "quantity" => "100", "total" => "30000.00"],
        ["no" => "8", "productName" => "Maliban Oaty Biscuit 200g", "price" => "180.00", "quantity" => "50", "total" => "9000.00"],
        ["no" => "9", "productName" => "Maliban Lemon Puff 200g", "price" => "220.00", "quantity" => "25", "total" => "5500.00"],
        ["no" => "10", "productName" => "Maliban Sweet Milk Biscuit 200g", "price" => "240.00", "quantity" => "25", "total" => "6000.00"],
        ["no" => "11", "productName" => "Maliban Ginger Biscuit 200g", "price" => "210.00", "quantity" => "50", "total" => "10500.00"],
        ["no" => "12", "productName" => "Maliban Krisco Biscuit 170g", "price" => "170.00", "quantity" => "50", "total" => "8500.00"],
        ["no" => "13", "productName" => "Maliban Chocolate Puff Biscuit 200g", "price" => "260.00", "quantity" => "50", "total" => "13000.00"],
        ["no" => "14", "productName" => "Maliban Orange Cream Biscuit 200g", "price" => "230.00", "quantity" => "50", "total" => "11500.00"],
      ]
      
    ?>

    <?php foreach ($orderProducts as $orderProduct): ?>
        <tr class='Item'>
            <td class='center-al'><?= $orderProduct['id']; ?></td>
            <td class='left-al'><?= $orderProduct['productName']; ?></td>
            <td class='left-al'><?= $orderProduct['price']; ?></td>
            <td><?= $orderProduct['quantity']; ?></td>
            <td><?= $orderProduct['total']; ?></td>
        </tr>
    <?php endforeach; ?>

                </tbody>
            </table>
            <hr>
            <h3>Order Total: Rs.<?=$orders['amount']?>.00</h3>
            <button id="closeOrderModal" class="btn">Close</button>
        </div>
    </div>

<?php $this->component("footer") ?>