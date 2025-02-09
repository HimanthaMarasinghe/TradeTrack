import Notification from "../notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import { preOrderCard } from "../UI_Elements_templates.js";

function cardTemplate(customer) {
    return `
        <a class="card btn-card center-al" href="${LINKROOT}/ShopOwner/customer/${customer.phone}">
            <div class="profile-photo">
                <img 
                    src="${ROOT}/images/Profile/${customer.phone}.jpg" 
                    alt="Customer Image" 
                    onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            </div>
            <div class="LoyCus-Details fg1">
                <h2 class="center-al">${customer.first_name} ${customer.last_name}</h2>
                <h2>Rs.${Number(customer.wallet).toFixed(2)}</h2>
            </div>
        </a>
    `;
}

// Configerations for loading loyalty customers
const lcApiFetcherConfig = {
    api: "ShopOwner/getLoyaltyCustomers",
    cardTemplate: cardTemplate,
    searchBarId: "lc-searchBar",
    elementsListId: "lc-Scroll-Div"
}

new ApiFetcherMod(lcApiFetcherConfig);

// Configurations for loading pre orders
const poApiFetcherConfig = {
    api : "ShopOwner/getAllPreOrders",
    cardTemplate : preOrderCard
}

const poApiFetcherMod = new ApiFetcherMod(poApiFetcherConfig);


function loyaltyCustomerReqCard(customer) {
    const {
        cus_phone,
        first_name,
        last_name,
        pic_format,
        created_time
    } = customer;

    const profileImage = `${ROOT}/images/Profile/CUS/${cus_phone}.${pic_format}`;
    const defaultImage = `${ROOT}/images/Profile/PhoneNumber.jpg`;

    return `
        <a href="${LINKROOT}/ShopOwner/loyaltyCustomerRequest/${cus_phone}" class="card gap-10">
            <div class="profile-photo">
                <img src="${profileImage}" alt="" onerror="this.src='${defaultImage}'">
            </div>
            <div class="m-b-auto fg1">
                <h3>${first_name} ${last_name}</h3>
                <h4>${cus_phone}</h4>
                <br>
                <h6>Request Created Time -</h6>
                <h5>${created_time}</h5>
            </div>
        </a>
    `;
}

// Configurations for loading new loyalty customer requests
const lcrApiFetcherConfig = {
    api: "ShopOwner/getLoyaltyReqs",
    cardTemplate: loyaltyCustomerReqCard,
    elementsListId: "lcr-Scroll-Div"
}

const lcrApiFetcherMod = new ApiFetcherMod(lcrApiFetcherConfig);

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') poApiFetcherMod.loadDataWithSearchOrFilter();
    if(type == 'loyaltyReq') lcrApiFetcherMod.loadDataWithSearchOrFilter();
}

new Notification(loadDataOnNotification);


function swap(e){
    if(e.target.classList.contains('closed-grid') || e.target.parentElement.classList.contains('closed-grid') || e.target.parentElement.parentElement.classList.contains('closed-grid')){
        document.getElementById('pre-orders').classList.toggle('closed-grid');
        document.getElementById('new-lc-req').classList.toggle('closed-grid');
    }
}

document.getElementById('pre-orders').addEventListener('click', swap);
document.getElementById('new-lc-req').addEventListener('click', swap);