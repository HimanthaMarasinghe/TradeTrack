export default function billMoreDetails(dataset){
    const itemsList = document.getElementById('billDetailsItems');
    const nameElem = document.getElementById('More-details-bill-name');
    const phoneElem = document.getElementById('More-details-bill-phone');
    const {
        bill_id,
        date,
        time,
        first_name,
        last_name,
        cus_phone,
        pic_format
    } = dataset;
    console.log(LINKROOT + '/ShopOwner/getBillDetails/' + bill_id);
    fetch(LINKROOT + '/ShopOwner/getBillDetails/' + bill_id)
    .then(res => res.json())
    .then(data => {
        if(data){
            const {
                total,
                billItems
            } = data;
            document.getElementById('More-details-bill-id').innerText = " - " + bill_id;
            document.getElementById('More-details-bill-date').innerText = " - " + date;
            document.getElementById('More-details-bill-time').innerText = " - " + time;
            document.getElementById('More-details-bill-total').innerText = 'Rs.' + total.toFixed(2);

            if (cus_phone) {
                nameElem.innerHTML = ` - <a class="link" href="${LINKROOT}/ShopOwner/Customer/${cus_phone}">${first_name} ${last_name}</a>`;
                phoneElem.innerText = " - " + cus_phone;
            } else {
                nameElem.innerText = " - Unregisterd";
                phoneElem.innerText = " - Unregisterd";
            }
            const billImage = document.getElementById('More-details-bill-img');
            billImage.src = `${ROOT}/images/Profile/${cus_phone}.${pic_format}`;
            billImage.onerror = function () {
                this.src = `${ROOT}/images/Profile/PhoneNumber.jpg`;
            };
            itemsList.innerHTML = '';
            billItems.forEach(item => {
                const {
                    barcode,
                    product_name,
                    quantity,
                    sold_price
                } = item;
                let rowTotal = quantity * sold_price;
                itemsList.innerHTML += `
                    <tr calss='Item'>
                        <td class='center-al'>${barcode}</td>
                        <td class='left-al'>${product_name}</td>
                        <td class='center-al'>${quantity}</td>
                        <td>Rs.${sold_price.toFixed(2)}</td>
                        <td>Rs.${rowTotal.toFixed(2)}</td>
                    </tr>
                `;
            });
            viewPopUp('BillDetails');
        } else {
            alert('Failed to get bill details');
        }
    }); 
}

export function orderMoreDetails(dataset){
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