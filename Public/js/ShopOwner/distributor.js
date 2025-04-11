import {orderMoreDetails} from "./Common.js"
import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";
import {newStockCardTemplate} from "../UI_Elements_templates.js"

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
            <td>${total.toFixed(2)}</th>
        </tr>
    `;
}

const orderConfig = {
    api: 'ShopOwner/getAllStockOrders',
    cardTemplate: rowTemplate,
    clickEvent: orderMoreDetails,
    elementsListId: 'billTable',
    scrollDivId: 'billScroll',
    getVariables: {dis_phone: dis_phone}
}

new ApiFetcherMod(orderConfig);

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
                const tr = document.getElementById('creditTR');
                if(data.new > 0) {
                    tr.innerHTML = `<td><h2>Credit</h2></td>
                                    <td><h2>Rs.${data.new.toFixed(2)}</h2></td>`;
                }else{
                    tr.innerHTML = `<td><h2>Debt</td></h2>
                                    <td><h2>Rs.${(-1*data.new).toFixed(2)}</h2></td>`;
                }
            } else {
                alert('An error occurred');
            }
            
            closePopUp();
            return fetch(`${LINKROOT}/ShopOwner/fetchChashDrawer`);
        })
    }
});

new Notification();