let refreshRequired = false;

document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', function() {
        console.log(this.id);
        let order_id = this.id;
        let url = LINKROOT + '/Manufacturer/orderDetails/' + order_id;
        fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById('order_id').innerText = data.order_id;
            document.getElementById('sa_business_name').innerText = data.dis_busines_name;
            document.getElementById('sa_name').innerText = data.first_name + ' ' + data.last_name;
            document.getElementById('sa_phone').innerText = data.dis_phone;
            document.getElementById('date').innerText = data.date;
            document.getElementById('time').innerText = data.time;
            document.getElementById('total').innerText = 'Rs.'+data.total.toFixed(2);
            document.getElementById('status').innerText = data.status;
            document.getElementById('dis-img').src = `${ROOT}/images/Profile/SA/${data.dis_phone}.${data.pic_format}`;
            document.getElementById('dis-img').onerror = function() {
                this.src = `${ROOT}/images/Profile/PhoneNumber.jpg`;
            };
            const submitButton =  document.getElementById('submitButton');
            switch (data.status) {
                case 'Pending':
                    submitButton.innerText = "Start Proccessing";
                    submitButton.classList.remove('hidden');
                    submitButton.onclick = () => updateStatus(order_id, 'Processing');
                    break;

                    case 'Processing':
                    submitButton.innerText = "Ready";
                    submitButton.classList.remove('hidden');
                    submitButton.onclick = () => updateStatus(order_id, 'Ready');
                    break;

                    case 'Ready':
                        submitButton.innerText = "Done";
                        submitButton.classList.remove('hidden');
                        submitButton.onclick = () => updateStatus(order_id, 'Done');
                        break;
                
                    default :
                    submitButton.classList.add('hidden');
            }
            // if(data.status === 'Pending') {
            // } else {
            //     submitButton.classList.add('hidden');
            // }
                
            let orderItems = document.getElementById('orderItems');
            orderItems.innerHTML = '';
            data.orderItems.forEach(item => {
                orderItems.innerHTML += `
                    <tr class='Item'>
                        <td class='center-al'>${item.barcode}</td>
                        <td class='left-al'>${item.product_name}</td>
                        <td>${item.quantity} Units</td>
                        <td>Rs.${item.bulk_price.toFixed(2)}</td>
                        <td>Rs.${item.total}</td>
                    </tr>
                `;
            });
            viewPopUp('requestDetails');
        });
    });
});

function updateStatus(order_id, status) {
    fetch(LINKROOT + '/Manufacturer/updateStatus/' + order_id + '/' + status)
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            document.getElementById('status').innerText = status;
            document.getElementById('submitButton').classList.add('hidden');
            refreshRequired = true;
        }
    });
}

document.getElementById('popUpBackDrop').addEventListener('click', function() {
    if(refreshRequired) {
        location.reload();
    }
});