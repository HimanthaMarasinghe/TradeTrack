const search = document.getElementById('search');
const elements = document.getElementById('elements');
let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})

function loadData() {
    const searchTerm = search.value;
    fetch(`${LINKROOT}/Distributor/searchShops?searchTerm=${encodeURIComponent(searchTerm)}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        elements.innerHTML = '';
        
        data.forEach(shop => {
            elements.innerHTML += cardTemplate(shop);
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function cardTemplate(shop) {
    const {shop_name, so_phone, shop_pic_format, shop_address } = shop;
    return (
        `<a href="${LINKROOT}/Distributor/shopProfile/${so_phone}" class="card btn-card colomn asp-rtio">
        <img class="product-img" 
            src="${ROOT}/images/shops/${so_phone+shop_pic_format}" 
            alt={name}
            onerror="this.src='${ROOT}/images/shops/Default.jpeg'" />
        <div class="details h-50">
            <h4>${shop_name}</h4>
            <h4>${shop_address}</h4>
        </div>
        </a>`
        );
}

loadData();

