import ApiFetcherMod from "../ApiFetcherMod.js";
import Notification from "../Notification.js";

const filter = document.getElementById('Filter');

function cardTemplate(order) {
    return `
        <a class="card btn-card center-al alitem-center ${order.status}-preOrder">
            <h3 class="badge">Order Id ${order.order_id}</h3>
            <div class="profile-photo">
                <img src="${ROOT}/images/Profile/${order.dis_phone}.${order.pic_format}" 
                     alt="Profile Photo" 
                     onerror="this.src='${ROOT}/images/Profile/PhoneNumber.jpg'">
            </div>
            <div class="details center-al">
                <h2>${order.dis_busines_name}</h2>
                <h4>${order.full_name}</h4>
                <h4>${order.date} ${order.time}</h4>
                <h4 class="status">${order.status}</h4>
            </div>
        </a>
    `;
}

const getVariables = {
    search: "",
    status: ""
};

function updateGetVariables() {
    this.getVariables.search = searchBar.value;
    this.getVariables.status = filter.value;
}

const cofig = {
    api : "ShopOwner/getAllStockOrders",
    cardTemplate : cardTemplate,
    getVariables : getVariables,
    updateGetVariables : updateGetVariables,
    clickEvent: billMoreDetails
}

const apiFetcherMod = new ApiFetcherMod(cofig);

const loadDataOnNotification = (type) => {
    if(type == 'preOrder') apiFetcherMod.loadDataWithSearchOrFilter();
}

function billMoreDetails(dataset){
    const itemsList = document.getElementById('billDetailsItems');
    const nameElem = document.getElementById('More-details-bill-name');
    const phoneElem = document.getElementById('More-details-bill-phone');
    const {
        order_id,
        date,
        time,
        full_name,
        dis_phone,
        pic_format,
        status
    } = dataset;
    fetch(LINKROOT + '/ShopOwner/getOrderDetails/' + order_id)
    .then(res => res.json())
    .then(data => {
        if(data){
            const {
                total,
                items,
            } = data;
            document.getElementById('More-details-bill-id').innerText = " - " + order_id;
            document.getElementById('More-details-bill-date').innerText = " - " + date;
            document.getElementById('More-details-bill-time').innerText = " - " + time;
            document.getElementById('More-details-bill-total').innerText = 'Rs.' + total.toFixed(2);
            document.getElementById('More-details-bill-status').innerText = " - " + status;

            if (dis_phone) {
                nameElem.innerHTML = ` - <a class="link" href="${LINKROOT}/ShopOwner/Distributor/${dis_phone}">${full_name}</a>`;
                phoneElem.innerText = " - " + dis_phone;
            } else {
                nameElem.innerText = " - Unregisterd";
                phoneElem.innerText = " - Unregisterd";
            }
            const billImage = document.getElementById('More-details-bill-img');
            billImage.src = `${ROOT}/images/Profile/${dis_phone}.${pic_format}`;
            billImage.onerror = function () {
                this.src = `${ROOT}/images/Profile/PhoneNumber.jpg`;
            };
            itemsList.innerHTML = '';
            items.forEach(item => {
                const {
                    barcode,
                    product_name,
                    quantity,
                    bulk_price,
                    total
                } = item;
                // let rowTotal = quantity * bulk_price;
                itemsList.innerHTML += `
                    <tr calss='Item'>
                        <td class='center-al'>${barcode}</td>
                        <td class='left-al'>${product_name}</td>
                        <td class='center-al'>${quantity}</td>
                        <td>Rs.${bulk_price.toFixed(2)}</td>
                        <td>Rs.${total.toFixed(2)}</td>
                    </tr>
                `;
            });
            viewPopUp('BillDetails');
        } else {
            alert('Failed to get bill details');
        }
    }); 
}

new Notification(loadDataOnNotification);