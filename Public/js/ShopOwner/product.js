import Notification from "../Notification.js";
import {distributorCard} from "../UI_Elements_templates.js";
import ApiFetcherMod from "../ApiFetcherMod.js";

new Notification();

document.getElementById('editPopUp').addEventListener('click', () => viewPopUp('editProduct'));
document.getElementById('recordWaste')?.addEventListener('click', () => viewPopUp('wastePopUp'));
document.getElementById('remove')?.addEventListener('click', () => viewPopUp('removePopUp'));
document.getElementById('openPopUp')?.addEventListener('click', () => viewPopUp('addStock'));
document.getElementById('removeCancel')?.addEventListener('click', () => closePopUp());

const quantityField = document.getElementById('quantity');
const costField = document.getElementById('cost');


quantityField?.addEventListener('input', function () {
    const quantity = this.value;
    costField.value = (quantity * bulk_price).toFixed(2);
});

// Distributors that you can purchase this product from

const getVariables = {
    search: '',
    barcode: barcode
}

const apiFetcherConfig = {
    getVariables: getVariables,
    api: "ShopOwner/getDistributors",
    cardTemplate: distributorCard,
    noDataText: "No registerd distributor distribute this product"
}

new ApiFetcherMod(apiFetcherConfig);

console.log(new Date().toLocaleString());