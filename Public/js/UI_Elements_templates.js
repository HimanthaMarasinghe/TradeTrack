export function stockCardTemplate(product) {
    const {
        barcode,
        product_name,
        quantity,
        pre_orderable_stock,
        low_stock_level,
        unit_price,
        pic_format,
        unit_type,
        unique
    } = product;

    if(unique == 1) var imageSrc = `${ROOT}/images/Products/${shopPhone+barcode}.${pic_format}`;
    else var imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;

    var badge = `<span class="badge">No Pre-orderable stock</span>`;
    var lowStockClass = "";

    if (pre_orderable_stock > 0) badge = `<span class="badge">${pre_orderable_stock} ${unit_type} Pre-orderable</span>`;
    else lowStockClass = "low";

    return `
        <a href="#" class="card btn-card ${lowStockClass}" id="${barcode}">
        ${badge}
            <div class="details h-100">
                <h3>${product_name}</h3>
                <p class="quantity">${quantity < 0 ? 0 : quantity} ${unit_type} in stock</p>
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
    const {barcode, pic_format, product_name, unit_price, so_phone, shop_name, unique } = product;

    var imagePath = `${ROOT}/images/Products/${barcode}.${pic_format}`;
    var badge = "";
    var link = `${LINKROOT}/${clickLink}/${barcode}`;
    if (unique == 1) {
        imagePath = `${ROOT}/images/Products/${so_phone+barcode}.${pic_format}`;
        badge = `<span class="badge">From ${shop_name}</span>`
        link = `${LINKROOT}/${clickLink}/${barcode}/${so_phone}`;
    }

    return `
        <a href="${link}" class="card btn-card colomn asp-rtio">
            ${badge}
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

 export function newStockCardTemplate(product) {
    const {
        barcode,
        product_name,
        bulk_price,
        pic_format,
        quantity_shown,
        unit_type
    } = product;
    
    const imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;

    return `
        <a href="#" class="card btn-card" id="${barcode}">
            <div class="details h-100">
                <h3>${product_name}</h3>
                <p>${quantity_shown > 0 ? quantity_shown : 'No'} ${unit_type} can be orderd
                <h4>Rs.${bulk_price.toFixed(2)}</h4>
            </div>
            <div class="product-img-container">
                <img class="product-img" src="${imageSrc}" alt="" onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            </div>
        </a>
    `;
}

export function distributorCard(distributor) {
    const {
        dis_phone,
        first_name,
        last_name,
        dis_busines_name,
        pic_format
    } = distributor;
    return `
        <a class="card btn-card colomn asp-rtio") id="${dis_phone}" href="${LINKROOT}/ShopOwner/Distributor/${dis_phone}">
            <img 
            class="product-img" 
            src="${ROOT}/images/Profile/${dis_phone}.${pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            <div class="details h-50 ovf-hdn">
                <h4>${first_name}</h4>
                <h4>${last_name}</h4>
                <h4>${dis_busines_name}</h4>
                <h4>${dis_phone}</h4>
            </div>
        </a>
    `;
}