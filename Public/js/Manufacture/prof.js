const search = document.getElementById('search');
const elements = document.getElementById('elements');

let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})



function loadData() {
    
    const searchTerm = search.value;
    // console.log(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`);
    fetch(`${LINKROOT}/Manufacturer/getStocks/${dis_phone}?search=${encodeURIComponent(searchTerm)}`, {
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
            elements.innerHTML += rowTemplate(stock);
            // elements.insertAdjacentHTML("beforeend",rowTemplate(order));
            // elements.lastElementChild.addEventListener("click", () =>orderDetails(order.order_id));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function rowTemplate(stock) {
    const {product_name, barcode, quantity,  } = stock;
    return (
       `<tr class="Item">
            <td class="center-al">${product_name}</td>
            <td class="center-al">${barcode}</td>
            <td class="center-al">${quantity}</td>

       </tr>`
    );
}

loadData();