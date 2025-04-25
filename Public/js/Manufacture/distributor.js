const searchBar = document.getElementById('searchBar');
const scrollBox = document.getElementById('scrollBox');
let debounceTimeout;

searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500);
});

function loadData(){
    const searchTerms = searchBar.value;
    fetch(LINKROOT + "/manufacturer/getDistributor?search=" + searchTerms)
    .then(response => response.json())
    .then(data => {
        renderCards(data);
    })
}

function renderCards(data) {
    scrollBox.innerHTML = '';
    data.forEach(element => {
        scrollBox.insertAdjacentHTML("beforeend", distributorCard(element));
        scrollBox.lastElementChild.addEventListener('click', () => popUp(element))
    });
}

function distributorCard(distributor) {
    const {first_name, last_name, dis_busines_name, dis_phone, pic_format } = distributor;

    var imagePath = `${ROOT}/images/Profile/SA/${dis_phone}.${pic_format}`;

    return `
        <a class="card btn-card colomn asp-rtio" href ="${LINKROOT}/Manufacturer/distributorProfile/${dis_phone}" >
            <img class="product-img" 
                src="${imagePath}" 
                onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg';"
                alt="">
            <div class="details h-50">
                <h4>${first_name}</h4>
                <h4>${last_name}</h4>
                <h4>${dis_busines_name}</h4>
                
            </div>
        </a>
    `;
}


// function popUp(distributors){
//     const {first_name, last_name, dis_busines_name, dis_phone, pic_format, dis_busines_address } = distributors;

//     document.getElementById('dis_name').innerText = `${first_name} ${last_name}`;
//     document.getElementById('dis_business_name').innerText = `${dis_busines_name}`;
//     document.getElementById('dis_phone').innerText = `${dis_phone}`;
//     document.getElementById('dis_business_address').innerText = `${dis_busines_address}`;
 
//     document.getElementById('dis-img').src = `${ROOT}/images/Profile/SA/${dis_phone}.${pic_format}`;
//     document.getElementById('dis-img').onerror = function() {
//         this.src = `${ROOT}/images/Profile/PhoneNumber.jpg`;
//     };
    

//     viewPopUp('distributor_details');
// }

loadData();



