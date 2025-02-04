import ApiFetcherMod from '../ApiFetcherMod.js';

function cardTemplate(customer) {
    const {
        phone,
        first_name,
        last_name,
        address,
        pic_format
    } = customer;
    return `
        <a href="${LINKROOT}/Admin/customer/${phone}" class="card btn-card colomn asp-rtio")">
            <img 
            class="product-img" 
            src="${ROOT}/images/Profile/${phone}.${pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            <div class="details h-50 ovf-hdn  left-al">
                <h4>${first_name} ${last_name}</h4>
                <h5>${phone}</h5>
                <h5>${address}</h5>
            </div>
        </a>
    `;
}

const apiFetcherConfig ={
    api: "Admin/getCustomers",
    cardTemplate: cardTemplate
}

new ApiFetcherMod(apiFetcherConfig);