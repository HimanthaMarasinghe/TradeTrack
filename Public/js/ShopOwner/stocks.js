import Notification from "../notification.js";
import ApiFetcherMod from "../ApiFetcherMod.js";

function cardTemplate(product) {
    const {
        barcode,
        product_name,
        quantity,
        low_stock_level,
        unit_price,
        pic_format,
        unit_type,
        unique
    } = product;

    if(unique == 1) {
        var badge = `<span class="badge">Unique</span>`;
        var link =`${LINKROOT}/ShopOwner/product/x${barcode}`;
        var imageSrc = `${ROOT}/images/Products/${ws_id+barcode}.${pic_format}`;
    } else {
        var badge = '';
        var link = `${LINKROOT}/ShopOwner/product/${barcode}`;
        var imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;
    }
    
    const lowStockClass = quantity < low_stock_level ? "low" : "";

    return `
        <a href="${link}" class="card btn-card ${lowStockClass}" id="${barcode}">
            ${badge}
            <div class="details h-100">
                <h4>${product_name}</h4>
                <h4 class="quantity">${quantity < 0 ? 0 : quantity} ${unit_type} in stock</h4>
                <h4>My Price - Rs.${unit_price.toFixed(2)}</h4>
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
new Notification();