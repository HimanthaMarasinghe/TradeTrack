const searchBar = document.getElementById('searchBar');
const scrollBox = document.getElementById('scrollBox');
let debounceTimeout;

searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500);
});

function loadData(){
    const searchTerms = searchBar.value;
    fetch(LINKROOT + "/manufacturer/getProducts?search=" + searchTerms)
    .then(response => response.json())
    .then(data => {
        renderCards(data);
    })
}

function renderCards(data) {
    scrollBox.innerHTML = '';
    data.forEach(element => {
        scrollBox.innerHTML += productCard(element);
    });
}

function productCard(product) {
    const {barcode, pic_format, product_name, unit_price, bulk_price } = product;

    var imagePath = `${ROOT}/images/Products/${barcode}.${pic_format}`;
    var link = `${LINKROOT}/Manufacturer/product/${barcode}`;

    return `
        <a href="${link}" class="card btn-card colomn asp-rtio">
            <img class="product-img" 
                src="${imagePath}" 
                onerror="this.src='${ROOT}/images/Products/default.jpeg';"
                alt="">
            <div class="details h-50">
                <h4>${product_name}</h4>
                <h4>Rs.${Number(unit_price).toFixed(2)}</h4>
                <h4>Rs.${bulk_price}</h4>
            </div>
        </a>
    `;
}

loadData();