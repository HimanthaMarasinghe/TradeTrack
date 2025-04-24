import {orderMoreDetails} from "./Common.js"
import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";
import {newStockCardTemplate} from "../UI_Elements_templates.js"

// Order History

function rowTemplate(order){
    const {
        order_id,
        date,
        time,
        status,
        total
    } = order;
    return `
        <tr class='Item clickable' id='${order_id}'>
            <td class='center-al'>${order_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td class='center-al'>${status}</th>
            <td>Rs.${total.toFixed(2)}</th>
        </tr>
    `;
}

const order_state = document.getElementById('order-state');
const order_date = document.getElementById('order-date');

const orderGetVariables = {
    status : '',
    date : '',
    dis_phone : dis_phone
}

const orderConfig = {
    api: 'ShopOwner/getAllStockOrders',
    cardTemplate: rowTemplate,
    clickEvent: orderMoreDetails,
    elementsListId: 'billTable',
    scrollDivId: 'billScroll',
    getVariables: orderGetVariables,
    filterClass: '.filter-js-order',
    updateGetVariables: updateOrderGetVariables,
}

function updateOrderGetVariables() {
    orderGetVariables.status = order_state.value;
    orderGetVariables.date = order_date.value;
}

new ApiFetcherMod(orderConfig);

// Payment History

function paymentRow(payment){
    const {id, ammount, status, date, time} = payment;
    return `
        <tr class='Item'>
            <td class='center-al'>${id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td class='center-al'>${status == 1 ? '✔️' : ''}</td>
            <td>Rs.${Number(ammount).toFixed(2)}</td>
        </tr>
    `;
}

const payment_date = document.getElementById('pay-date');

const payGetVariables = {
    dis_phone: dis_phone,
    date: '',
}

function updatePayVariables() {
    payGetVariables.date = payment_date.value;
}

const paymentConfig = {
    api: 'ShopOwner/getDisPayments',
    cardTemplate: paymentRow,
    elementsListId: 'paymentTable',
    scrollDivId: 'paymentScroll',
    getVariables: payGetVariables,
    filterClass: '.filter-js-payment',
    updateGetVariables: updatePayVariables
}

const paymentApi = new ApiFetcherMod(paymentConfig);

// Available Products

const getVariables = {
    search: '',
    disPhone: dis_phone
}

const stockConfig = {
    api: 'ShopOwner/getNewStockDetails',
    cardTemplate: newStockCardTemplate,
    elementsListId: 'stockScroll',
    getVariables: getVariables,
    searchBarId: 'stockSearchBar',
}

new ApiFetcherMod(stockConfig);

document.getElementById('pay').addEventListener('click', () => viewPopUp('payPopUp'));

document.getElementById('payBtn').addEventListener('click', () => {
    const form = document.getElementById('payForm');
    if(form.reportValidity()){
        const formData = new FormData(form);
        fetch(LINKROOT + '/ShopOwner/payToDistributor', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Payment recorded Successfully");
                form.reset();
            } else {
                alert('An error occurred');
            }
            
            closePopUp();
            paymentApi.loadDataWithSearchOrFilter();
        })
    }
});

new Notification();

// Payment form

const payAmount = document.getElementById('payAmount');
const exp_from_cash_drawer = document.getElementById('exp_from_cash_drawer');

function setMaxAmount() {
    fetch(LINKROOT + '/ShopOwner/fetchChashDrawer')
    .then(res => res.json())
    .then(data => {
        payAmount.max = data.cashDrawer;
    })
}

setMaxAmount();

exp_from_cash_drawer.addEventListener('change', () => {
    if(exp_from_cash_drawer.checked) setMaxAmount();
    else payAmount.max = '';
})