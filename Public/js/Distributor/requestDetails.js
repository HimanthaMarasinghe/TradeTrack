// const search = document.getElementById('search');
// const elements = document.getElementById('elements');
// const dateElement = document.getElementById('order_date');
// const Filter = document.getElementById('Filter');

// let debounceTimeout;

// search.addEventListener('input', () => {
//     clearTimeout(debounceTimeout);

//     debounceTimeout = setTimeout(() => loadData(), 500)
// })

// dateElement.addEventListener('change', () => loadData());

// Filter.addEventListener('change', () => loadData());

// function loadData() {
//     const filterTerms = Filter.value;
//     const dateTerms = dateElement.value;
//     const searchTerm = search.value;
    
//     // console.log(`${LINKROOT}/Distributor/searchOrders/${so_phone}?searchTerm=${encodeURIComponent(searchTerm)}`);
//     fetch(`${LINKROOT}/Distributor/searchRequestDetails?searchTerm=${encodeURIComponent(searchTerm)}&filter=${encodeURIComponent(filterTerms)}&date=${encodeURIComponent(dateTerms)}`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
//         elements.innerHTML = '';
        
//         data.forEach(order => {
//             // elements.innerHTML += rowTemplate(order);
//             elements.insertAdjacentHTML('beforeend', rowTemplate(order));
//             elements.lastElementChild.addEventListener('click', () => popUpModel(order));
//         });

//     })
//     .catch(error => console.error('Error:', error));
    
// }

// function rowTemplate(order) {
//     const { order_id, date, time, status} = order;
//     return (
//        `<tr class='Item clickable'>
//             <td class='center-al'>${order_id}</td>
//             <td class='center-al'>${date}</td>
//             <td class='center-al'>${time}</td>
//             <td class='center-al status'>${status}</td>
//         </tr>`
//     );
// }

// function popUpModel(order){
//     const { order_id, date, time, status} = order;

//     document.getElementById('requestPopUpId').innerText = order_id;
//     document.getElementById('requestPopUpDate').innerText = date;
//     document.getElementById('requestPopUpTime').innerText = time;
//     document.getElementById('requestPopUpStatus').innerText = status;

//     viewPopUp('requestPopUp');

    
// // request item popup
// const requestElements = document.getElementById('requestElements');

// function loadRequestData(order_id) {
//     fetch(`${LINKROOT}/Distributor/requestDetail/${order_id}`, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);
//         requestElements.innerHTML = '';
        
//         data.forEach(orderItem => {
//             requestElements.innerHTML += rowTemplate(orderItem);
//             // elements.insertAdjacentHTML('beforeend', rowTemplate(order));
//             // elements.lastElementChild.addEventListener('click', () => popUpModel(order));
//         });

//     })
//     .catch(error => console.error('Error:', error));
    
// }

// function rowTemplate(orderItem) {
//     const { barcode, product_name, quantity} = orderItem;
//     return (
//        `<tr class='Item clickable'>
//             <td></td>
//             <td class='center-al'>${barcode}</td>
//             <td class='center-al'>${product_name}</td>
//             <td class='center-al'>${quantity}</td>
//         </tr>`
//     );
// }

// loadRequestData();




// }

// loadData();

