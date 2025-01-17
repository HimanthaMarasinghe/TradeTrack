const offsetIncrement = 10;
const api = "ShopOwner/getAllPreOrders";

const getVariables = {
    search: ""
};

function cardTemplate(order) {
    return `
        <a class="card btn-card center-al alitem-center ${order.status}-preOrder" 
           href="${LINKROOT}/ShopOwner/preOrder/${order.pre_order_id}">
            <div class="profile-photo">
                <img src="${ROOT}/images/Profile/${order.cus_phone}.${order.pic_format}" 
                     alt="Profile Photo" 
                     onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            </div>
            <div class="details center-al">
                <h3>Order Id ${order.pre_order_id}</h3>
                <h4>${order.first_name} ${order.last_name}</h4>
                <h4>Rs.${order.total}</h4>
                <h4>${order.date_time} ago</h4>
                <h4 class="status">${order.status}</h4>
            </div>
        </a>
    `;
}

function updateGetVariables(){
    getVariables.search = searchBar.value;
}