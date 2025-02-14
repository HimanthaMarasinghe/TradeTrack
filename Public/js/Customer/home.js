import Notification from "../Notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import billMoreDetails from "./Common.js";

function swap(e){
    if(e.target.classList.contains('closed-grid') || e.target.parentElement.classList.contains('closed-grid') || e.target.parentElement.parentElement.classList.contains('closed-grid')){
        document.getElementById('pre-orders').classList.toggle('closed-grid');
        document.getElementById('new-lc-req').classList.toggle('closed-grid');
    }
}

document.getElementById('pre-orders').addEventListener('click', swap);
document.getElementById('new-lc-req').addEventListener('click', swap);

// Pre Orders
function preOrderCard(order) {
    const {status, pre_order_id, so_phone, shop_name, shop_pic_format, date_time, total} = order;
    return `
        <a class="card btn-card center-al alitem-center ${status}-preOrder" 
           href="${LINKROOT}/Customer/preOrder/${pre_order_id}">
            <div class="profile-photo">
                <img src="${ROOT}/images/Shops/${so_phone+shop_pic_format}" 
                     alt="Profile Photo" 
                     onerror="this.src='${ROOT}/images/Shops/Default.jpeg'">
            </div>
            <div class="details center-al">
                <h3>Order Id ${pre_order_id}</h3>
                <h4>${shop_name}</h4>
                <h4>Rs.${total}</h4>
                <h4>${date_time}</h4>
                <h4 class="status">${status}</h4>
            </div>
        </a>
    `;
}

const poApiFetcherConfig = {
    api : "Customer/getAllPreOrders",
    cardTemplate : preOrderCard,
}

const poApiFetcherMod = new ApiFetcherMod(poApiFetcherConfig);

// Bills
function billRow(bill) {
    const { bill_id, date, time, total, shop_name} = bill;
    return `
        <tr class='Item clickable' id='${bill_id}'>
            <td class='center-al'>${bill_id}</td>
            <td class='left-al'>${shop_name}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td>Rs.${total.toFixed(2)}</td>
        </tr>
    `;
}

const getVariables = {
    search: '',
    date: ''
}

function updateGetVariables(){
    getVariables.search = document.getElementById('bill-searchBar').value;
    getVariables.date = document.getElementById('bill_Date').value;
}

const billApiConfig = {
    api: 'LogedInUserCommon/searchBills',
    cardTemplate: billRow,
    getVariables: getVariables,
    updateGetVariables: updateGetVariables,
    searchBarId: "bill-searchBar",
    filterClass: '.filter-js-bill',
    elementsListId: 'billTbody',
    scrollDivId: 'billScroll',
    clickEvent: billMoreDetails
}

const billApiFetcheMod = new ApiFetcherMod(billApiConfig);

// Loyalty Requests
function loyaltyCustomerReqCard(request) {
    const {
        so_phone,
        shop_pic_format,
        shop_name,
        created_time
    } = request;

    const profileImage = `${ROOT}/images/Shops/${so_phone+shop_pic_format}`;
    const defaultImage = `${ROOT}/images/Shops/default.jpeg`;

    return `
        <a href="${LINKROOT}/Customer/shop/${so_phone}" class="card gap-10">
            <div class="profile-photo">
                <img src="${profileImage}" alt="" onerror="this.src='${defaultImage}'">
            </div>
            <div class="m-b-auto fg1">
                <h3>${shop_name}</h3>
                <h4>${so_phone}</h4>
                <br>
                <h6>Request Created Time -</h6>
                <h5>${created_time}</h5>
            </div>
        </a>
    `;
}

const lcrApiFetcherConfig = {
    api: "Customer/getLoyaltyReqs",
    cardTemplate: loyaltyCustomerReqCard,
    elementsListId: "lcr-Scroll-Div"
}

const lcrApiFetcherMod = new ApiFetcherMod(lcrApiFetcherConfig);

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') poApiFetcherMod.loadDataWithSearchOrFilter();
    if(type == 'loyaltyReq') lcrApiFetcherMod.loadDataWithSearchOrFilter();
    if(type == 'bill') billApiFetcheMod.loadDataWithSearchOrFilter();
}

new Notification(loadDataOnNotification, false, false, false, true);