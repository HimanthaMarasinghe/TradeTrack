const search = document.getElementById('search');
const elements = document.getElementById('elements');
const Filter = document.getElementById('Filter');
const dateElement = document.getElementById('order_date');
let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})

Filter.addEventListener('change', () => loadData());
dateElement.addEventListener('change', () => loadData());

function loadData() {
    const filterTerms = Filter.value;
    const dateTerms = dateElement.value;
    const searchTerm = search.value;
    fetch(`${LINKROOT}/Distributor/searchOrders?searchTerm=${encodeURIComponent(searchTerm)}&filter=${encodeURIComponent(filterTerms)}&date=${encodeURIComponent(dateTerms)}`, {
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
    const {shop_name, so_phone, shop_pic_format, date, status, order_id } = order;
    return (
        `<a href="${LINKROOT}/Distributor/orderDetails/${order_id}" class="card btn-card center-al">
        <span class="badge">Order ID ${order_id}</span>
            <div class="profile-photo">
                <img src="${ROOT}/images/shops/${so_phone+shop_pic_format}" alt={name} />
            </div>
            <div class="details center-al">
                <h4>${shop_name}</h4>
                <h4>${date}</h4>
                <h4>${status}</h4>
            </div>
        </a>`
    );
}

loadData();