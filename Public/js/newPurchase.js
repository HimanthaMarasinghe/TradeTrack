import Notification from "./notification.js";
new Notification(false, true);

const qtyElement = document.getElementById('qty');
const barCodeElement = document.getElementById('barCode');
const billElement = document.getElementById('bill');
const product_name = document.getElementById('product-name');
const unit_price = document.getElementById('unit-price');
const product_pic = document.getElementById('product-pic');
const itemTotal = document.getElementById('total');
const billTotalElem = document.getElementById('bill-Total');
const cashPayBtn = document.getElementById('cashPayBtn');
const addBtn = document.getElementById("addBtn");

let validBill = false; //set to true when at least one item is in the bill.
const bill = [];
let newItem = {};

barCodeElement.addEventListener('input', async function (e) {
    newItem = {};
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;    
    
    product_name.value = '';
    unit_price.value = '';
    product_pic.src = ROOT+'/images/Default/Product.jpeg';
    qtyElement.value = '';
    itemTotal.value = '';

    if (e.target.value.length > 13) {
        e.target.value = e.target.value.substring(13);
    }

    if (e.target.value.length === 13) {
        const index = bill.findIndex((element) => element.barcode === e.target.value);
        if (index !== -1) newItem = { ...bill[index] };
        else {
            console.log('Fetching new data from DB...');
            await fetch(LINKROOT+'/ShopOwner/getProduct', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'barcodeIn=' + encodeURIComponent(e.target.value)
            })
            .then(response => response.json())
            .then(data => {
                
                newItem = {
                    barcode: data.barcode,
                    name: data.product_name,
                    price: data.unit_price,
                    pic_format: data.pic_format
                };
            })
            .catch(error => console.error('Error:', error));
        }
        product_name.value = newItem.name;
        unit_price.value = parseFloat(newItem.price).toFixed(2);
        product_pic.src = ROOT+'/images/Products/' + newItem.barcode + '.' + newItem.pic_format;
        qtyElement.focus();
    }
});

qtyElement.addEventListener('input', function (e) {
    let value = parseFloat(e.target.value) || 0;
    if (value < 0) e.target.value = Math.abs(value);
    itemTotal.value = parseFloat(Math.abs(value) * newItem.price).toFixed(2);
});

unit_price.addEventListener('input', function (e) {
    let value = parseFloat(e.target.value) || 0;
    if (value < 0) e.target.value = Math.abs(value);
    itemTotal.value = parseFloat(Math.abs(value) * qtyElement.value).toFixed(2);
});

function addItemToBill() {
    if (barCodeElement.value === '' || product_name.value === '' || unit_price.value === '') {
        barCodeElement.focus();
        return;
    }

    if (qtyElement.value === '') {
        qtyElement.value = 1;
    }

    if (parseFloat(qtyElement.value) <= 0) qtyElement.value = 1;
    if (parseFloat(unit_price.value) <= 0) unit_price.value = 1;
    
    const index = bill.findIndex((element) => element.barcode === newItem.barcode);
    
    if (index !== -1 && bill[index].price === parseFloat(unit_price.value)) {
        bill[index].qty += parseFloat(qtyElement.value);
    } else {
        newItem.price = parseFloat(unit_price.value);
        newItem.qty = parseFloat(qtyElement.value);
        bill.push(newItem);
    }

    newItem = {};

    updateBill();

    barCodeElement.value = '';
    product_name.value = '';
    unit_price.value = '';
    qtyElement.value = '';
    itemTotal.value = '';
    product_pic.src = ROOT+'/images/Default/Product.jpeg';

    barCodeElement.focus();
}

function editQty(barCode, price) {
    const qtyCell = document.getElementById('bill-row-'+barCode+'-price-'+price).children[4];
    const curentValue = parseFloat(qtyCell.innerText);
    const editTextField = document.createElement('input');
    editTextField.type = "number";
    editTextField.classList.add('userInput', 'short');
    editTextField.value = curentValue;
    editTextField.addEventListener('input', function(e) {
        if (e.target.value < 0) e.target.value = 0;
    });
    editTextField.addEventListener('blur', function (e) {
        let newValue = parseFloat(e.target.value);
        if (newValue !== curentValue) {
            if (newValue < 0 || !newValue) newValue = 1;
            const index = bill.findIndex((element) => element.barcode === barCode && element.price === price);
            bill[index].qty = newValue;
        }
        updateBill();
    });
    qtyCell.innerHTML = '';
    qtyCell.appendChild(editTextField);
    editTextField.focus();
}

function editPrice(barCode, price) {
    const priceCell = document.getElementById('bill-row-'+barCode+'-price-'+price).children[2];
    const editTextField = document.createElement('input');
    editTextField.type = "number";
    editTextField.classList.add('userInput', 'short');
    editTextField.value = price;
    editTextField.addEventListener('input', function(e) {
        if (e.target.value < 0) e.target.value = 0;
    });
    editTextField.addEventListener('blur', function (e) {
        let newValue = parseFloat(e.target.value);
        if (newValue !== price) {
            if (newValue < 0 || !newValue) newValue = 1;
            const indexWithNewPrice = bill.findIndex((element) => element.barcode === barCode && element.price === newValue); // If there is another row with given price this will return it's index.
            const indexWithOldPrice = bill.findIndex((element) => element.barcode === barCode && element.price === price);
            if (indexWithNewPrice !== -1) {
                bill[indexWithNewPrice].qty += bill[indexWithOldPrice].qty;
                bill.splice(indexWithOldPrice, 1);
            }
            else bill[indexWithOldPrice].price = newValue;
        }
        updateBill();
    });
    priceCell.innerHTML = '';
    priceCell.appendChild(editTextField);
    editTextField.focus();
}

function deleteItem(barcode, price) {
    const index = bill.findIndex((element) => element.barcode === barcode && element.price === price);
    bill.splice(index, 1);
    updateBill();
}

function updateBill() {
    let billTotal = 0;
    billElement.innerHTML = '';
    bill.forEach((element) => {
        const itemTotal = parseFloat(element.qty*element.price);
        const tr = document.createElement('tr');
        tr.classList.add('Item');
        tr.id = 'bill-row-'+element.barcode+'-price-'+element.price;
        tr.innerHTML += `<td class='center-al row_Number'></td>
                         <td class='left-al'>${element.name}</td>
                         <td>Rs.${element.price.toFixed(2)}</td>
                         <td class='left-al'><img src='${ROOT}/images/icons/edit.svg' class='icon-btn'></td>
                         <td>${element.qty}</td>
                         <td class='left-al'><img src='${ROOT}/images/icons/edit.svg' class='icon-btn'></td>
                         <td>Rs.${itemTotal.toFixed(2)}</td>
                         <td class='center-al'><img src='${ROOT}/images/icons/delete.svg' class='icon-btn'></td>
                        `;
        billElement.appendChild(tr);   
        tr.children[3].addEventListener('click', ((barcode, price) => () => editPrice(barcode, price))(element.barcode, element.price));
        tr.children[5].addEventListener('click', ((barcode, price) => () => editQty(barcode, price))(element.barcode, element.price));
        tr.children[7].addEventListener('click', ((barcode, price) => () => deleteItem(barcode, price))(element.barcode, element.price));
        billTotal += itemTotal;
    });
    billTotalElem.innerText = 'Rs.'+billTotal.toFixed(2);
    if (bill.length > 0) {
        validBill = true;
        cashPayBtn.classList.remove('disabled-link');
    }
    else {
        validBill = false;
        cashPayBtn.classList.add('disabled-link');
    }
}

function cashPay() {
    if (!validBill) return;

    bill.forEach((element) => {
        delete element.name;
        delete element.pic_format;
    });

    fetch(LINKROOT+'/ShopOwner/addBillItemsToSession', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(bill)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            window.location.href = LINKROOT+'/ShopOwner/billSettle';
        } else {
            console.log(data);
        }
    })
    .catch(error => console.error('Error:', error));
}

addBtn.addEventListener('click', addItemToBill);
cashPayBtn.addEventListener('click', cashPay);

document.addEventListener('keydown', function(event) {
    if (event.key === '+') {
        addItemToBill();
    }
    if (event.key === 'Enter' && validBill) {
        cashPay();
    }
    if (event.key === 'q') {
        console.log('newItem : ',newItem);
        console.log('bill : ',bill);
    }
});
