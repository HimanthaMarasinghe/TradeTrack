import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";
import {orderMoreDetails} from "./Common.js"

const filter = document.getElementById('Filter');

function cardTemplate(order) {
    return `
        <a class="card btn-card center-al alitem-center ${order.status}-preOrder">
            <h3 class="badge">Order Id ${order.order_id}</h3>
            <div class="profile-photo">
                <img src="${ROOT}/images/Profile/${order.dis_phone}.${order.pic_format}" 
                     alt="Profile Photo" 
                     onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            </div>
            <div class="details center-al">
                <h2>${order.dis_busines_name}</h2>
                <h4>${order.full_name}</h4>
                <h4>${order.date} ${order.time}</h4>
                <h4 class="status">${order.status}</h4>
            </div>
        </a>
    `;
}

const getVariables = {
    search: "",
    status: ""
};

function updateGetVariables() {
    this.getVariables.search = searchBar.value;
    this.getVariables.status = filter.value;
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