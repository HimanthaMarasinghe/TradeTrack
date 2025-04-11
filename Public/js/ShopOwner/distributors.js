import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../notification.js";
import {distributorCard} from "../UI_Elements_templates.js";

const apiFetcherConfig = {
    api: "ShopOwner/getDistributors",
    cardTemplate: distributorCard
}

new ApiFetcherMod(apiFetcherConfig);
new Notification();