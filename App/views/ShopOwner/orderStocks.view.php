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
                <?php for($x = 0; $x < 20; $x++) { ?>
                    <a href="#" class="card btn-card center-al">
                        <div class="details h-100">
                            <!-- Product Name -->
                            <h4>Maliban Milk Powder 400g</h4>
                            <!-- Unit Price -->
                            <h4>Rs.1260.00</h4>
                        </div>
                        <div class="product-img-container">
                            <img class="product-img" src="<?=ROOT?>/images/Products/4790015950624.png" alt="">
                        </div>
                    </a>
                    <a href="#" class="card btn-card center-al">
                        <div class="details h-100">
                            <!-- Product Name -->
                            <h4>Maliban Chocolate Biscuit 100g</h4>
                            <!-- Unit Price -->
                            <h4>Rs.110.00</h4>
                        </div>
                        <div class="product-img-container">
                            <img class="product-img" src="<?=ROOT?>/images/Products/4791034072366.jpeg" alt="">
                        </div>
                    </a>
                    <a href="#" class="card btn-card center-al">
                        <div class="details h-100">
                            <!-- Product Name -->
                            <h4>Cloguard Tooth Paste 100g</h4>
                            <!-- Unit Price -->
                            <h4>Rs.240.00</h4>
                        </div>
                        <div class="product-img-container">
                            <img class="product-img" src="<?=ROOT?>/images/Products/4791111102948.jpeg" alt="">
                        </div>
                    </a>
                    <a href="#" class="card btn-card center-al">
                        <div class="details h-100">
                            <!-- Product Name -->
                            <h4>Wijaya Chillie Pieces 100g</h4>
                            <!-- Unit Price -->
                            <h4>Rs.350.00</h4>
                        </div>
                        <div class="product-img-container">
                            <img class="product-img" src="<?=ROOT?>/images/Products/4792173000005.jpeg" alt="">
                        </div>
                    </a>
                    <a href="#" class="card btn-card center-al">
                        <div class="details h-100">
                            <!-- Product Name -->
                            <h4>Munchee Cheese Buttons Bicuit 170g</h4>
                            <!-- Unit Price -->
                            <h4>Rs.300.00</h4>
                        </div>
                        <div class="product-img-container">
                            <img class="product-img" src="<?=ROOT?>/images/Products/8888101611705.jpeg" alt="">
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>

        <div class="rightBody">
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
                <h1 id="bill-Total">0</h1>
            </div>
            <hr>

            <div class="row col-max-1024">
                <div class="product-img-container">
                    <img id="product-pic" class="product-img" src="<?=ROOT?>/images/Default/Product.jpeg" alt="">
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
                <a href="<?=LINKROOT?>/ShopOwner/home" class="btn placeOrderbtn" id="placeOrderBtn">Place Order</a>
            </div>
        </div>
    </div>
</div>

<script>
// Empty rows in the table
function emptyRows() {
    const billTable = document.getElementById('bill');
    for (let i = 0; i < 10; i++) {
        const newRow = billTable.insertRow();
        newRow.className = 'Item empty-row';
        newRow.innerHTML = `
            <td class="center-al"></td>
            <td class="left-al"></td>
            <td></td>
            <td></td>
            <td></td>
        `;
    }
}

// Add product to the table
document.getElementById('addBtn').addEventListener('click', function () {
    const productName = document.getElementById('product-name').value;
    const unitPrice = parseFloat(document.getElementById('unit-price').value) || 0;
    const quantity = parseFloat(document.getElementById('qty').value) || 0;

    // Ensure quantity is greater than 0
    if (!productName || !unitPrice || quantity <= 0) {
        alert('Please select a product and enter a quantity greater than 0.');
        return;
    }

    const total = unitPrice * quantity;
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
        const existingQuantity = parseFloat(existingRow.cells[3].textContent) || 0;
        const newQuantity = existingQuantity + quantity;
        const newTotal = newQuantity * unitPrice;

        existingRow.cells[3].textContent = newQuantity;
        existingRow.cells[4].textContent = newTotal.toFixed(2);

        billTotal.textContent = (currentTotal + quantity * unitPrice).toFixed(2);
    } else {
        // Find the first empty row
        let emptyRow = Array.from(billTable.rows).find(row => row.classList.contains('empty-row'));

        if (emptyRow) {
            emptyRow.classList.remove('empty-row');
            emptyRow.innerHTML = `
                <td class="center-al">${Array.from(billTable.rows).indexOf(emptyRow) + 1}</td>
                <td class="left-al">${productName}</td>
                <td>${unitPrice.toFixed(2)}</td>
                <td contenteditable="true" class="editable-quantity">${quantity}</td>
                <td>${total.toFixed(2)}</td>
            `;
        } else {
            const newRow = billTable.insertRow();
            newRow.className = 'Item';
            newRow.innerHTML = `
                <td class="center-al">${billTable.rows.length}</td>
                <td class="left-al">${productName}</td>
                <td>${unitPrice.toFixed(2)}</td>
                <td contenteditable="true" class="editable-quantity">${quantity}</td>
                <td>${total.toFixed(2)}</td>
            `;
        }

        billTotal.textContent = (currentTotal + total).toFixed(2);
    }

    // Clear input
    document.getElementById('product-name').value = '';
    document.getElementById('unit-price').value = '';
    document.getElementById('qty').value = '';
    document.getElementById('total').value = '';
});

// Allow user to edit quantity
document.getElementById('bill').addEventListener('input', function (event) {
    const target = event.target;

    if (target.classList.contains('editable-quantity')) {
        const row = target.parentElement;
        const unitPrice = parseFloat(row.cells[2].textContent) || 0;
        let quantity = parseFloat(target.textContent) || 0;

        // Ensure quantity is greater than 0
        if (quantity <= 0) {
            alert('Quantity must be greater than 0.');
            target.textContent = 1; // Reset to a minimum valid value
            quantity = 1;
        }

        // Update total in the row
        const newTotal = unitPrice * quantity;
        row.cells[4].textContent = newTotal.toFixed(2);

        // Update the overall bill total
        updateBillTotal();
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

// Select a row to highlight and enable deletion
document.getElementById('bill').addEventListener('click', function (event) {
    const row = event.target.closest('tr');

    if (row) {
        // Toggle row highlight
        Array.from(document.getElementById('bill').rows).forEach(r => r.classList.remove('selected'));
        row.classList.add('selected');
    }
});

// Remove selected row
document.getElementById('bill').addEventListener('keydown', function (event) {
    if (event.key === 'Delete') {
        const selectedRow = document.querySelector('.selected');

        if (selectedRow) {
            const rowTotal = parseFloat(selectedRow.cells[4].textContent) || 0;
            const billTotal = document.getElementById('bill-Total');
            const currentTotal = parseFloat(billTotal.textContent) || 0;

            // Update total bill
            billTotal.textContent = (currentTotal - rowTotal).toFixed(2);

            // Remove the row
            selectedRow.remove();

            // Re-index rows
            reindexRows();
        }
    }
});

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

emptyRows();

// Product card click event to populate product details
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', function () {
        // Get product details from the clicked card
        const productName = this.querySelector('h4:first-child').textContent;
        const unitPrice = parseFloat(this.querySelector('h4:last-child').textContent.replace('Rs.', '').trim());
        const productImgSrc = this.querySelector('.product-img').getAttribute('src'); // Get image source

        // Update the product name, unit price, and image
        document.getElementById('product-name').value = productName;
        document.getElementById('unit-price').value = unitPrice;
        document.getElementById('product-pic').setAttribute('src', productImgSrc); // Set the product image

        // Clear any previous quantity or total
        document.getElementById('qty').value = '';
        document.getElementById('total').value = '';
    });
});

// Handle quantity input to calculate the total price
document.getElementById('qty').addEventListener('input', function () {
    const unitPrice = parseFloat(document.getElementById('unit-price').value) || 0;
    let quantity = parseFloat(this.value) || 0;

    // Ensure quantity is greater than 0
    if (quantity <= 0) {
        alert('Quantity must be greater than 0.');
        this.value = 1; // Reset to a minimum valid value
        quantity = 1;
    }

    const total = unitPrice * quantity;

    // Update the total input
    document.getElementById('total').value = total.toFixed(2);
});

// Search bar functionality
document.querySelector('.search-bar').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase().trim();
    const cards = document.querySelectorAll('.salesagentproducts .card');

    cards.forEach(card => {
        const productName = card.querySelector('h4:first-child').textContent.toLowerCase();
        if (productName.includes(searchValue)) {
            card.style.display = ''; // Show the card
        } else {
            card.style.display = 'none'; // Hide the card
        }
    });
});

</script>


<?php $this->component("footer") ?>