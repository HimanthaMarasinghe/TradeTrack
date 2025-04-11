import Notification from "../Notification.js";
import {distributorCard} from "../UI_Elements_templates.js";
import ApiFetcherMod from "../ApiFetcherMod.js";

new Notification();

const quantityField = document.getElementById('quantity');
const costField = document.getElementById('cost');

document.getElementById('openPopUp').addEventListener('click', () => viewPopUp('addStock'));

quantityField.addEventListener('input', function () {
    const quantity = this.value;
    costField.value = (quantity * bulk_price).toFixed(2);
});

document.getElementById('addStockBtn').addEventListener('click', () => {
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

const getVariables = {
    search: '',
    barcode: barcode
}

const apiFetcherConfig = {
    getVariables: getVariables,
    api: "ShopOwner/getDistributors",
    cardTemplate: distributorCard
}

if(barcode)
    new ApiFetcherMod(apiFetcherConfig);
else
    document.getElementById('elements-Scroll-Div').innerHTML = `<h2 class="grid-center center-al faded-text m-t-20">No registerd distributor distribute this product</h2>`;