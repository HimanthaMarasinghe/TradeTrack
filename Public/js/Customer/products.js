import ApiFetcherMod from "../ApiFetcherMod.js";

function generateProductCard(product) {
    const {barcode, pic_format, product_name, unit_price } = product;
    const imagePath = `${ROOT}/images/Products/${barcode}.${pic_format}`;

    return `
        <a href="${LINKROOT}/Customer/product/${barcode}" class="card btn-card colomn asp-rtio">
            <img class="product-img" 
                src="${imagePath}" 
                onerror="this.src='${ROOT}/images/Products/default.jpeg';"
                alt="">
            <div class="details h-50">
                <h4>${product_name}</h4>
                <h4>Rs.${Number(unit_price).toFixed(2)}</h4>
            </div>
        </a>
    `;
}

const apiFetcherConfig = {
    api: "/Customer/getProducts",
    cardTemplate: generateProductCard,
};

new ApiFetcherMod(apiFetcherConfig);