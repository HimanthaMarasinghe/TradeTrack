import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";

const dataArr = [];

function cardTemplate(product) {
    let badge = '';
    let imgSrc = `${ROOT}/images/Products/${product.barcode}.${product.pic_format}`;
    if(product.unique == 1) {
        imgSrc = `${ROOT}/images/Products/${ws_id+product.barcode}.${product.pic_format}`
        product.barcode = 'x' + product.barcode;
        badge = `<span class="badge">Unique</span>`;
    }
    return `
        <a href="${LINKROOT}/ShopOwner/product/${product.barcode}" class="card btn-card colomn asp-rtio" id="${product.barcode}">
            ${badge}
            <img class="product-img" 
                    src="${imgSrc}" 
                    alt="Product Image"
                    onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            <div class="details h-50">
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
                </table>
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

document.getElementById('addUniqueProductBtn').addEventListener('click', () => viewPopUp('addNewProducts'));
const submitBtn = document.getElementById('formSubmit');
const tip = document.getElementById('tip');
document.getElementById('product_code').addEventListener('input', (e) => {
    if (!e.target.value.startsWith('x')) {
        e.target.value = 'x';
      }
    if (e.target.value.length < 3) {
        submitBtn.classList.add('disabled-link');
        e.target.classList.remove('green-text');
        e.target.classList.add('red-text');
        tip.classList.add('red-text');
        tip.classList.remove('green-text');
        tip.innerText = 'Code should have 3 characters';
        return;
    }
    if (e.target.value.length > 3) {
        e.target.value = e.target.value.slice(0, 3);
        return;
    }
    console.log(e.target.value);
    const productCode = e.target.value.slice(1, 3);
    fetch(`${LINKROOT}/ShopOwner/productCodeCheck/${productCode}`)
    .then(response => response.json())
    .then(data => {
        if(data) {
            submitBtn.classList.remove('disabled-link');
            e.target.classList.remove('red-text');
            e.target.classList.add('green-text');
            tip.innerText = 'Code is valid';
            tip.classList.remove('red-text');
            tip.classList.add('green-text');
        } else {
            submitBtn.classList.add('disabled-link');
            e.target.classList.remove('green-text');
            e.target.classList.add('red-text');
            tip.classList.add('red-text');
            tip.classList.remove('green-text');
            tip.innerText = 'Code is already used';
        }
    })
})

new Notification();