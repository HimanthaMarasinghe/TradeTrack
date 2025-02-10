import ApiFetcherMod from '../ApiFetcherMod.js';
import { stockCardTemplate } from '../UI_Elements_templates.js';
import Notification from "../notification.js";
new Notification();

const itemsList = document.getElementById('billDetailsItems');
const preOrderableCheckbox = document.getElementById('preOrderable');

function billMoreDetails(dataset){
    const {
        bill_id,
        date,
        time
    } = dataset;
    console.log(LINKROOT + '/Customer/getBillDetails/' + bill_id);
    fetch(LINKROOT + '/Customer/getBillDetails/' + bill_id)
    .then(res => res.json())
    .then(data => {
        if(data){
            const {
                total,
                billItems
            } = data;
            document.getElementById('More-details-bill-id').innerText = " - " + bill_id;
            document.getElementById('More-details-bill-date').innerText = " - " + date;
            document.getElementById('More-details-bill-time').innerText = " - " + time;
            document.getElementById('More-details-bill-total').innerText = 'Rs.' + total.toFixed(2);
            itemsList.innerHTML = '';
            billItems.forEach(item => {
                const {
                    barcode,
                    product_name,
                    quantity,
                    unit_price
                } = item;
                let rowTotal = quantity * unit_price;
                itemsList.innerHTML += `
                    <tr calss='Item'>
                        <td class='center-al'>${barcode}</td>
                        <td class='left-al'>${product_name}</td>
                        <td class='center-al'>${quantity}</td>
                        <td>Rs.${unit_price.toFixed(2)}</td>
                        <td>Rs.${rowTotal.toFixed(2)}</td>
                    </tr>
                `;
            });
            viewPopUp('BillDetails');
        } else {
            alert('Failed to get bill details');
        }
    }); 
}

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

const stockApiConfig = {
    api: 'Customer/getStocks',
    cardTemplate: stockCardTemplate,
    elementsListId: 'stockScroll',
    getVariables: getVariables,
    searchBarId: 'stockSearchBar'
}

new ApiFetcherMod(stockApiConfig);