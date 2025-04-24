const search = document.getElementById('search');
const elements = document.getElementById('elements');
const dateElement = document.getElementById('order_date');

let debounceTimeout;

search.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500)
})

dateElement.addEventListener('change', () => loadData());

function loadData() {
    const dateTerms = dateElement.value;
    const searchTerm = search.value;
    // console.log(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`);
    fetch(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}&date=${encodeURIComponent(dateTerms)}`, {
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

// Payment--------------------------------------------------

const searchPayment = document.getElementById('searchPayment');
const paymentElements = document.getElementById('paymentElements');
const paymentDate = document.getElementById('paymentDate');

// let debounceTimeout;

searchPayment.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadPaymentData(), 500)
})

paymentDate.addEventListener('change', () => loadPaymentData());

function loadPaymentData() {
    const dateValue = paymentDate.value;
    const searchValue = searchPayment.value;
    // console.log(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`);
    fetch(`${LINKROOT}/Distributor/searchPayment/${so_phone}?searchPay=${encodeURIComponent(searchValue)}&datePay=${encodeURIComponent(dateValue)}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        paymentElements.innerHTML = '';
        
        data.forEach(payment => {
            // paymentElements.innerHTML += paymentRowTemplate(payment);
            paymentElements.insertAdjacentHTML("beforeend",paymentRowTemplate(payment));
            paymentElements.lastElementChild.addEventListener("click", () =>popUpModel(payment));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function paymentRowTemplate(payment) {
    const {id, date, time, status, ammount} = payment;
    return (
       `<tr class="Item clickable">
            <td class="center-al">${id}</td>
            <td class="center-al">${date}</td>
            <td class="center-al">${time}</td>
            <td class="center-al">${status == 1 ? '✔️' : ''}</td>
            <td>Rs.${ammount.toFixed(2)}</td>
       </tr>`
    );
}

function popUpModel(payment){
    const {id, date, time, ammount, status} = payment;

    document.getElementById('confirmPaymentId').innerText = id;
    document.getElementById('confirmPaymentDate').innerText = date;
    document.getElementById('confirmPaymentTime').innerText = time;
    document.getElementById('confirmPaymentAmmount').innerText = `Rs.${ammount.toFixed(2)}`;
    document.getElementById('confirmPaymentStatus').innerText = status == 1 ? 'Confirmed' : 'Not Confirmed';
    document.getElementById('confirmPaymentForm').action = `${LINKROOT}/Distributor/updatePaymentStatus/${id}`;

    const confirmBtn = document.getElementById('confirmPaymentBtn');

    if(status == 1) {
        confirmBtn.classList.add('hidden');
    } else {
        confirmBtn.classList.remove('hidden');
    }

    viewPopUp('confirmPaymentPopUp');
}

loadPaymentData();