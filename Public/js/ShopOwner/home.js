import Notification from "../notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";
import { preOrderCard } from "../UI_Elements_templates.js";

const config = {
    api : "ShopOwner/getAllPreOrders",
    cardTemplate : preOrderCard
}

const apiFetcherMod = new ApiFetcherMod(config);

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') apiFetcherMod.loadDataWithSearchOrFilter();
}

new Notification(loadDataOnNotification, false, false, false, true);