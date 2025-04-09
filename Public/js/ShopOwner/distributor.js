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