import Notification from "../Notification.js";
import {distributorCard} from "../UI_Elements_templates.js";
import ApiFetcherMod from "../ApiFetcherMod.js";

new Notification();

// Edit Details.

// const unit_price = document.getElementById('unitPrice');
// const aapp = document.getElementById('aapp');
// const editSubmit = document.getElementById('editSubmit');

document.getElementById('editPopUp').addEventListener('click', () => viewPopUp('editProduct'));

// editSubmit.addEventListener('click', () => {
//     if (unit_price.value == unit_price_Def && aapp.value == aappDef) {
//         closePopUp();
//         return;
//     }
//     if (unit_price.value == unit_price_Def) unit_price.disabled = true;
//     if (aapp.value == aappDef) aapp.disabled = true;
//     const form = document.getElementById('editProductForm');
//     if (form.reportValidity()){
//         const formData = new FormData(form);
//         fetch(`${LINKROOT}/ShopOwner/editProduct`, {
//             method: 'POST',
//             body: formData
//         })
//         .then(res => res.json())
//         .then(data => {
//             if (data.success) {
//                 alert("Product details updated successfully");
//                 if(data.new_price !== undefined) document.getElementById('unit_Price').innerText = Number(data.new_price).toFixed(2);
//                 if(data.new_aapp !== undefined) document.getElementById('amount_alowed_per_pre_Order').innerText = data.new_aapp;
//             } else {
//                 alert('An error occurred');
//             }
//             closePopUp();
//         })
//     }
// });

// Record stock received from unregistered distributors.

const quantityField = document.getElementById('quantity');
const costField = document.getElementById('cost');

document.getElementById('openPopUp')?.addEventListener('click', () => viewPopUp('addStock'));

quantityField?.addEventListener('input', function () {
    const quantity = this.value;
    costField.value = (quantity * bulk_price).toFixed(2);
});

document.getElementById('addStockBtn')?.addEventListener('click', () => {
    const form = document.getElementById('addStockForm');
    if (form.reportValidity()){
        const formData = new FormData(form);
        fetch(`${LINKROOT}/ShopOwner/addStock`, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Stock added successfully");
                document.getElementById('currentStk').innerText = data.new_stock;
                form.reset();
            } else {
                alert('An error occurred');
            }
            closePopUp();
        })
    }
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

// Add to my stock



new ApiFetcherMod(apiFetcherConfig);