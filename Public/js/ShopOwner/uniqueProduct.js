import Notification from "../Notification.js";

new Notification();

document.getElementById('openPopUp').addEventListener('click', () => viewPopUp('addStock'));

document.getElementById('addStockBtn').addEventListener('click', () => {
    const form = document.getElementById('addStockForm');
    if (form.reportValidity()){
        const formData = new FormData(form);
        fetch(`${LINKROOT}/ShopOwner/addStock`, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Stock added successfully");
                document.getElementById('currentStk').innerText = data.new_stock;
                form.reset();
            } else {
                alert('An error occurred');
            }
            closePopUp();
        })
    }
});