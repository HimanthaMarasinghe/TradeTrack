document.getElementById('pay').addEventListener('click', () => viewPopUp('payPopUp'));

const searchPayment = document.getElementById('searchPayment');
const paymentElements = document.getElementById('paymentElements');
const paymentDate = document.getElementById('paymentDate');


searchPayment.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadPaymentData(), 500)
})

paymentDate.addEventListener('change', () => loadPaymentData());

function loadPaymentData() {
    const dateValue = paymentDate.value;
    const searchValue = searchPayment.value;
    // console.log(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`);
    fetch(`${LINKROOT}/Distributor/searchDisManPayment?searchPay=${encodeURIComponent(searchValue)}&datePay=${encodeURIComponent(dateValue)}`, {
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
            paymentElements.innerHTML += paymentRowTemplate(payment);
            // paymentElements.insertAdjacentHTML("beforeend",paymentRowTemplate(payment));
            // paymentElements.lastElementChild.addEventListener("click", () =>popUpModel(payment));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function paymentRowTemplate(payment) {
    const {payment_id, date, time, status, ammount} = payment;
    return (
       `<tr class="Item clickable">
            <td class="center-al">${payment_id}</td>
            <td class="center-al">${date}</td>
            <td class="center-al">${time}</td>
            <td class="center-al">${status == 1 ? '✔️' : ''}</td>
            <td>Rs.${ammount.toFixed(2)}</td>
       </tr>`
    );
}


loadPaymentData();