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

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') poApiFetcherMod.loadDataWithSearchOrFilter();
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