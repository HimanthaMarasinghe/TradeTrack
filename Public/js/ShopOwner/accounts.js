import Notification from "../Notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import billMoreDetails from "./Common.js";
import {orderMoreDetails} from "./Common.js"

new Notification();

// bill

function billRow(bill) {
    const { bill_id, date, time, total, first_name, last_name} = bill;
    const full_name = first_name ? `${first_name} ${last_name}` : 'Unregisterd';
    return `
        <tr class='Item clickable' id='${bill_id}'>
            <td class='center-al'>${bill_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td class='left-al'>${full_name}</td>
            <td>Rs.${total.toFixed(2)}</td>
        </tr>
    `;
}

const getVariables = {
    search: '',
    date: ''
}

function updateGetVariables(){
    getVariables.search = document.getElementById('bill-searchBar').value;
    getVariables.date = document.getElementById('bill_Date').value;
}

const billApiConfig = {
    api: 'LogedInUserCommon/searchBills',
    cardTemplate: billRow,
    getVariables: getVariables,
    updateGetVariables: updateGetVariables,
    searchBarId: "bill-searchBar",
    filterClass: '.filter-js-bill',
    elementsListId: 'billTbody',
    scrollDivId: 'billScroll',
    clickEvent: billMoreDetails
}

new ApiFetcherMod(billApiConfig);

// orders

function orderRow(order) {
    const { order_id, date, time, dis_busines_name, total} = order;
    return `
        <tr class='Item clickable' id='${order_id}'>
            <td class='center-al'>${order_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td class='left-al'>${dis_busines_name ?? '-'}</td>
            <td>Rs.${total.toFixed(2)}</td>
        </tr>
    `;
}

const orderGetVariables = {
    search: "",
    date: "",
    status: "Delivered"
    // status: "all"
};

function updateOrderGetVariables() {
    orderGetVariables.search = document.getElementById('order-searchBar').value;
    orderGetVariables.date = document.getElementById('order_Date').value;
}

const config = {
    api : "ShopOwner/getAllStockOrders",
    cardTemplate : orderRow,
    getVariables : orderGetVariables,
    updateGetVariables : updateOrderGetVariables,
    searchBarId: "order-searchBar",
    filterClass: '.filter-js-order',
    elementsListId: 'orderTbody',
    scrollDivId: 'orderScroll',
    clickEvent: orderMoreDetails
}

new ApiFetcherMod(config);

// Cash Drawer Flow

function cashFlowRow(flow){
    const {date, time, type, amount} = flow;
    return `
        <tr class='Item'>
            <td class='center-al'>${date}</td>
            <td class='center-al'>${time}</td>
            <td class='left-al'>${type}</td>
            <td>Rs.${amount.toFixed(2)}</td>
        </tr>
    `;
}

const cashFlowGetVariables = {
    date: ''
}

function updateCashFlowGetVariables() {
    cashFlowGetVariables.date = document.getElementById('cash-add_Date').value;
}

const cashFlowConfig = {
    api : "ShopOwner/getAllCashFlows",
    cardTemplate : cashFlowRow,
    getVariables : cashFlowGetVariables,
    updateGetVariables : updateCashFlowGetVariables,
    searchBarId: "cash-add-searchBar",
    filterClass: '.filter-js-cash-add',
    elementsListId: 'cash-add-Tbody',
    scrollDivId: 'cash-add-scroll'
}

const cashFlow = new ApiFetcherMod(cashFlowConfig);

// Other Expences

function expenceRow(expence){
    const {date, time, cashDrawer, type, amount} = expence;
    return `
        <tr class='Item'>
            <td class='center-al'>${date}</td>
            <td class='center-al'>${time}</td>
            <td class='center-al'>${cashDrawer == 1 ? "✔" : ""}</td>
            <td class='left-al'>${type}</td>
            <td>Rs.${amount.toFixed(2)}</td>
        </tr>
    `;
}

const expenceGetVariables = {
    date: '',
    type: ''
}

function updateExpenceGetVariables() {
    expenceGetVariables.date = document.getElementById('expences_Date').value;
    expenceGetVariables.type = document.getElementById('expence-type').value;
}

const expenceConfig = {
    api : "ShopOwner/getAllExpences",
    cardTemplate : expenceRow,
    getVariables : expenceGetVariables,
    updateGetVariables : updateExpenceGetVariables,
    searchBarId: "expences-searchBar",
    filterClass: '.filter-js-expences',
    elementsListId: 'expencesTbody',
    scrollDivId: 'expenceScroll'
}

const expence = new ApiFetcherMod(expenceConfig);

const income = document.getElementById('income');
const expenses = document.getElementById('expenses');
const profit = document.getElementById('profit');
const pre_Mo = document.getElementById('pre_Mo');
const next_Mo = document.getElementById('next_Mo');
const monthYear = document.getElementById('monthYear');
const monthInput = document.getElementById('monthInput');
const downArrow = document.getElementById('down');

const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

const thisMonth = new Date().getMonth() + 1; // Months are 0-indexed in JS
const thisYear = new Date().getFullYear();

let month = thisMonth;
let year = thisYear;

function FetchMonthlyData() {
    monthYear.innerText = `${monthNames[month - 1]} ${year}`;
    fetch(`${LINKROOT}/ShopOwner/accountsForMonth/${month}/${year}`)
        .then(response => response.json())
        .then(data => {
            if (data) {
                income.innerText = `Rs.${data.income.toFixed(2)}`;
                expenses.innerText = `Rs.${data.expenses.toFixed(2)}`;
                profit.innerText = `Rs.${data.profit.toFixed(2)}`
            }
            else {
                income.innerText = '0.00';
                expenses.innerText = '0.00';
                alert('Error: No data found for this month.');
            }
        })
}

FetchMonthlyData();

downArrow.addEventListener('click', () => {
    monthInput.showPicker();
})

monthInput.addEventListener('change', () => {
    if (monthInput.value === '') return;
    const selectedDate = new Date(monthInput.value);
    month = selectedDate.getMonth() + 1; // Months are 0-indexed in JS
    year = selectedDate.getFullYear();
    FetchMonthlyData();
})

pre_Mo.addEventListener('click', () => {
    month--;
    if (month < 1) {
        month = 12;
        year--;
    }
    monthInput.value = null;
    FetchMonthlyData();
})

next_Mo.addEventListener('click', () => {
    if(month === thisMonth && year === thisYear) {
        return;
    }
    month++;
    if (month > 12) {
        month = 1;
        year++;
    }
    monthInput.value = null;
    FetchMonthlyData();
})

function openForm(form) {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');
    document.querySelectorAll('input[type="date"].userInput').forEach(input => {
        input.value = now.toISOString().split('T')[0];
    });
    document.querySelectorAll('input[type="time"].userInput').forEach(input => {
        input.value = `${hours}:${minutes}`;
    });
    viewPopUp(form);
}

document.getElementById('rec_expence').addEventListener('click', () => openForm('expence'));
document.getElementById('rec_withdraw').addEventListener('click', () => openForm('withdraw'));
document.getElementById('rec_cash_in').addEventListener('click', () => openForm('cash_in'));

function submitForm(form_id, api, message, refresh) {
    const form = document.getElementById(form_id);
    if (form.reportValidity()) {
        const formData = new FormData(form);
        fetch(`${LINKROOT}/ShopOwner/${api}`, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(message);
                form.reset();
            } else {
                alert('An error occurred');
            }
            
            closePopUp();
            return fetch(`${LINKROOT}/ShopOwner/fetchChashDrawer`);
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('cash_drawer').innerText = `Rs.${data.cashDrawer.toFixed(2)}`;
            if (refresh) {
                refresh();
            }
        });
    }
}

document.getElementById('record_expence').addEventListener('click', () => submitForm('expence_form', 'recordExpence', 'Expence recorded successfully!', expence.loadDataWithSearchOrFilter.bind(expence)));
document.getElementById('record_withdrwal').addEventListener('click', () => submitForm('withdraw_form', 'recordCashFlow', 'Withdraw recorded successfully!', cashFlow.loadDataWithSearchOrFilter.bind(cashFlow)));
document.getElementById('record_cash_in').addEventListener('click', () => submitForm('cash_in_form', 'recordCashFlow', 'Cash in recorded successfully!', cashFlow.loadDataWithSearchOrFilter.bind(cashFlow)));