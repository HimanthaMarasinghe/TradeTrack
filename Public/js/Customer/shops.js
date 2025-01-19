const offsetIncrement = 10;
const api = "Customer/getShops";
// const dataArr = [];

const getVariables = {
    search: ""
};

function cardTemplate(shop) {
    return `
        <a href="" class="card btn-card colomn asp-rtio">
            <img class="product-img" 
                src="${ROOT}/images/shops/${shop.so_phone}${shop.shop_pic_format}" 
                alt="" 
                onerror="this.src='${ROOT}/images/shops/default.jpeg'">
            <div class="details h-50">
                <h4>${shop.shop_name}</h4>
                <h4>${shop.shop_address}</h4>
            </div>
        </a>
    `;
}

function updateGetVariables(){
    getVariables.search = searchBar.value;
}