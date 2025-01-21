import ApiFetcherMod from "../ApiFetcherMod.js";

function cardTemplate(product) {
    const {
        barcode,
        product_name,
        quantity,
        low_stock_level,
        unit_price,
        pic_format,
    } = product;

    // Determine the link
    const link =`${ROOT}/ShopOwner/product/${barcode}`;

    // Determine the image path
    const imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;

    // Determine the low stock class
    const lowStockClass = quantity < low_stock_level ? "low" : "";

    return `
        <a href="${link}" class="card btn-card center-al ${lowStockClass}" id="${barcode}">
            <div class="details h-100">
                <h4>${product_name}</h4>
                <h4 class="quantity">${quantity} Units in stock</h4>
                <h4>Rs.${unit_price.toFixed(2)}</h4>
            </div>
            <div class="product-img-container">
                <img class="product-img" src="${imageSrc}" alt="" onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            </div>
        </a>
    `;
}

const apiFetcherConfig = {
    api: "ShopOwner/getStocks",
    cardTemplate: cardTemplate
}

new ApiFetcherMod(apiFetcherConfig);