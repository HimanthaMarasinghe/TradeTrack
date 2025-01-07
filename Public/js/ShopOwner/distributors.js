const offsetIncrement = 10;
const api = "ShopOwner/getDistributors";
const dataArr = [];

const popUpName = document.getElementById('popUp-distributor-name');
const popUpPhone = document.getElementById('popUp-distributor-phone');
const popUpBusinessName = document.getElementById('popUp-distributor-busines-name');
const popUpAddress = document.getElementById('popUp-distributor-address');
const popUpImage = document.getElementById('popUp-distributor-image');
const dis_products = document.getElementById('popUp-distributor-products');
const slider_container = document.getElementById('slider-container');


const getVariables = {
    search: ""
};

function cardTemplate(distributor) {
    return `
        <div class="card btn-card colomn asp-rtio" onclick=distributorPopUp('${distributor.dis_phone}')>
            <img 
            class="product-img" 
            src="${ROOT}/images/Profile/${distributor.dis_phone}.${distributor.pic_format}" 
            alt="distibutor Image"
            onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            <div class="details h-50 ovf-hdn">
                <h4>${distributor.first_name}</h4>
                <h4>${distributor.last_name}</h4>
                <h4>${distributor.dis_busines_name}</h4>
                <h4>${distributor.dis_phone}</h4>
            </div>
        </div>
    `;
}

function updateGetVariables(){
    getVariables.search = searchBar.value;
}

function distributorPopUp(phone){
    let distributor = dataArr.find(d => d.dis_phone === phone);
    if(distributor){
        dis_products.innerHTML = '';
        popUpName.innerText = `${distributor.first_name} ${distributor.last_name}`;
        popUpPhone.innerText = "- "+distributor.dis_phone;
        popUpBusinessName.innerText = "- "+distributor.dis_busines_name;
        popUpAddress.innerText = "- "+distributor.dis_busines_address;
        popUpImage.src = `${ROOT}/images/Profile/${distributor.dis_phone}.${distributor.pic_format}`;
        getDistributorProducts(phone);
        viewPopUp('distributor');
    }
}

function getDistributorProducts(phone){
    fetch(`${ROOT}/ShopOwner/getDistributorProductsBarcodes/${phone}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if(!data) return;
        if(!Array.isArray(data)) throw new Error("Invalid data received from the server");
        
        data.forEach(element => {
            console.log(element);
            dis_products.innerHTML += '<img src="'+ROOT+'/images/Products/'+element.barcode+'.'+element.pic_format+'" alt="Product Image" class="profile-img small border-1 ">';                
        });

        if(slider_container.offsetWidth < dis_products.offsetWidth){
            dis_products.innerHTML += dis_products.innerHTML;
            dis_products.style.animation = '5s linear infinite slide';
        }else{
            dis_products.style.animation = '';
        }
    })
    .catch(err => {
        console.error(err);
    });
}