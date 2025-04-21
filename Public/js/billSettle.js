import Notification from "./notification.js";
new Notification(false, false, true);

let change = -document.getElementById('total').value;
let changeElement = document.getElementById('change');
let walletUpdate = document.getElementById('wallet-update');
let cus_details = document.getElementById('cus-details');
let print = document.getElementById('print');
let skip = document.getElementById('skip');

let hw0 = document.querySelectorAll('.hw0');
let hwl = document.querySelectorAll('.hwl');
let hwg = document.querySelector('.hwg');
let lc  = document.querySelectorAll('.lc');

let phoneValid = true;
let isRegistered = false;
let isLoyalty = false;

document.getElementById('cash').addEventListener('input', function(e) {
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
    change = e.target.value - document.getElementById('total').value;
    
    if(change !== 0) {
        hw0.forEach(element => {
            element.classList.remove('hidden');
        });
        document.getElementById('wallet-update').disabled = false;
    } else {
        hw0.forEach(element => {
            element.classList.add('hidden');
        });
        document.getElementById('wallet-update').disabled = true;
    }

    if(change < 0) {
        changeElement.classList.remove('green-text');
        e.target.classList.remove('green-text');
        changeElement.classList.add('red-text');
        e.target.classList.add('red-text');
        document.getElementById('wallet-update').value = change;
        hwl.forEach(element => {
            element.classList.add('hidden');
        });
    } else {
        changeElement.classList.remove('red-text');
        e.target.classList.remove('red-text');
        changeElement.classList.add('green-text');
        e.target.classList.add('green-text');
        hwg.classList.add('hidden');
        document.getElementById('wallet-update').value = 0;
    }
    changeElement.value = change;
    document.getElementById('change-loyaltyBox').value = change;
    document.getElementById('return-to-cus').value =change;
});

// document.getElementById('cus-email').addEventListener('input', function(e) {
//     if(e.target.checkValidity() && e.target.value.length > 0) {
//         document.getElementById('email-bill').classList.remove('disabled-link');
//         e.target.classList.remove('red-text');
//         e.target.classList.add('green-text');
//     } else {
//         document.getElementById('email-bill').classList.add('disabled-link');
//         e.target.classList.remove('green-text');
//         e.target.classList.add('red-text');
//     }
// });

document.getElementById('cus-phone').addEventListener('input', function(e) {
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
    if (e.target.value.length > 10) {
        e.target.value = e.target.value.substring(10);
    }
    if (vaildatePhone(e.target.value)) {
        phoneValid = true;
        e.target.classList.remove('red-text');
        e.target.classList.add('green-text');
        // document.getElementById('sms-bill').classList.remove('disabled-link');
        fetch(LINKROOT+'/ShopOwner/checkCustomer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'cus-phone=' + encodeURIComponent(e.target.value)
        }).then(response => response.json())
        .then(data => {
            if(data){
                isRegistered = true;
                console.log(data);
                document.getElementById('cus-img').src = ROOT+'/images/Profile/' + e.target.value + '.jpg';
                document.getElementById('cus-img').onerror = function() {
                    this.src = ROOT + '/images/Profile/PhoneNumber.jpg';
                };
                document.getElementById('cus-name').innerText = data.first_name + ' ' + data.last_name;
                document.getElementById('cus-address').innerText = data.address;
                document.getElementById('loayalty').innerText = data.loyalty ? 'Is a loyalty customer' : 'Not a loyalty customer';
                if(data.loyalty){
                    isLoyalty = true;
                    document.getElementById('wallet').value = 'Rs. ' + data.loyalty.wallet;
                }
                else{
                    isLoyalty = false;
                }
            }else{
                isRegistered = false;
                isLoyalty = false;
            }
            updateUI();
        }).catch(error => console.error('Error:', error));
    } else {
        phoneValid = false;
        isRegistered = false;
        isLoyalty = false;
        e.target.classList.remove('green-text');
        e.target.classList.add('red-text');
        updateUI();
        // document.getElementById('sms-bill').classList.add('disabled-link');
        cus_details.classList.add('hidden');
    }

    if(e.target.value == '' || phoneValid){
        skip.classList.remove('disabled-link');
        print.classList.remove('disabled-link');
    } else {
        skip.classList.add('disabled-link');
        print.classList.add('disabled-link');
    }
});

document.getElementById('return-to-cus').addEventListener('input', function(e) {
    e.target.value = e.target.value < 0 ? e.target.value*(-1) : e.target.value;
    e.target.value = e.target.value > change ? change : e.target.value;
    document.getElementById('wallet-update').value = change - e.target.value;
});

function vaildatePhone(phone) {
    const regex = /^\d{10}$/;
    return regex.test(phone);
}

skip.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('bill-form').submit();
});

print.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('bill-date').innerText = 'Date : ' + new Date().toLocaleDateString();
    document.getElementById('bill-time').innerText = 'Time : ' + new Date().toLocaleTimeString();
    window.print();
    document.getElementById('bill-form').submit();
});

document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter' && phoneValid) {
        document.getElementById('print').click();
    }
});

function updateUI(){
    if(isRegistered){
        cus_details.classList.remove('hidden');
        if(isLoyalty){
            lc.forEach(element => {
                element.classList.remove('hidden');
            });
            if(change < 0){
                hwl.forEach(element => {
                    element.classList.add('hidden');
                });
            }else if(change > 0){
                hwg.classList.add('hidden');
            }else{
                hw0.forEach(element => {
                    element.classList.add('hidden');
                });
            }
        }else{
            lc.forEach(element => {
                element.classList.add('hidden');
            });
        }
    } else {
        cus_details.classList.add('hidden');
    }

    if(isLoyalty && change != 0){
        walletUpdate.disabled = false;
    } else {
        walletUpdate.disabled = true;
    }
}