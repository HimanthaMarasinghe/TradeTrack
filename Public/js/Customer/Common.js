export default function billMoreDetails(dataset){
    const itemsList = document.getElementById('billDetailsItems');
    const {
        bill_id,
        date,
        time,
        shop_name,
        so_phone,
        shop_pic_format
    } = dataset;
    console.log(LINKROOT + '/Customer/getBillDetails/' + bill_id);
    fetch(LINKROOT + '/Customer/getBillDetails/' + bill_id)
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
            document.getElementById('More-details-bill-name').innerHTML = ` - <a class="link" href="${LINKROOT}/Customer/shop/${so_phone}">${shop_name}</a>`;
            document.getElementById('More-details-bill-phone').innerText = " - " + so_phone;
            document.getElementById('More-details-bill-total').innerText = 'Rs.' + total.toFixed(2);
            const billImage = document.getElementById('More-details-bill-img');
            billImage.src = `${ROOT}/images/Shops/${so_phone+shop_pic_format}`;
            billImage.onerror = function () {
                this.src = `${ROOT}/images/Shops/default.jpeg`;
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