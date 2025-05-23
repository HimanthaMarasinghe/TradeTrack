import ApiFetcherMod from "../ApiFetcherMod.js";
import { stockCardTemplate } from '../UI_Elements_templates.js';
import Notification from "../notification.js";

const preOrderItems = [];
let selectedProduct = null;

const tbody = document.getElementById('bill');
const pImage = document.getElementById('product-pic');
const pName = document.getElementById('product-name');
const pPrice = document.getElementById('unit-price');
const pQTY = document.getElementById('qty');
const pTotal = document.getElementById('total');
const bTotal = document.getElementById('bill-Total');
const addButton = document.getElementById('addBtn');
const placeOrderBtn = document.getElementById('placeOrderBtn');

pQTY.addEventListener('input', () => {
    if (pQTY.value > selectedProduct.pre_orderable_stock) {
        alert(`You cannot order ${pQTY.value} items. Only ${selectedProduct.pre_orderable_stock} items are available for pre-order.`);
        pQTY.value = selectedProduct.pre_orderable_stock;
    }
    pTotal.value = (pQTY.value * pPrice.value).toFixed(2);

    if (pQTY.value > 0)
        addButton.classList.remove('disabled-link');
    else{
        addButton.classList.add('disabled-link');
        if(pQTY.value != '')
            alert('Please enter a positve quantity');
        pQTY.value = '';
    }
});

addButton.addEventListener('click', () => {
    if (pQTY.value <= 0)
        return;

    const index = preOrderItems.findIndex(item => item.barcode === selectedProduct.barcode);
    if (index !== -1) {
        preOrderItems[index].quantity = pQTY.value;
        const tr = document.getElementById('bill-row-'+selectedProduct.barcode);
        bTotal.innerText = (parseFloat(bTotal.innerText) - parseFloat(tr.children[4].innerText) + parseFloat(pTotal.value)).toFixed(2);
        tr.children[3].innerText = pQTY.value;
        tr.children[4].innerText = pTotal.value;
    }
    else{
        preOrderItems.push({
            barcode: selectedProduct.barcode,
            quantity: pQTY.value,
            unique: selectedProduct.unique
        });
        
        const tr = document.createElement('tr');
        tr.classList.add('Item');
        tr.id = 'bill-row-'+selectedProduct.barcode;
        tr.innerHTML = `
        <td class='center-al row_Number'></td>
        <td class='left-al'>${pName.value}</td>
        <td>${pPrice.value}</td>
        <td>${pQTY.value}</td>
        <td>${pTotal.value}</td>
        <td class='center-al'><img src='${ROOT}/images/icons/edit.svg' class='icon-btn'></td>
        <td class='center-al'><img src='${ROOT}/images/icons/delete.svg' class='icon-btn'></td>
        `;
        tbody.appendChild(tr);
        tr.children[5].addEventListener('click', ((product) => () => editItem(product))(selectedProduct));
        tr.children[6].addEventListener('click', ((barcode) => () => deleteItem(barcode))(selectedProduct.barcode));
        bTotal.innerText = (parseFloat(bTotal.innerText) + parseFloat(pTotal.value)).toFixed(2);
    }

    pImage.src = `${ROOT}/images/Default/Product.jpeg`
    pName.value = '';
    pPrice.value = '';
    pQTY.value = '';
    pTotal.value = '';
    addButton.classList.add('disabled-link');
    placeOrderBtn.classList.remove('disabled-link');
});

function editItem(product){
    selectedProduct = product;
    updateForm();
}

function deleteItem(barcode){
    const index = preOrderItems.findIndex(item => item.barcode === barcode);
    preOrderItems.splice(index, 1);

    const deleteRow =document.getElementById('bill-row-'+barcode);
    bTotal.innerText = (parseFloat(bTotal.innerText) - parseFloat(deleteRow.children[4].innerText)).toFixed(2);
    deleteRow.remove();

    updateRowNumbers();

    if (preOrderItems.length === 0)
        placeOrderBtn.classList.add('disabled-link');
}

function updateRowNumbers() {
    tbody.style.display = 'none';
    requestAnimationFrame(() => {
        tbody.style.display = '';
    });
}

function updateForm(){
    const {
        barcode,
        product_name,
        unit_price,
        pic_format,
        unique
    } =  selectedProduct;
    if(unique == 1) var imageSrc = `${ROOT}/images/Products/${shopPhone+barcode}.${pic_format}`;
    else var imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;
    pImage.src = imageSrc;
    pName.value = product_name;
    pPrice.value = unit_price.toFixed(2);

    const index = preOrderItems.findIndex(item => item.barcode === selectedProduct.barcode);
    if (index !== -1) {
        pQTY.value = preOrderItems[index].quantity;
        pTotal.value = (pQTY.value * pPrice.value).toFixed(2);
    }
    else{
        pQTY.value = '';
        pTotal.value = '';
    }
}

placeOrderBtn.addEventListener('click', () => {
    // console.log(preOrderItems);
    fetch(`${ROOT}/Customer/placePreOrderP/${shopPhone}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            preOrderItems: preOrderItems
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status === 'success'){
            alert('Pre-Order Placed Successfully');
            location.href = `${LINKROOT}/Customer/`;
        }
        else 
            alert('Failed to place Pre-Order');
    })
});

//********** ApiFetcherMod Configurations **********//

function addProductToBill(product) {
    selectedProduct = product;
    updateForm();
}

const getVariables = {
    search: '',
    preOrderable: 1,
    shop_phone: shopPhone
}

const stockApiConfig = {
    api: 'Customer/getStocks',
    cardTemplate: stockCardTemplate,
    getVariables: getVariables,
    clickEvent: addProductToBill
}

new ApiFetcherMod(stockApiConfig);
new Notification(false, true);