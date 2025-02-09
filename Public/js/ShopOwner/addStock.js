import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";

const dataArr = [];

function cardTemplate(product) {
    return `
        <a href="#" class="card btn-card center-al" id="${product.barcode}">
            <div class="details h-100">
                <h4>${product.product_name}</h4>
                <table class='left-al'>
                    <tr>
                        <td><h5>Barcode</h5></td>
                        <td><h5>${product.barcode}</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Unit Price</h5></td>
                        <td><h5>Rs.${product.unit_price.toFixed(2)}</h5></td>
                    </tr>
                    <tr>
                        <td><h5>Bulk Price</h5></td>
                        <td><h5>Rs.${product.bulk_price.toFixed(2)}</h5></td>
                    </tr>
                </table>
            </div>
            <div class="product-img-container">
                <img class="product-img" 
                    src="${ROOT}/images/Products/${product.barcode}.${product.pic_format}" 
                    alt="Product Image"
                    onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            </div>
        </a>
    `;
}

const apiFetcherConfig = {
    api: "ShopOwner/getProducts",
    cardTemplate: cardTemplate,
    dataArr: dataArr
}

new ApiFetcherMod(apiFetcherConfig);

// Function to handle product pop-up
function addStockPopUp(barcode) {
    const product = dataArr.find(p => p.barcode === barcode);
    if (product) {
        const productImage = document.getElementById('popUp-prdct-image');
        productImage.src = `${ROOT}/images/Products/${product.barcode}.${product.pic_format}`;
        productImage.onerror = function () {
            this.src = `${ROOT}/images/Products/default.jpeg`;
        };
        document.getElementById('popUp-prdct-name').innerText = product.product_name;
        document.getElementById('popUp-prdct-unit-price').innerText = `Rs.${product.unit_price.toFixed(2)}`;
        document.getElementById('popUp-prdct-bulk-price').innerText = `Rs.${product.bulk_price.toFixed(2)}`;
        document.getElementById('popUp-prdct-barcode').value = product.barcode;
        viewPopUp('addStock');
    }
}

// Attach a single listener to the parent container
document.getElementById('elements-Scroll-Div').addEventListener('click', (event) => {
    const target = event.target.closest('.card');
    if (target) {
        const barcode = target.id;
        addStockPopUp(barcode);
    }
});


const quantityField = document.getElementById('quantity');
const costField = document.getElementById('cost');

quantityField.addEventListener('input', function () {
    const quantity = this.value;
    costField.value = (quantity * product.bulk_price).toFixed(2);
});

document.getElementById('addStockBtn').addEventListener('click', () => {
    const barcode = document.getElementById('popUp-prdct-barcode').value;
    const form = document.getElementById('addStockForm');

    if (quantity === "" || cost === "") {
        alert("Please fill all fields");
        return;
    }

    const formData = new FormData(form);
    formData.append('barcode', barcode);

    fetch(`${LINKROOT}/ShopOwner/addStock`, {
        method: 'POST',
        body: formData
    })
    .then(() => {
        closePopUp();
    })
    .catch(err => console.error("Error adding stock:", err));
});

new Notification();