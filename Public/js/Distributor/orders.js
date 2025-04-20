const search = document.getElementById('search');
const elements = document.getElementById('elements');
let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})

function loadData() {
    const searchTerm = search.value;
    fetch(`${LINKROOT}/Distributor/searchOrders?searchTerm=${encodeURIComponent(searchTerm)}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        elements.innerHTML = '';
        
        data.forEach(order => {
            elements.innerHTML += cardTemplate(order);
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function cardTemplate(order) {
    const {shop_name, so_phone, shop_pic_format, time, status } = order;
    return (
        `<a href="${LINKROOT}/Distributor/orderDetails" class="card btn-card center-al">
            <div class="profile-photo">
                <img src="${ROOT}/images/shops/${so_phone+shop_pic_format}" alt={name} />
            </div>
            <div class="details center-al">
                <h4>${shop_name}</h4>
                <h4>${time}</h4>
                <h4>${status}</h4>
            </div>
        </a>`
    );
}

loadData();