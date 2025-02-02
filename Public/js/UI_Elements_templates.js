export function stockCardTemplate(product) {
    const {
        barcode,
        product_name,
        quantity,
        pre_orderable_stock,
        low_stock_level,
        unit_price,
        pic_format,
    } = product;

    // Determine the link
    // const link =`${ROOT}/ShopOwner/product/${barcode}`;

    // Determine the image path
    const imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;



    // Determine the low stock class
    const lowStockClass = quantity < low_stock_level ? "low" : "";

    return `
        <a href="#" class="card btn-card ${lowStockClass}" id="${barcode}">
            <div class="details h-100">
                <h3>${product_name}</h3>
                <p class="quantity">${quantity} Units in stock</p>
                <h5 class="quantity">${pre_orderable_stock > 0 ? pre_orderable_stock + ` Units can be pre orederd` : `No pre-orderable stock`}</h5>
                <h4>Rs.${unit_price.toFixed(2)}</h4>
            </div>
            <div class="product-img-container">
                <img class="product-img" src="${imageSrc}" alt="" onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            </div>
        </a>
    `;
}