import ApiFetcherMod from '../ApiFetcherMod.js';

function cardTemplate(product) {
    const {
        id,
        barcode,
        product_name,
        unit_price,
        pic_format,
        company_name,
        alreadyExist
    } = product;

    var warnClass = '';
    if(alreadyExist) warnClass = 'low';

    return `
        <a href="#" class="card btn-card center-al card-js ${warnClass}" id="${id}">
            <div class="details h-100 left-al">
                <h4>${product_name}</h4>
                <h5>${company_name}</h4>
                <h5 class="quantity">Barcode - ${barcode}</h4>
                <h5>Unit Price - Rs.${unit_price.toFixed(2)}</h4>
            </div>
            <div class="product-img-container">
                <img class="product-img" 
                     src="${ROOT}/images/pendingProducts/${id}${pic_format}" 
                     alt="" 
                     onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            </div>
        </a>
    `;
}

function cardClickEvent(data) {
    document.getElementById('req-prd-barcode').textContent = data.barcode;
    document.getElementById('req-prd-name').textContent = data.product_name;
    document.getElementById('req-prd-price').textContent = 'Rs.' + data.unit_price.toFixed(2);
    document.getElementById('req-prd-bulk').textContent = 'Rs.' + data.bulk_price.toFixed(2);
    const product_image = document.getElementById("product_image");
    product_image.src = `${ROOT}/images/NewProducts/${data.id}.${data.pic_format}`;
    product_image.onerror = function() {
        this.src=`${ROOT}/images/Products/default.jpeg`;
    }
    const proof_image = document.getElementById("proof_image");
    proof_image.src = `${ROOT}/images/BarcodeProofs/${data.id}.${data.pic_format}`;
    proof_image.onerror = function() {
        this.src=`${ROOT}/images/Products/default.jpeg`;
    }
    document.getElementById('accept-btn').onclick = () => {
        fetch(`${LINKROOT}/Admin/acceptRequest/${data.id}`, {
            method: 'POST'
        })
        .then(() => location.reload());
    }
    viewPopUp('productDetails');
}


const apiFetcherConfig ={
    api: "Admin/getProductsRequests",
    cardTemplate: cardTemplate,
    clickEvent: cardClickEvent
}

new ApiFetcherMod(apiFetcherConfig);