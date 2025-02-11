import Notification from "./Notification.js";

const del_notification = {type: 'loyaltyReq', ref_id: cus_phone};
new Notification(false, false, false, del_notification);

document.getElementById('accept_lcr_btn').addEventListener('click', () => {
    fetch(LINKROOT+'/ShopOwner/addLoyCus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'cus_phone=' + encodeURIComponent(cus_phone)
    })
    .then(
        () => window.location.href = LINKROOT + '/ShopOwner/customer/' + cus_phone
    )
    .catch(error => console.error('Error:', error));
});