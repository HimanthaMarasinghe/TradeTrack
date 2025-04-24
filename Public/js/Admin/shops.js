import ApiFetcherMod from '../ApiFetcherMod.js';

function cardTemplate(shop) {
    const {
        so_phone,
        shop_name,
        first_name,
        last_name,
        shop_address,
        shop_pic_format
    } = shop;
    return `
        <a href="${LINKROOT}/Admin/shop/${so_phone}" class="card btn-card colomn asp-rtio")">
            <img 
            class="product-img" 
            src="${ROOT}/images/shops/${so_phone}${shop_pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Shops/default.jpeg'">
            <h3>${shop_name}</h3>
            <div class="details h-50 ovf-hdn  left-al">
                <h4>${first_name} ${last_name}</h4>
                </h6> <h5>${so_phone}</h5>
                </h6> <h5>${shop_address}</h5>
            </div>
        </a>
    `;
}

const apiFetcherConfig ={
    api: "Admin/getShops",
    cardTemplate: cardTemplate
}

new ApiFetcherMod(apiFetcherConfig);