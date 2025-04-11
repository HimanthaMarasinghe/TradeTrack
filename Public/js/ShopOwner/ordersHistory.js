import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";
import {orderMoreDetails} from "./Common.js"

const filter = document.getElementById('Filter');
const orderDate = document.getElementById('order_Date');

function cardTemplate(order) {
    if(order.status == 'Delivered') order.status = 'Received';
    return `
        <a class="card btn-card alitem-center ${order.status}-preOrder">
            <h3 class="badge">Order Id ${order.order_id}</h3>
            <div class="details">
                <h2>Rs.${order.total.toFixed(2)}</h2>
                <h2 class="status">${order.status}</h2>
                <h3>${order.dis_busines_name ?? 'Unregisterd'}</h3>
                <h5>${order.full_name ?? ' - '}</h5>
                <h5>${order.date} ${order.time}</h5>
            </div>
        </a>
    `;
}

const getVariables = {
    search: "",
    status: "",
    date: ""
};

function updateGetVariables() {
    this.getVariables.search = searchBar.value;
    this.getVariables.status = filter.value;
    this.getVariables.date = orderDate.value;
}

const config = {
    api : "ShopOwner/getAllStockOrders",
    cardTemplate : cardTemplate,
    getVariables : getVariables,
    updateGetVariables : updateGetVariables,
    clickEvent: orderMoreDetails
}

const apiFetcherMod = new ApiFetcherMod(config);

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') apiFetcherMod.loadDataWithSearchOrFilter();
}

new Notification(loadDataOnNotification);