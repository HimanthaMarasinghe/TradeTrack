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
            elements.insertAdjacentHTML('beforeend', cardTemplate(stock));
            elements.lastElementChild.addEventListener('click', () => popUpModel(stock));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function cardTemplate(stock) {
    const {product_name,quantity,bulk_price,pic_format, barcode,unit_type,low_quantity_level } = stock;

    const lowStockClass = quantity < low_quantity_level ? "low" : "";
    return (
        `<a href="#" class="card btn-card center-al ${lowStockClass}" >
                            <div class="details h-100">
                                <h4>${product_name}</h4>
                                <h4 class = "quantity">${quantity} ${unit_type}</h4>
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

function popUpModel(stock){
    const {product_name,quantity,bulk_price,pic_format, barcode, unit_type, unit_price, low_quantity_level} = stock;

    document.getElementById('popUpProductImage').src = `${ROOT}/images/Products/${barcode}.${pic_format}`;
    document.getElementById('popUpProductName').innerText = product_name;
    document.getElementById('popUpProductBarcode').innerText = barcode;
    document.getElementById('popUpProductQuantity').innerText = `${quantity} ${unit_type} `;
    document.getElementById('popUpProductUnitPrice').innerText = `Rs.${unit_price.toFixed(2)}`;
    document.getElementById('popUpProductBulkPrice').innerText = `Rs.${bulk_price.toFixed(2)}`;
    document.getElementById('popUpProductLowQuantityLevel').innerText = `${low_quantity_level} ${unit_type}`;
    document.getElementById('editLowQuantityLevelForm').action = `${LINKROOT}/Distributor/editLowQuantityLevel/${barcode}`;


    document.getElementById('editPopUpProductImage').src = `${ROOT}/images/Products/${barcode}.${pic_format}`;
    document.getElementById('editPopUpProductName').innerText = product_name;
    document.getElementById('editPopUpProductBarcode').innerText = barcode;
    document.getElementById('editPopUpProductQuantity').innerText = `${quantity} ${unit_type} `;
    document.getElementById('editPopUpProductLowQuantityLevel').innerText = `${low_quantity_level} ${unit_type}`;


    viewPopUp('productViewPopUp');
}

document.getElementById('editLowQuantityLevelBtn').addEventListener('click', () => {
    closePopUp();
    viewPopUp('editLowQuantityLevel');
});

loadData();