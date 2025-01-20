const loyaltyCheckBox = document.getElementById("loyalty");

const offsetIncrement = 10;
const api = "Customer/getShops";
// const dataArr = [];

const getVariables = {
    search: "",
    loyalty: false
};

function cardTemplate(shop) {
    return `
        <a href="${LINKROOT}/Customer/shop/${shop.so_phone}" class="card btn-card colomn asp-rtio">
        <h3>${shop.shop_name}</h3>
            <img class="product-img" 
                src="${ROOT}/images/shops/${shop.so_phone}${shop.shop_pic_format}" 
                alt="" 
                onerror="this.src='${ROOT}/images/shops/default.jpeg'">
            <div class="details h-50">
                <h6>Owner -</h6>
                <h4>${shop.first_name} ${shop.last_name}</h4>
                <h6>Address -</h6>
                <h4>${shop.shop_address}</h4>
            </div>
        </a>
    `;
}

function updateGetVariables(){
    getVariables.search = searchBar.value;
    getVariables.loyalty = loyaltyCheckBox.checked ? 1 : 0;
}