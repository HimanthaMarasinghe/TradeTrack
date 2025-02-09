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

/**
 * To use this template, there should be a global variable called `clickLink` defined in the php script inside a `<script>` tag. 
 */
export function productCard(product) {
    const {barcode, pic_format, product_name, unit_price } = product;
    const imagePath = `${ROOT}/images/Products/${barcode}.${pic_format}`;

    return `
        <a href="${LINKROOT}/${clickLink}/${barcode}" class="card btn-card colomn asp-rtio">
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

export function preOrderCard(order) {
    return `
        <a class="card btn-card center-al alitem-center ${order.status}-preOrder" 
           href="${LINKROOT}/ShopOwner/preOrder/${order.pre_order_id}">
            <div class="profile-photo">
                <img src="${ROOT}/images/Profile/${order.cus_phone}.${order.pic_format}" 
                     alt="Profile Photo" 
                     onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            </div>
            <div class="details center-al">
                <h3>Order Id ${order.pre_order_id}</h3>
                <h4>${order.first_name} ${order.last_name}</h4>
                <h4>Rs.${order.total}</h4>
                <h4>${order.date_time}</h4>
                <h4 class="status">${order.status}</h4>
            </div>
        </a>
    `;
}