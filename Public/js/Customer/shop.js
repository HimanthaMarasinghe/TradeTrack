import ApiFetcherMod from '../ApiFetcherMod.js';
import { stockCardTemplate } from '../UI_Elements_templates.js';
import Notification from "../notification.js";
import billMoreDetails from "./Common.js";

const del_notificatoin = {type: 'loyaltyReq', ref_id: shopPhone};
new Notification(false, false, false, del_notificatoin);

const preOrderableCheckbox = document.getElementById('preOrderable');

document.getElementById('reqLoyalty')?.addEventListener('click', () => {
    fetch(LINKROOT + '/Customer/reqLoyalty', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'so_phone=' + encodeURIComponent(shopPhone)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        } else {
            alert('Request failed');
        }
    })
});

function rowTemplate(bill){
    const {
        bill_id,
        date,
        time,
        total
    } = bill;
    return `
        <tr class='Item clickable' id='${bill_id}'>
            <td class='center-al'>${bill_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td>Rs.${total.toFixed(2)}</td>
        </tr>
    `;
}


const billGetVariables = {
    shop_phone: shopPhone
}

const billApiConfig = {
    api: 'Customer/getBills',
    cardTemplate: rowTemplate,
    elementsListId: 'billTable',
    scrollDivId: 'billScroll',
    getVariables: billGetVariables,
    clickEvent: billMoreDetails
}

new ApiFetcherMod(billApiConfig);


const getVariables = {
    search: '',
    preOrderable: 0,
    shop_phone: shopPhone
}

function updateGetVariables() {
    getVariables.search = document.getElementById('stockSearchBar').value;
    getVariables.preOrderable = preOrderableCheckbox.checked ? 1 : 0;
}

const stockApiConfig = {
    api: 'Customer/getStocks',
    cardTemplate: stockCardTemplate,
    elementsListId: 'stockScroll',
    getVariables: getVariables,
    updateGetVariables: updateGetVariables,
    searchBarId: 'stockSearchBar',
    filterClass: '.stock-filter',
}

new ApiFetcherMod(stockApiConfig);