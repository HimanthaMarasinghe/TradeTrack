import Notification from "../Notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import billMoreDetails from "./Common.js";

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