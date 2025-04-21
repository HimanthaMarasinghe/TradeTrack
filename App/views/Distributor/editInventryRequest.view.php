<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content">
    <div class="newReqBody">
        <div class="leftBody">
            <div class="row salesagentrow">
                <input type="text" class="search-bar fg1" placeholder="Search">
                <button class="btn">Search</button>
            </div>
            <div class="salesagentproducts">
             
            
                <?php
                foreach($products as $product){ ?>
                    <a href="#" class="card btn-card center-al">
                    <p class="hidden"><?=$product['barcode']?></p>
                    <div class="details h-100">
                        <h4><?=$product['product_name']?></h4>
                        <h4>Rs.<?=$product['bulk_price']?>.00</h4>
                    </div>
                    <div class="product-img-container">
                        <img class="product-img" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>"
                        onerror="this.src='<?=ROOT?>/images/Default/Product.jpeg'" 
                        alt = "product image">
                    </div>
                </a>
                <?php } ?>
            

            </div>
        </div>

        <div class="rightBody">
            <h2>Edit Pending Request (Request No.<?=$OrderData['order']['order_id']?>)</h2>

            <div class="billScroll">
                <table class="bill">
                    <thead>
                        <tr class="BillHeadings">
                            <th>No.</th>
                            <th class="w-50">Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="bill" class="salesagenttablebody">
                        <!-- Rows will be added When we select item from the list -->
                    </tbody>
                </table>
            </div>

            <hr>
            <div class="total">
                <h1 id="bill-Total"><?=$OrderData['total']?></h1>
            </div>
            <hr>

            <div class="row col-max-1024">
                <div class="product-img-container">
                    <img id="product-pic" class="product-img" src="<?=ROOT?>/images/Default/Product.jpeg" 
                    onerror="this.src='<?=ROOT?>/images/Default/Product.jpeg'" 
                    alt="product image">
                </div>

                <div class="colomn fg1">
                    <div class="row scan">
                        <input class="userInput fg1" type="text" id="product-name" placeholder="Product Name" readonly tabindex="-1">
                    </div>

                    <div class="row scan">
                        <div>
                            <label for="qty">Qty.</label>
                            <input class="userInput short" type="number" id="qty" name="qty">
                        </div>
                        <div>
                            <label for="unit-price">Bulk Price</label>
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
                <a href="" class="btn placeOrderbtn" id="placeOrderBtn">Place Order</a>
            </div>
        </div>
    </div>
    <!-- Popup Window -->
    <div id="orderSuccessModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Order Successful!</h2>
            <p>Your order has been placed successfully. Here are the details:</p>
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
                <tbody id="orderDetailsBody">
                    <!-- Order details will be dynamically added here -->
                </tbody>
            </table>
            <hr>
            <h3>Bill Total: Rs.<span id="modal-bill-total">0.00</span></h3> <!-- Fixed ID -->
            <button id="closeOrderModal" class="btn">Close</button>
        </div>
    </div>
</div>

<script>
const dataFromBackend = <?=json_encode($OrderData)?>;
let barcode;
let billArray = [];
const LINKROOT = "<?=LINKROOT?>";
const billTBody = document.getElementById('bill');

dataFromBackend.orderProducts.forEach(item => {
    billArray.push({ barcode: item.barcode, quantity: item.quantity });
    billTBody.innerHTML += `
        <tr class="Item">
            <td class="center-al">${billTBody.rows.length + 1}</td>
            <td class="left-al">${item.product_name}</td>
            <td>${item.bulk_price.toFixed(2)}</td>
            <td class="quantity-cell">
                <button class="minus-btn">-</button>
                <span class="quantity-input">${item.quantity}</span>
                <button class="plus-btn">+</button>
            </td>
            <td>${(item.bulk_price * item.quantity).toFixed(2)}</td>
            <td>
                <button class="delete-btn">x</button>
            </td>
        </tr>
    `;    
});

// Empty rows in the table
function emptyRows() {
    const billTable = document.getElementById('bill');
    for (let i = 0; i < 10-dataFromBackend.orderProducts.length; i++) {
        const newRow = billTable.insertRow();
        newRow.className = 'Item empty-row';
        newRow.innerHTML = `
            <td class="center-al"></td>
            <td class="left-al"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        `;
    }
}

// Add product to the table
document.getElementById('addBtn').addEventListener('click', function () {
    const productName = document.getElementById('product-name').value;
    const unitPrice = parseFloat(document.getElementById('unit-price').value);
    const quantity = parseFloat(document.getElementById('qty').value) || 1;

    // Default quantity is 1
    // const quantity = 1;
    const total = unitPrice * quantity;

    if (!productName || !unitPrice) {
        alert('Please select a product.');
        return;
    }

    const billTable = document.getElementById('bill');
    const billTotal = document.getElementById('bill-Total');
    let currentTotal = parseFloat(billTotal.textContent) || 0;

    let existingRow = null;

    // Check if the product already exists
    Array.from(billTable.rows).forEach(row => {
        const rowProductName = row.cells[1]?.textContent || '';
        if (rowProductName === productName) {
            existingRow = row;
        }
    });

    if (existingRow) {
        // Update the existing row
        const existingQuantity = parseFloat(existingRow.querySelector('.quantity-input').textContent) || 0;
        const newQuantity = existingQuantity + quantity;
        const newTotal = newQuantity * unitPrice;

        existingRow.querySelector('.quantity-input').textContent = newQuantity;
        existingRow.cells[4].textContent = newTotal.toFixed(2);

        billTotal.textContent = (currentTotal + total).toFixed(2);

        let item = billArray.find(item => item.barcode === barcode);
        if (item) {
            item.quantity += quantity;
        } else {
            console.log("Item not found!");
        }

    } else {
        // Find the first empty row
        let emptyRow = Array.from(billTable.rows).find(row => row.classList.contains('empty-row'));

        if (emptyRow) {
            emptyRow.classList.remove('empty-row');
            emptyRow.innerHTML = `
                <td class="center-al">${Array.from(billTable.rows).indexOf(emptyRow) + 1}</td>
                <td class="left-al">${productName}</td>
                <td>${unitPrice.toFixed(2)}</td>
                <td class="quantity-cell">
                    <button class="minus-btn">-</button>
                    <span class="quantity-input">${quantity}</span>
                    <button class="plus-btn">+</button>
                </td>
                <td>${total.toFixed(2)}</td>
                <td>
                    <button class="delete-btn">x</button>
                </td>
            `;
        } else {
            const newRow = billTable.insertRow();
            newRow.className = 'Item';
            newRow.innerHTML = `
                <td class="center-al">${billTable.rows.length}</td>
                <td class="left-al">${productName}</td>
                <td>${unitPrice.toFixed(2)}</td>
                <td class="quantity-cell">
                    <button class="btn minus-btn">-</button>
                    <span class="quantity-input">${quantity}</span>
                    <button class="btn plus-btn">+</button>
                </td>
                <td>${total.toFixed(2)}</td>
                <td>
                    <button class="btn delete-btn small-btn">x</button>
                </td>
            `;
        }

        billTotal.textContent = (currentTotal + total).toFixed(2);
        billArray.push({ barcode: barcode, quantity: quantity });
    }


    // fetch(LINKROOT + '/Distributor/addOrderItemToSession', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/x-www-form-urlencoded'
    //     },
    //     body: 'barcode=' + encodeURIComponent(barcode) + 
    //         '&qty=' + encodeURIComponent(document.getElementById('qty').value)
    // })
    // .catch(error => console.error('Error:', error));




    // Clear input
    document.getElementById('product-name').value = '';
    document.getElementById('unit-price').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('total').value = '';
});

// Handle quantity updates via buttons
document.getElementById('bill').addEventListener('click', function (event) {
    const target = event.target;
    const row = target.closest('tr');
    const arrayIndex = row.querySelector('.center-al').textContent - 1;

    if (target.classList.contains('plus-btn') || target.classList.contains('minus-btn')) {
        const unitPrice = parseFloat(row.cells[2].textContent) || 0;
        const quantitySpan = row.querySelector('.quantity-input');
        let quantity = parseFloat(quantitySpan.textContent) || 0;


        if (target.classList.contains('plus-btn')) {
            quantity++;
            billArray[arrayIndex].quantity++;
        } else if (target.classList.contains('minus-btn')) {
            quantity--;
            billArray[arrayIndex].quantity--;
            if (quantity <= 0) {
                alert('Quantity must be greater than 0.');
                return;
            }
        }

        quantitySpan.textContent = quantity;

        // Update total in the row
        const newTotal = unitPrice * quantity;
        row.cells[4].textContent = newTotal.toFixed(2);

        // Update the overall bill total
        updateBillTotal();
    }

    if (target.classList.contains('delete-btn')) {
        const row = target.closest('tr');
        const rowTotal = parseFloat(row.cells[4].textContent) || 0;
        const billTotal = document.getElementById('bill-Total');
        const currentTotal = parseFloat(billTotal.textContent) || 0;

        // Update the total bill
        billTotal.textContent = (currentTotal - rowTotal).toFixed(2);

        // Remove the row
        row.remove();

        // Remove the item from the billArray
        billArray.splice(arrayIndex, 1);

        // Re-index rows
        reindexRows();
    }
});

// Update the total bill amount
function updateBillTotal() {
    const billTable = document.getElementById('bill');
    const billTotal = document.getElementById('bill-Total');

    let newTotal = 0;

    Array.from(billTable.rows).forEach(row => {
        const totalCell = row.cells[4];
        if (totalCell) {
            newTotal += parseFloat(totalCell.textContent) || 0;
        }
    });

    billTotal.textContent = newTotal.toFixed(2);
}

// Re-index table rows
function reindexRows() {
    const billTable = document.getElementById('bill');
    let index = 1;

    Array.from(billTable.rows).forEach(row => {
        if (!row.classList.contains('empty-row')) {
            row.cells[0].textContent = index++;
        }
    });
}

// Prevent negative or zero values in quantity input
document.getElementById('qty').addEventListener('input', function () {
    let quantity = parseFloat(this.value) || 0;

    if (quantity <= 0) {
        alert('Quantity must be greater than 0.');
        this.value = '';
    } else {
        const unitPrice = parseFloat(document.getElementById('unit-price').value) || 0;
        const total = unitPrice * quantity;

        document.getElementById('total').value = total.toFixed(2);
    }
});

// Populate product details when a card is clicked
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', function () {
        const productName = this.querySelector('h4:first-child').textContent;
        const unitPrice = parseFloat(this.querySelector('h4:last-child').textContent.replace('Rs.', '').trim());
        const productImgSrc = this.querySelector('.product-img').getAttribute('src');
        barcode = this.querySelector('.hidden').innerHTML;

        document.getElementById('product-name').value = productName;
        document.getElementById('unit-price').value = unitPrice;
        document.getElementById('product-pic').setAttribute('src', productImgSrc);

        document.getElementById('qty').value = '';
        document.getElementById('total').value = '';
    });
});

// Search bar functionality
document.querySelector('.search-bar').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase().trim();
    const cards = document.querySelectorAll('.salesagentproducts .card');

    cards.forEach(card => {
        const productName = card.querySelector('h4:first-child').textContent.toLowerCase();
        card.style.display = productName.includes(searchValue) ? '' : 'none';
    });
});

emptyRows();

// popup----------
// Handle Place Order Button Click
document.getElementById('placeOrderBtn').addEventListener('click', function (event) {
    event.preventDefault(); // Prevent default link behavior
    if(billArray.length === 0) {
        console.log("No items in the bill!");
        alert("Please add items to the bill before placing the order.");
        return;
    }
    sendBillToBackEnd();
    const billTable = document.getElementById('bill');
    const orderDetailsBody = document.getElementById('orderDetailsBody');
    const billTotal = document.getElementById('bill-Total');

    // Clear previous order details
    orderDetailsBody.innerHTML = '';

    // Copy rows from bill table to modal's order details table
    Array.from(billTable.rows).forEach((row, index) => {
        if (!row.classList.contains('empty-row')) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${index + 1}</td>
                <td>${row.cells[1]?.textContent || ''}</td>
                <td>${row.cells[2]?.textContent || ''}</td>
                <td>${row.querySelector('.quantity-input')?.textContent || ''}</td>
                <td>${row.cells[4]?.textContent || ''}</td>
            `;
            orderDetailsBody.appendChild(newRow);
        }
    });

    // Update the modal's bill total
    document.getElementById('modal-bill-total').textContent = billTotal.textContent; // Fixed ID reference

    // Show the modal
    document.getElementById('orderSuccessModal').style.display = 'block';
});

// Close the modal
document.querySelector('.close-btn').addEventListener('click', function () {
    document.getElementById('orderSuccessModal').style.display = 'none';
    window.location.href = '<?=LINKROOT?>/Distributor';
});

document.getElementById('closeOrderModal').addEventListener('click', function () {
    document.getElementById('orderSuccessModal').style.display = 'none';
    window.location.href = '<?=LINKROOT?>/Distributor/requestDetails';
});

// Close modal on clicking outside of the modal content
window.addEventListener('click', function (event) {
    if (event.target === document.getElementById('orderSuccessModal')) {
        document.getElementById('orderSuccessModal').style.display = 'none';
    }
});

function sendBillToBackEnd() {

    // Convert billItems to JSON
    let billData = JSON.stringify(billArray);

    // Send to backend
    fetch(LINKROOT + '/Distributor/updateRequest/' + dataFromBackend.order.order_id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: billData
    })
    .then(response => response.json()) // Parse response from backend
    .then(data => {
        if (data.success) {
            console.log("Bill finalized successfully!", data);
            // Clear the billItems array if needed
            billItems = [];
        } else {
            console.log("Error finalizing bill:", data.error);
        }
    })
    .catch(error => {
        console.error("Error during fetch:", error);
    });
}




</script>


<?php $this->component("footer") ?>
