const search = document.getElementById('search');
const elements = document.getElementById('elements');
let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})

function loadData() {
    const searchTerm = search.value;
    console.log(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`);
    fetch(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`, {
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
            elements.insertAdjacentHTML("beforeend",rowTemplate(order));
            elements.lastElementChild.addEventListener("click", () =>orderDetails(order.order_id));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function rowTemplate(order) {
    const {order_id, date, time, status,total } = order;
    return (
       `<tr class="Item clickable">
            <td class="center-al">${order_id}</td>
            <td class="center-al">${date}</td>
            <td class="center-al">${time}</td>
            <td class="center-al">${status}</td>
            <td>Rs.${total.toFixed(2)}</td>
       </tr>`
    );
}

loadData();

function orderDetails(order_id){
    window.location.href = `${LINKROOT}/Distributor/orderDetails/${order_id}`;
}