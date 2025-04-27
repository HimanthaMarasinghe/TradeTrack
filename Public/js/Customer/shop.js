import ApiFetcherMod from '../ApiFetcherMod.js';
import { stockCardTemplate } from '../UI_Elements_templates.js';
import Notification from "../Notification.js";
import billMoreDetails from "./Common.js";
import Chat from '../chat.js';

const del_notificatoin = {type: 'loyaltyReq', ref_id: shopPhone};
const notification = new Notification(false, false, false, del_notificatoin);
notification.deleteNotification({type: 'bill', ref_id: shopPhone});
if(loyalty) {
    new Chat(ws_id, shopPhone, notification, 'ShopOwner/customer/');
    const reject = document.getElementById('reject');
    reject?.addEventListener('click', () => {
        if(loyalty.wallet !== 0) {
            alert("The wallet balance is not zero. Please settle the balance with the shop Owner before rejecting loyalty privileges.");
            return;
        }
        if(!confirm("Are you sure you want to reject the loyalty privileges?")) return;
        fetch(LINKROOT+'/customer/rejectLoyalty', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'so_phone=' + encodeURIComponent(shopPhone)
        })
        .then(
            location.reload()
        )
        .catch(error => console.error('Error:', error));
    });
}

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
    so_phone: shopPhone
}

function billItemClick(bill){
    console.log(bill);
    notification.deleteNotification({type: 'bill', ref_id: String(bill.bill_id)});
    billMoreDetails(bill);
}

const billApiConfig = {
    api: 'LogedInUserCommon/searchBills',
    cardTemplate: rowTemplate,
    elementsListId: 'billTable',
    scrollDivId: 'billScroll',
    getVariables: billGetVariables,
    clickEvent: billItemClick
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