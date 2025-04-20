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
        scrollBox.innerHTML += distributorCard(element);
    });
}

function distributorCard(distributor) {
    const {first_name, last_name, dis_busines_name, dis_phone, pic_format } = distributor;

    var imagePath = `${ROOT}/images/Profile/SA/${dis_phone}.${pic_format}`;
    var link = `${LINKROOT}/Manufacturer/distributor/${dis_phone}`;

    return `
        <a href="${link}" class="card btn-card colomn asp-rtio">
            <img class="product-img" 
                src="${imagePath}" 
                onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg';"
                alt="">
            <div class="details h-50">
                <h4>${first_name}</h4>
                <h4>${last_name}</h4>
                <h4>${dis_busines_name}</h4>
                <h4>${dis_phone}</h4>
            </div>
        </a>
    `;
}

loadData();