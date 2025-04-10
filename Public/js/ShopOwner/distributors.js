import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../notification.js";

const dataArr = [];

const popUpName = document.getElementById('popUp-distributor-name');
const popUpPhone = document.getElementById('popUp-distributor-phone');
const popUpBusinessName = document.getElementById('popUp-distributor-busines-name');
const popUpAddress = document.getElementById('popUp-distributor-address');
const popUpImage = document.getElementById('popUp-distributor-image');
const dis_products = document.getElementById('popUp-distributor-products');
const slider_container = document.getElementById('slider-container');

function cardTemplate(distributor) {
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


const apiFetcherConfig ={
    api: "ShopOwner/getDistributors",
    cardTemplate: cardTemplate,
    dataArr: dataArr
}

new ApiFetcherMod(apiFetcherConfig);

// function distributorPopUp(phone){
//     const distributor = dataArr.find(d => d.dis_phone === phone);
//     if(distributor){
//         dis_products.innerHTML = '';
//         popUpName.innerText = `${distributor.first_name} ${distributor.last_name}`;
//         popUpPhone.innerText = "- "+distributor.dis_phone;
//         popUpBusinessName.innerText = "- "+distributor.dis_busines_name;
//         popUpAddress.innerText = "- "+distributor.dis_busines_address;
//         popUpImage.src = `${ROOT}/images/Profile/${distributor.dis_phone}.${distributor.pic_format}`;
//         getDistributorProducts(phone);
//         viewPopUp('distributor');
//     }
// }

// // Attach a single listener to the parent container
// document.getElementById('elements-Scroll-Div').addEventListener('click', (event) => {
//     const target = event.target.closest('.card');
//     if (target) {
//         const phone = target.id;
//         distributorPopUp(phone);
//     }
// });


// function getDistributorProducts(phone){
//     fetch(`${ROOT}/ShopOwner/getDistributorProductsBarcodes/${phone}`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json'
//         }
//     })
//     .then(res => res.json())
//     .then(data => {
//         if(!data) return;
//         if(!Array.isArray(data)) throw new Error("Invalid data received from the server");
        
//         data.forEach(element => {
//             console.log(element);
//             dis_products.innerHTML += '<img src="'+ROOT+'/images/Products/'+element.barcode+'.'+element.pic_format+'" alt="Product Image" class="profile-img small border-1 ">';                
//         });

//         if(slider_container.offsetWidth < dis_products.offsetWidth){
//             dis_products.innerHTML += dis_products.innerHTML;
//             dis_products.style.animation = '5s linear infinite slide';
//         }else{
//             dis_products.style.animation = '';
//         }
//     })
//     .catch(err => {
//         console.error(err);
//     });
// }

new Notification();