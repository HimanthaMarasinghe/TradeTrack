const offsetIncrement = 10;
const api = "ShopOwner/getDistributors";

const getVariables = {
    search: ""
};

function cardTemplate(distributor) {
    return `
        <a href="#" class="card btn-card colomn asp-rtio">
            <img 
            class="product-img" 
            src="${ROOT}/images/Profile/${distributor.dis_phone}.${distributor.pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            <div class="details h-50 ovf-hdn">
                <h4>${distributor.first_name}</h4>
                <h4> ${distributor.last_name}</h4>
                <h4>${distributor.dis_busines_name}</h4>
                <h4>${distributor.dis_phone}</h4>
            </div>
        </a
    `;
}

function updateGetVariables(){
    getVariables.search = searchBar.value;
}