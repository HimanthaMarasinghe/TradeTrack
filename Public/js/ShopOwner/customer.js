import Notification from "../Notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import billMoreDetails from "./Common.js";
import Chat from '../chat.js';

const notification = new Notification();

if(loyalty){
    new Chat(ws_id, loy_phone, notification, 'Customer/shop/');
    const revoke_btn = document.getElementById('revoke_btn');
    if(revoke_btn != null){
        revoke_btn.addEventListener('click', function(){
            if(wallet_amount != 0) {
                alert("The customer's wallet balance is not zero. Please settle the balance with the customer before revoking their loyalty privileges.");
                return;
            }
            fetch(LINKROOT+'/ShopOwner/revokeLoyalty', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'loy_phone=' + encodeURIComponent(loy_phone)
            })
            .then(
                location.reload()
            )
            .catch(error => console.error('Error:', error));
        });
    }
}

function billRow(bill) {
    const { bill_id, date, time, total} = bill;
    return `
        <tr class='Item clickable' id='${bill_id}'>
            <td class='center-al'>${bill_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td>Rs.${total.toFixed(2)}</td>
        </tr>
    `;
}

const getVariables = {
    cus_phone: loy_phone,
    date: ''
}

function updateGetVariables(){
    getVariables.date = document.getElementById('bill_Date').value;
}

const billApiConfig = {
    api: 'LogedInUserCommon/searchBills',
    cardTemplate: billRow,
    getVariables: getVariables,
    updateGetVariables: updateGetVariables,
    elementsListId: 'billTbody',
    scrollDivId: 'billScroll',
    clickEvent: billMoreDetails
}

new ApiFetcherMod(billApiConfig);