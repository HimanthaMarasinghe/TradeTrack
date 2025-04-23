const searchBar = document.getElementById('searchBar');
const scrollBox = document.getElementById('scrollBox');
let debounceTimeout;

searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500);
});

function loadData(){
    const searchTerms = searchBar.value;
    fetch(LINKROOT + "/manufacturer/getPenProducts?search=" + searchTerms)
    .then(response => response.json())
    .then(data => {
        renderCards(data);
    })
}

function renderCards(data) {
    scrollBox.innerHTML = '';
    data.forEach(element => {
        scrollBox.insertAdjacentHTML('beforeend', pendingCard(element));
        scrollBox.lastElementChild.addEventListener('click', () => requestMoreDetails(element))
    });
}

function pendingCard(product) {
    const {barcode, pic_format, product_name, unit_price, bulk_price, id} = product;

    var imagePath = `${ROOT}/images/NewProducts/${id}.${pic_format}`;

    return `
        <a class="card btn-card colomn">
        <h3>${product_name}</h3>
            <img class="product-img" 
                src="${imagePath}" 
                onerror="this.src='${ROOT}/images/Products/default.jpeg';"
                alt="">

        <div class="details h-50">
            <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="font-weight: bold; padding: 1px;">Barcode:</td>
            <td style="padding: 1px;">${barcode}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding: 1px;">Unit Price:</td>
            <td style="padding: 1px;">Rs.${Number(unit_price).toFixed(2)}</td>
        </tr>
        <tr>
            <td style="font-weight: bold; padding: 1px;">Bulk Price:</td>
            <td style="padding: 1px;">Rs.${Number(bulk_price).toFixed(2)}</td>
        </tr>
    </table>
        </div>
        </a>
    `;
}

function requestMoreDetails(product) {
    const {barcode, pic_format, product_name, unit_price, bulk_price, id} = product;
    document.getElementById('req-prd-barcode').innerText = barcode;
    document.getElementById('req-prd-name').innerText = product_name;
    document.getElementById('req-prd-price').innerText = 'Rs.' + Number(unit_price).toFixed(2);
    document.getElementById('req-prd-bulk').innerText = 'Rs.' + Number(bulk_price).toFixed(2);
    document.getElementById('update-btn').onclick = () => updateRequest(barcode);
    document.getElementById('delete-btn').onclick = () => deleteRequest(barcode);
    const popUpImage = document.getElementById('popUpImage');
    popUpImage.src = `${ROOT}/images/NewProducts/${id}.${pic_format}`;
    popUpImage.onerror = function() {
        this.src = `${ROOT}/images/Products/default.jpeg`;
    };

    viewPopUp('productDetails');
}

loadData();

const form = document.getElementById('addNewProductForm');
const formSubmitBtn = document.getElementById('formSubmitBtn');
const productDetailsPopUp = document.getElementById('productDetails');
const productDetailsPopUpHeader = document.getElementById('addNewProducts').querySelector('h2');

function addNewProduct() {
    productDetailsPopUpHeader.textContent = 'Make a request to add new product';
    form.reset(); // Reset form fields
    form.action = LINKROOT+'/Manufacturer/newProductRequest'; // Reset form action URL to its default value
    formSubmitBtn.value = 'Make request'; // Reset any dynamic labels or changes (if needed)
    viewPopUp('addNewProducts');
}


document.querySelectorAll(".card-js").forEach((card) => {
    card.addEventListener("click", function(event) {
        console.log(encodeURIComponent(event.currentTarget.id));
        fetch(LINKROOT+'/Manufacturer/pendingProductRequestDetails', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'barcodeIn=' + encodeURIComponent(event.currentTarget.id)
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('req-prd-barcode').textContent = data.barcode;
            document.getElementById('req-prd-name').textContent = data.product_name;
            document.getElementById('req-prd-price').textContent = 'Rs.' + data.unit_price.toFixed(2);
            document.getElementById('req-prd-bulk').textContent = 'Rs.' + data.bulk_price.toFixed(2);
            document.getElementById('update-btn').onclick = () => updateRequest(data.barcode);
            document.getElementById('delete-btn').onclick = () => deleteRequest(data.barcode);

            // Redy the form to update the product
            document.getElementById('name').value = data.product_name;
            document.getElementById('barcode').value = data.barcode;
            document.getElementById('unit_price').value = data.unit_price;
            document.getElementById('bulk_price').value = data.bulk_price;
        })
        .catch(error => console.error('Error:', error));
        viewPopUp('productDetails');
    })
})

function updateRequest(barcode) {
    productDetailsPopUpHeader.textContent = 'Update product request';
    productDetailsPopUp.classList.add('hidden');
    form.action = LINKROOT+'/Manufacturer/updateProductRequest/'+barcode;
    formSubmitBtn.value = 'Update';
    viewPopUp('addNewProducts');
}

function deleteRequest(barcode) {
    fetch(LINKROOT+'/Manufacturer/deleteProductRequest', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'barcode=' + encodeURIComponent(barcode)
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            window.location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}