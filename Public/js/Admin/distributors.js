import ApiFetcherMod from '../ApiFetcherMod.js';

function cardTemplate(distributor) {
    const {
        dis_phone,
        dis_busines_name,
        first_name,
        last_name,
        dis_busines_address,
        pic_format
    } = distributor;
    return `
        <a href="${LINKROOT}/Admin/distributor/${dis_phone}" class="card btn-card colomn asp-rtio")">
            <img 
            class="product-img" 
            src="${ROOT}/images/Profile/${dis_phone}.${pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            <h3>${dis_busines_name}</h3>
            <div class="details h-50 ovf-hdn  left-al">
                <h4>${first_name} ${last_name}</h4>
                </h6> <h5>${dis_phone}</h5>
                </h6> <h5>${dis_busines_address}</h5>
            </div>
        </a>
    `;
}

const apiFetcherConfig ={
    api: "Admin/getDistributors",
    cardTemplate: cardTemplate
}

new ApiFetcherMod(apiFetcherConfig);