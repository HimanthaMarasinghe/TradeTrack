import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";

const filter = document.getElementById('Filter');

function cardTemplate(order) {
    return `
        <a class="card btn-card center-al alitem-center ${order.status}-preOrder" 
           href="${LINKROOT}/Customer/preOrder/${order.pre_order_id}">
            <div class="profile-photo">
                <img src="${ROOT}/images/Shops/${order.so_phone+order.shop_pic_format}" 
                     alt="Profile Photo" 
                     onerror="this.src='${ROOT}/images/Shops/Default.jpeg'">
            </div>
            <div class="details center-al">
                <h3>Order Id ${order.pre_order_id}</h3>
                <h4>${order.shop_name}</h4>
                <h4>Rs.${order.total}</h4>
                <h4>${order.date_time}</h4>
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

const cofig = {
    api : "Customer/getAllPreOrders",
    cardTemplate : cardTemplate,
    getVariables : getVariables,
    updateGetVariables : updateGetVariables
}

const apiFetcherMod = new ApiFetcherMod(cofig);

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') apiFetcherMod.loadDataWithSearchOrFilter();
}

new Notification(loadDataOnNotification);