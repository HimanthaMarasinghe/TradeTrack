const searchBar = document.getElementById('searchBar');
const Filter = document.getElementById('Filter');
const dateElement = document.getElementById('order_date');
const scrollBox = document.getElementById('scrollBox');
let debounceTimeout;

searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => loadData(), 500);
});

Filter.addEventListener('change', () => loadData());
dateElement.addEventListener('change', () => loadData());

function loadData(){
    const searchTerms = searchBar.value;
    const filterTerms = Filter.value;
    const dateTerms = dateElement.value;
    fetch(LINKROOT + "/manufacturer/getOrders?search=" + searchTerms + "&filter=" + filterTerms + "&date=" + dateTerms)
    .then(response => response.json())
    .then(data => {
        renderCards(data);
    })
}

function renderCards(data) {
    scrollBox.innerHTML = '';
    data.forEach(element => {
        scrollBox.innerHTML += orderCard(element);
    });
    addEventListeners();
}

function orderCard(order) {
    const { order_id, date, time, dis_phone, status, pic_format } = order;

    var imagePath = `${ROOT}/images/Profile/SA/${dis_phone}.${pic_format}`;

    return `
        <a id="${order_id}" class="card btn-card center-al">
            <span class="badge">Order Id ${order_id}</span>
            <div class="profile-photo">
                <img src="${imagePath}" 
                     onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg';" 
                     alt="Profile">
            </div>
            <div class="details center-al">
                <h4>${date}</h4>
                <h4>${time}</h4>
                <h4>${status}</h4>
            </div>
        </a>
    `;
}

loadData();

let refreshRequired = false;
function addEventListeners() {
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', function() {
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
                        submitButton.innerText = "Delivering";
                        submitButton.classList.remove('hidden');
                        submitButton.onclick = () => updateStatus(order_id, 'Delivering');
                        break;

                        case 'Delivering':
                            submitButton.innerText = "Delivered";
                            submitButton.classList.remove('hidden');
                            submitButton.onclick = () => updateStatus(order_id, 'Delivered');
                            break;
                    
                        default :
                        submitButton.classList.add('hidden');
                }
                
                    
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
}

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