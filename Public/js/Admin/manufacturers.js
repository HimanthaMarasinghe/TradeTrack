import ApiFetcherMod from '../ApiFetcherMod.js';

function cardTemplate(manufacturer) {
    const {
        man_phone,
        company_name,
        first_name,
        last_name,
        company_address,
        pic_format
    } = manufacturer;
    return `
        <a href="${LINKROOT}/Admin/manufacturer/${man_phone}" class="card btn-card colomn asp-rtio")">
            <img 
            class="product-img" 
            src="${ROOT}/images/Profile/${man_phone}.${pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            <h3>${company_name}</h3>
            <div class="details h-50 ovf-hdn  left-al">
                <h4>${first_name} ${last_name}</h4>
                </h6> <h5>${man_phone}</h5>
                </h6> <h5>${company_address}</h5>
            </div>
        </a>
    `;
}

const apiFetcherConfig ={
    api: "Admin/getManufacturers",
    cardTemplate: cardTemplate
}

new ApiFetcherMod(apiFetcherConfig);