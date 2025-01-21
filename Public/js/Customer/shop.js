import ApiFetcherMod from '../ApiFetcherMod.js';

document.getElementById('reqLoyalty')?.addEventListener('click', () => {
    fetch(LINKROOT + '/Customer/reqLoyalty', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'so_phone=' + encodeURIComponent(shopPhone)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            location.reload();
        } else {
            alert('Request failed');
        }
    })
});

function rowTemplate(bill){
    const {
        bill_id,
        date,
        time,
        total
    } = bill;
    return `
        <tr class='Item' id='${bill_id}'>
            <td class='center-al'>${bill_id}</td>
            <td class='left-al'>${date}</td>
            <td class='left-al'>${time}</td>
            <td>Rs.${total.toFixed(2)}</td>
        </tr>
    `;
}

const billGetVariables = {
    shop_phone: shopPhone
}

const billApiConfig = {
    api: 'Customer/getBills',
    cardTemplate: rowTemplate,
    elementsListId: 'billTable',
    scrollDivId: 'billScroll',
    getVariables: billGetVariables
}

new ApiFetcherMod(billApiConfig);

function stockCardTemplate(product) {
    const {
        barcode,
        product_name,
        quantity,
        low_stock_level,
        unit_price,
        pic_format,
    } = product;

    // Determine the link
    // const link =`${ROOT}/ShopOwner/product/${barcode}`;

    // Determine the image path
    const imageSrc = `${ROOT}/images/Products/${barcode}.${pic_format}`;

    // Determine the low stock class
    const lowStockClass = quantity < low_stock_level ? "low" : "";

    return `
        <a href="#" class="card btn-card center-al ${lowStockClass}" id="${barcode}">
            <div class="details h-100">
                <h4>${product_name}</h4>
                <h4 class="quantity">${quantity} Units in stock</h4>
                <h4>Rs.${unit_price.toFixed(2)}</h4>
            </div>
            <div class="product-img-container">
                <img class="product-img" src="${imageSrc}" alt="" onerror="this.src='${ROOT}/images/Products/default.jpeg'">
            </div>
        </a>
    `;
}

const getVariables = {
    search: '',
    shop_phone: shopPhone
}

const stockApiConfig = {
    api: 'Customer/getStocks',
    cardTemplate: stockCardTemplate,
    elementsListId: 'stockScroll',
    getVariables: getVariables,
    searchBarId: 'stockSearchBar'
}

new ApiFetcherMod(stockApiConfig);