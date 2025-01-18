const statusElement = document.getElementById('status');
const changeStatusBtn = document.getElementById('changeStatusBtn');
const itemTickBoxes = document.querySelectorAll('.Item input');
const rejectBtn = document.getElementById('rejectBtn');
const updateBtn = document.getElementById('updateBtn');
const tip = document.getElementById('tip');

let nextStatus;

function btnClickEvent(){
    fetch(`${LINKROOT}/ShopOwner/updateStatus`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'pre_order_id=' + pre_order_id + '&status=' + nextStatus
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.success){
            status = nextStatus;
            updateUI();
        }
        else
            alert('Failed to update order status');
    });
}


function updateUI(){
    tip.innerHTML = '';
    if(status !== 'Processing'){
        itemTickBoxes.forEach(input => {
            input.classList.add('hidden');
        });
    }
    if(shouldBeUpdated){
        updateBtn.classList.remove('hidden');
        changeStatusBtn.classList.add('hidden');
        changeStatusBtn.removeEventListener('click', btnClickEvent);
        tip.innerHTML = "Some items in this order are out of stock. Click the update button to adjust the order quantity and wait for the customer's confirmation.";
        //  The adjustment will follow predefined settings, ensuring small quantities of these items remain available for other customers. This prevents future pre-order updates if other customers purchase the product while waiting for confirmation.
        // above text should go as a hover tip for the update button
    }

    switch (status) {
        case 'Pending':
            nextStatus = 'Processing';
            break;
        case 'Processing':
            startProcessingPreOrder();
            nextStatus = 'Ready';
            break;
        case 'Ready':
            rejectBtn.classList.add('hidden');
            hideInStockColoumn();
            nextStatus = 'Picked';
            break;
        case 'Updated':
            tip.innerHTML = 'The order has been updated by the shop owner. Waiting for the customer to confirm the changes.';
            nextStatus = '';
            hideInStockColoumn();
            changeStatusBtn.removeEventListener('click', btnClickEvent);
            changeStatusBtn.classList.add('hidden');
            rejectBtn.classList.add('hidden');
            break;
        case 'Picked':
        case 'Rejected':
            updateBtn.classList.add('hidden');
            nextStatus = '';
            hideInStockColoumn();
            changeStatusBtn.removeEventListener('click', btnClickEvent);
            changeStatusBtn.classList.add('hidden');
            rejectBtn.classList.add('hidden');
            break;
    }
    changeStatusBtn.innerHTML = "Set order status to " + nextStatus;
    statusElement.innerHTML = '- ' + status;
}

function hideInStockColoumn(){
    const columnTitle = 'In Stock'; // The column title to find
    const table = document.getElementById('preOrderItemsTable'); // The table to search
    const headerCells = table.querySelectorAll('thead tr th');

    // Find the index of the column with the given title
    let columnIndex = -1;
    headerCells.forEach((header, index) => {
        if (header.textContent.trim() === columnTitle) {
            columnIndex = index;
        }
    });

    if (columnIndex === -1) {
        console.error(`Column titled "${columnTitle}" not found.`);
        return;
    }

    // Hide the column in the header
    headerCells[columnIndex].style.display = 'none';

    // Hide the column in the body
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
        row.classList.remove('red-text');
        const cells = row.querySelectorAll('td');
        if (cells[columnIndex]) {
            cells[columnIndex].style.display = 'none';
        }
    });
}

function startProcessingPreOrder(){
    changeStatusBtn.classList.add('disabled-link');
    // changeStatusBtn.href = `${LINKROOT}/ShopOwner/orderReady/${pre_order_id}`;
    itemTickBoxes.forEach(input => {
        input.classList.remove('hidden');
        input.addEventListener('change', checkAllItemsTickBoxes);
    });
}

function checkAllItemsTickBoxes(){
    let allChecked = true;
    itemTickBoxes.forEach(input => {
        if (!input.checked)
            allChecked = false;
    });
    if (allChecked)
        changeStatusBtn.classList.remove('disabled-link');
    else
        changeStatusBtn.classList.add('disabled-link');
}

function checkItemCheckBox(){
    const itemCheckBoxesState = JSON.parse(localStorage.getItem('processingPreOrder'+pre_order_id)) || {};

    itemTickBoxes.forEach((input) => {
        const checkBoxId = input.id;
        input.checked = itemCheckBoxesState[checkBoxId] || false;
        input.addEventListener('change', () => {
            itemCheckBoxesState[checkBoxId] = input.checked;
            localStorage.setItem('processingPreOrder'+pre_order_id, JSON.stringify(itemCheckBoxesState));
            checkAllItemsTickBoxes();
        });
    });
}

rejectBtn.addEventListener('click', async () => {
    nextStatus = 'Rejected';
    shouldBeUpdated = false;
    btnClickEvent();
});


updateBtn.addEventListener('click', () => {
    const newPreOrderItems = [];
    preOrderItems.forEach((item) => {
        if(item.quantity > item.stock.quantity){
            newPreOrderItems.push({
                barcode: item.barcode,
                quantity: item.stock.quantity - item.stock.non_preorderable_stock 
            });
        }
    });
    console.log(newPreOrderItems);
    fetch(`${LINKROOT}/ShopOwner/updatePreOrder/`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `pre_order_id=${pre_order_id}&newPreOrderItems=${encodeURIComponent(JSON.stringify(newPreOrderItems))}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success){
            location.reload();
        }
        else
            alert('Failed to update order status');
    });
})

document.addEventListener('DOMContentLoaded', () => {
    updateUI();
    if(status !== 'Picked'){
        changeStatusBtn.addEventListener('click', btnClickEvent);
    }
    if (status === 'Processing'){
        startProcessingPreOrder();
        checkItemCheckBox();
    }
});