import Notification from "../notification.js";

const del_notification = {
    type: 'preOrder',
    ref_id: pre_order_id
}

const reload_data_func = (type, ref_id) => {
    if(type === 'preOrder' && ref_id === pre_order_id) location.reload();
};

new Notification(reload_data_func, false, false, del_notification);

const statusElement = document.getElementById('status');
const changeStatusBtn = document.getElementById('changeStatusBtn');
const itemTickBoxes = document.querySelectorAll('.Item input');
const rejectBtn = document.getElementById('rejectBtn');
const updateBtn = document.getElementById('updateBtn');
const tip = document.getElementById('tip');

let nextStatus;

function btnClickEvent(){
    if (status === 'Ready'){
        viewPopUp('popUp');
        return;
    }
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
        localStorage.removeItem('processingPreOrder'+pre_order_id);
    }
    if(shouldBeUpdated){
        updateBtn.classList.remove('hidden');
        changeStatusBtn.classList.add('hidden');
        changeStatusBtn.removeEventListener('click', btnClickEvent);
        tip.innerHTML = "Some items in this order are out of stock. Click the update button to adjust the order quantity and wait for the customer's confirmation.";
        //  The adjustment will follow predefined settings, ensuring small quantities of these items remain available for other customers. This prevents future pre-order updates if other customers purchase the product while waiting for confirmation.
        // above text should go as a hover tip for the update button
    } else if (shouldBeRejected) {
        changeStatusBtn.classList.add('hidden');
        changeStatusBtn.removeEventListener('click', btnClickEvent);
        tip.innerHTML = "All the products in this order are out of stock. Reject or wait for new stock."
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
        case 'Canceled':
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
    itemTickBoxes.forEach(input => {
        input.classList.remove('hidden');
    });
    checkItemCheckBox();
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

    checkAllItemsTickBoxes();
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
                quantity: item.stock.quantity
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

const walletElem = document.getElementById('walletElem');
let change = -document.getElementById('total').value;
const changeElement = document.getElementById('change');
const walletUpdate = document.getElementById('wallet-update');
const returnToCus = document.getElementById('return-to-cus');
const cash = document.getElementById('cash')
// const cus_details = document.getElementById('cus-details');
const print = document.getElementById('print');
const skip = document.getElementById('skip');

const hw0 = document.querySelectorAll('.hw0');
const hwl = document.querySelectorAll('.hwl');
const hwg = document.querySelector('.hwg');

if(walletAmount < 0) {
    const bold = walletElem.querySelector('b');
    bold.classList.remove('green-text');
    bold.innerHTML = `Rs.(${walletAmount.toFixed(2)})`;
    bold.classList.add('red-text');
}

cash.addEventListener('input', function(e) {
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
    change = e.target.value - parseFloat(preOrderTotal.replace(/,/g, ''));
    
    if(change !== 0) {
        hw0.forEach(element => {
            element.classList.remove('hidden');
        });
        walletUpdate.disabled = false;
    } else {
        hw0.forEach(element => {
            element.classList.add('hidden');
        });
        walletUpdate.disabled = true;
    }

    if(change < 0) {
        changeElement.classList.remove('green-text');
        e.target.classList.remove('green-text');
        changeElement.classList.add('red-text');
        e.target.classList.add('red-text');
        walletUpdate.value = change;
        hwl.forEach(element => {
            element.classList.add('hidden');
        });
    } else {
        changeElement.classList.remove('red-text');
        e.target.classList.remove('red-text');
        changeElement.classList.add('green-text');
        e.target.classList.add('green-text');
        hwg.classList.add('hidden');
        walletUpdate.value = 0;
    }
    changeElement.value = change;
    document.getElementById('change-loyaltyBox').value = change;
    returnToCus.value =change;
});

returnToCus.addEventListener('input', function(e) {
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
    e.target.value = e.target.value > change ? change : e.target.value;
    walletUpdate.value = change - e.target.value;
});


function finalize(){
    fetch(`${LINKROOT}/ShopOwner/updateStatus`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'pre_order_id=' + pre_order_id + '&status=Picked&wallet_update=' + parseFloat(walletUpdate.value.replace(/,/g, ''))
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.success){
            status = "Picked";
            location.reload();
        }
        else
            alert('Failed to update order status');
    });
}

skip.addEventListener('click', function(e) {
    e.preventDefault();
    finalize();
});

print.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('bill-date').innerText = 'Date : ' + new Date().toLocaleDateString();
    document.getElementById('bill-time').innerText = 'Time : ' + new Date().toLocaleTimeString();
    window.print();
    finalize();
});