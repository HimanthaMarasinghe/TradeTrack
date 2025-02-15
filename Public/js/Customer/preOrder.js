import Notification from "../notification.js";

const del_notification = {
    type: 'preOrder',
    ref_id: pre_order_id
}

const reload_data_func = (type, ref_id) => {
    if(type === 'preOrder' && ref_id === pre_order_id) location.reload();
};

new Notification(reload_data_func, false, false, del_notification);


function changeStatus(status) {
    fetch(`${LINKROOT}/Customer/changePreOrderStatus/${pre_order_id}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(status)
    })
    .then(res => res.json())
    .then(data => {
        if(data) location.reload();
        else console.log('Failed to change status');
    });
}

document.getElementById('acceptBtn')?.addEventListener('click', () => changeStatus(1));
document.getElementById('cancelBtn')?.addEventListener('click', () => changeStatus(2));