import Notification from "../Notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import billMoreDetails from "./Common.js";
import {orderMoreDetails} from "./Common.js"

new Notification();

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

function orderRow(order) {
    const { order_id, date, time, dis_busines_name, total} = order;
    return `
        <tr class='Item clickable' id='${order_id}'>
            <td class='center-al'>${order_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td class='left-al'>${dis_busines_name}</td>
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

const apiFetcherMod = new ApiFetcherMod(config);

const income = document.getElementById('income');
const expenses = document.getElementById('expenses');
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

document.getElementById('rec_expence').addEventListener('click', () => viewPopUp('expence'));
document.getElementById('rec_withdraw').addEventListener('click', () => viewPopUp('withdraw'));
document.getElementById('rec_cash_in').addEventListener('click', () => viewPopUp('cash_in'));