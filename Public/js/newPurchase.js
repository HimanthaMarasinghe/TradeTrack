let qtyElement = document.getElementById('qty');
let barCodeElement = document.getElementById('barCode');
let validBill = false; //set to true when at least one item is in the bill.

barCodeElement.addEventListener('input', function (e) {
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;    
    var product_name = document.getElementById('product-name');
    var unit_price = document.getElementById('unit-price');
    var product_pic = document.getElementById('product-pic');
    product_name.value = '';
    unit_price.value = '';
    product_pic.src = ROOT+'/images/Default/Product.jpeg';
    document.getElementById('qty').value = '';
    document.getElementById('total').value = '';

    if (e.target.value.length > 13) {
        e.target.value = e.target.value.substring(13);
    }

    if (e.target.value.length === 13) {
        fetch(LINKROOT+'/ShopOwnerPost/addBillItem', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'barcodeIn=' + encodeURIComponent(e.target.value)
            })
            .then(response => response.json())
            .then(data => {
                product_name.value = data.product_name;
                unit_price.value = data.unit_price;
                product_pic.src = ROOT+'/images/Products/' + data.barcode + '.' + data.pic_format;
                qtyElement.focus();
            })
            .catch(error => console.error('Error:', error));
        e.target.focus();
    }
});

qtyElement.addEventListener('input', function (e) {
    e.target.value = e.target.value == 0 ? 1 : e.target.value;
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
    var qty = e.target.value;
    var unitPrice = document.getElementById('unit-price').value;
    document.getElementById('total').value = qty * unitPrice;

});


document.getElementById("addBtn").addEventListener('click', function (e) {
    var barcode = barCodeElement.value;
    var product_name = document.getElementById('product-name').value;
    var unit_price = document.getElementById('unit-price').value;
    var qty = document.getElementById('qty').value;
    var total = document.getElementById('total').value;

    if (barcode === '' || product_name === '' || unit_price === '') {
        barCodeElement.focus();
        return;
    }

    if (qty === '') {
        document.getElementById('qty').focus();
        return;
    }

    validBill = true;
    fetch(LINKROOT+'/ShopOwnerPost/addBillItemToSession', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: '&qty=' + encodeURIComponent(qty)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('bill').innerHTML = '';
                data.bill.forEach(element => {
                    document.getElementById('bill').innerHTML += `<tr class='Item'>
                                                                <td class='center-al'></td>
                                                                <td class='left-al'>${element['name']}</td>
                                                                <td>${element['price']}</td>
                                                                <td>${element['qty']}</td>
                                                                <td>${element['qty']*element['price']}</td>
                                                                </tr>`;
                });
                document.getElementById('bill-Total').innerText = data.total;
            })
            .catch(error => console.error('Error:', error));
    document.getElementById('cashPayBtn').classList.remove('disabled-link');
    barCodeElement.focus();
});

document.addEventListener('keydown', function(event) {
    if (event.key === '+') {
        document.getElementById('addBtn').click();
    }
    if (event.key === 'Enter' && validBill) {
        document.getElementById('cashPayBtn').click();
    }
});
