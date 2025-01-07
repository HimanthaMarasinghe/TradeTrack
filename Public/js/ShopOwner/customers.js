const offsetIncrement = 10;
const api = "ShopOwner/getLoyaltyCustomers";

const getVariables = {
    search: ""
};

function updateGetVariables(){
    getVariables.search = searchBar.value;
}

function cardTemplate(customer) {
    return `
        <a class="card btn-card center-al" href="${LINKROOT}/ShopOwner/customer/${customer.phone}">
            <div class="profile-photo">
                <img 
                    src="${ROOT}/images/Profile/${customer.phone}.jpg" 
                    alt="Customer Image" 
                    onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            </div>
            <div class="LoyCus-Details fg1">
                <h2 class="center-al">${customer.first_name} ${customer.last_name}</h2>
                <h2>Rs.${Number(customer.wallet).toFixed(2)}</h2>
            </div>
        </a>
    `;
}


function swap(e){
    if(e.target.classList.contains('closed-grid') || e.target.parentElement.classList.contains('closed-grid') || e.target.parentElement.parentElement.classList.contains('closed-grid')){
        document.getElementById('pre-orders').classList.toggle('closed-grid');
        document.getElementById('new-lc-req').classList.toggle('closed-grid');
    }
}

document.getElementById('pre-orders').addEventListener('click', swap);
document.getElementById('new-lc-req').addEventListener('click', swap);