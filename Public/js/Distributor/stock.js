const search = document.getElementById('search');
const elements = document.getElementById('elements');
let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})

function loadData() {
    const searchTerm = search.value;
    fetch(`${LINKROOT}/Distributor/searchStocks?searchTerm=${encodeURIComponent(searchTerm)}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        elements.innerHTML = '';
        
        data.forEach(stock => {
            elements.innerHTML += cardTemplate(stock);
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function cardTemplate(stock) {
    const {product_name,quantity,bulk_price,pic_format, barcode } = stock;
    return (
        `<a href="#" class="card btn-card center-al" >
                            <div class="details h-100">
                                <h4>${product_name}</h4>
                                <h4>${quantity}</h4>
                                <h4>Rs.${bulk_price.toFixed(2)}</h4>
                            </div>
                            <div class="product-img-container">
                                <img class="product-img" src="${ROOT}/images/Products/${barcode}.${pic_format}" 
                                    alt={name}
                                    onerror="this.src='${ROOT}/images/Default/Product.jpeg'">
                            </div>
                        </a>`
    );
}

loadData();