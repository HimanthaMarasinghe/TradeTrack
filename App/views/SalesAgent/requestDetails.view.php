<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Inventory Request Details</h3>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>

    <div class="row">
        <input type="text" class="search-bar fg1" placeholder="Search by date">
        <button class="btn">Search</button>
     </div>
    
    <h2 class="center-al">Request History</h2>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Id</th>
                    <th>Date</th>
                    <th>Item Count</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>More Details</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $requests = [
        ["id" => "1", "date" => "2023-10-25", "Item Count" => "05", "total" => "50000", "status" => "complete"],
        ["id" => "2", "date" => "2023-11-20", "Item Count" => "05", "total" => "75000", "status" => "complete"],
        ["id" => "3", "date" => "2023-12-10", "Item Count" => "07", "total" => "120000", "status" => "complete"],
        ["id" => "4", "date" => "2024-01-05", "Item Count" => "08", "total" => "45000", "status" => "complete"],
        ["id" => "5", "date" => "2024-02-24", "Item Count" => "10", "total" => "85000", "status" => "complete"],
        ["id" => "6", "date" => "2024-03-23", "Item Count" => "10", "total" => "60000", "status" => "complete"],
        ["id" => "7", "date" => "2024-04-22", "Item Count" => "11", "total" => "40000", "status" => "complete"],
        ["id" => "8", "date" => "2024-05-22", "Item Count" => "12", "total" => "90000", "status" => "complete"],
        ["id" => "9", "date" => "2024-06-21", "Item Count" => "12", "total" => "110000", "status" => "complete"],
        ["id" => "10", "date" => "2024-06-30", "Item Count" => "15", "total" => "30000", "status" => "complete"],
        ["id" => "11", "date" => "2024-07-20", "Item Count" => "15", "total" => "95000", "status" => "complete"],
        ["id" => "12", "date" => "2024-08-01", "Item Count" => "18", "total" => "80000", "status" => "complete"],
        ["id" => "13", "date" => "2024-08-19", "Item Count" => "13", "total" => "25000", "status" => "complete"],
        ["id" => "14", "date" => "2024-09-09", "Item Count" => "19", "total" => "550000", "status" => "complete"],
        ["id" => "15", "date" => "2024-09-30", "Item Count" => "08", "total" => "100000", "status" => "complete"],
        ["id" => "16", "date" => "2024-10-18", "Item Count" => "17", "total" => "3500000", "status" => "complete"],
        ["id" => "17", "date" => "2024-10-29", "Item Count" => "16", "total" => "70000", "status" => "complete"],
        ["id" => "18", "date" => "2024-11-05", "Item Count" => "11", "total" => "130000", "status" => "complete"],
        ["id" => "19", "date" => "2024-11-16", "Item Count" => "22", "total" => "95000", "status" => "complete"],
        ["id" => "20", "date" => "2024-12-01", "Item Count" => "10", "total" => "45000", "status" => "requested"]
    ];
    // Sort requests by date descending
    usort($requests, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    ?>

    <?php foreach ($requests as $request): ?>
        <tr class='Item'>
            <td class='center-al'><?= $request['id']; ?></td>
            <td class='center-al'><?= $request['date']; ?></td>
            <td class='center-al'><?= $request['Item Count']; ?></td>
            <td>Rs <?= $request['total']; ?>.00</td>
            <td class='center-al status-<?= $request['status']; ?>'><?= $request['status']; ?></td>
            <td>
                <button class='center-al btn btn-mini' onclick="openModal(<?= $request['id']; ?>)">More</button>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- Popup Modal -->
<div id="order-modal" class="order-modal">
    <div class="order-modal-content">
        <span class="order-close-btn" onclick="closeModal()">&times;</span>
        <h2>Request Details</h2>
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
            <tbody id="order-modal-body">
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

        </table>
        <hr>
        <h3 id="order-modal-total"></h3>
     
        <button onclick="closeModal()" class="btn reqclosebtn">Close</button>
   
    </div>
</div>

<script>
function openModal(id) {
    const requests = <?= json_encode($requests); ?>;
    const request = requests.find(r => r.id == id);

    if (!request) {
        alert("Request not found!");
        return;
    }

    // Populate modal with request details
    // const modalBody = document.getElementById("order-modal-body");
    // modalBody.innerHTML = `
    //     <tr><td>Request ID</td><td>${request.id}</td></tr>
    //     <tr><td>Date</td><td>${request.date}</td></tr>
    //     <tr><td>Item Count</td><td>${request['Item Count']}</td></tr>
    //     <tr><td>Status</td><td>${request.status}</td></tr>
    // `;
    // document.getElementById("order-modal-total").textContent = `Order Total: Rs. ${request.total}.00`;

    // Show the modal
    const modal = document.getElementById("order-modal");
    modal.style.display = "flex"; // Use flex to enable centering
}

function closeModal() {
    const modal = document.getElementById("order-modal");
    modal.style.display = "none";
}
</script>

<?php $this->component("footer") ?>
                 

               