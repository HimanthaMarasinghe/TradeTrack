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


// Payment--------------------------------------------------

const searchPayment = document.getElementById('searchPayment');
const paymentElements = document.getElementById('paymentElements');


// let debounceTimeout;

searchPayment.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadPaymentData(), 500)
})



function loadPaymentData() {
 
    const searchValue = searchPayment.value;
    console.log(`${LINKROOT}/Manufacturer/searchPayment/${dis_phone}?searchPay=${encodeURIComponent(searchValue)}`);
    fetch(`${LINKROOT}/Manufacturer/searchPayment/${dis_phone}?searchPay=${encodeURIComponent(searchValue)}`, {
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
            paymentElements.insertAdjacentHTML("beforeend",paymentRowTemplate(payment));
            paymentElements.lastElementChild.addEventListener("click", () =>popUpModel(payment));
        });

    })
    .catch(error => console.error('Error:', error));
    
}

function paymentRowTemplate(payment) {
    const {payment_id, status, ammount} = payment;
    return (
       `<tr class="Item clickable">
            <td class="center-al">${payment_id}</td>
            <td class="center-al">${status == 1 ? '✔️' : ''}</td>
            <td>Rs.${ammount.toFixed(2)}</td>
       </tr>`
    );
}

function popUpModel(payment){
    const {payment_id, date, time, ammount, status} = payment;

    document.getElementById('confirmPaymentId').innerText = payment_id;
    document.getElementById('confirmPaymentDate').innerText = date;
    document.getElementById('confirmPaymentTime').innerText = time;
    document.getElementById('confirmPaymentAmmount').innerText = `Rs.${ammount.toFixed(2)}`;
    document.getElementById('confirmPaymentStatus').innerText = status == 1 ? 'Confirmed' : 'Not Confirmed';
    document.getElementById('confirmPaymentForm').action = `${LINKROOT}/Manufacturer/updatePaymentStatus/${payment_id}/${dis_phone}`;

    const confirmBtn = document.getElementById('confirmPaymentBtn');

    if(status == 1) {
        confirmBtn.classList.add('hidden');
    } else {
        confirmBtn.classList.remove('hidden');
    }

    viewPopUp('confirmPaymentPopUp');
}

loadPaymentData();

document.getElementById('deleteDistributorBtn').addEventListener('click', () => deleteDistributor(dis_phone));

// Delete Distributor
function deleteDistributor(dis_phone) {
    
    fetch(`${LINKROOT}/Manufacturer/getDistributorWallet/${dis_phone}`)
        .then(response => {
             return response.json();
        })
        .then(data => {
        
            if (data.wallet === 0) {
                
                return fetch(`${LINKROOT}/Manufacturer/deleteDistributor/${dis_phone}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Failed to delete distributor');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        location.href = `${LINKROOT}/Manufacturer/distributors`;
                    } else {
                        alert("An error occurred while deleting the distributor");
                    }
                });
            } else {
              
                alert("Cannot delete distributor: Wallet balance must be 0");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred");
        });
}