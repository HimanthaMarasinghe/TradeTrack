const statusElement = document.getElementById('status');
const changeStatusBtn = document.getElementById('changeStatusBtn');
const itemTickBoxes = document.querySelectorAll('.Item input');

changeStatusBtn.addEventListener('click', () => {
    if (status === 'Pending') {
        fetch(`${LINKROOT}/ShopOwner/startProcessingPreOrder`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'pre_order_id=' + pre_order_id
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
            if (data.success)
                startProcessingPreOrder();
            else
                alert('Failed to set order status to processing');
        });
    }});

function startProcessingPreOrder(){
    statusElement.innerHTML = '- Processing';
    changeStatusBtn.innerHTML = "Set order status to Ready";
    changeStatusBtn.classList.add('disabled-link');
    changeStatusBtn.href = `${LINKROOT}/ShopOwner/orderReady/${pre_order_id}`;
    itemTickBoxes.forEach(input => {
        input.classList.remove('hidden');
        input.addEventListener('change', checkAllItemsTickBoxes);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    checkItemCheckBox();
    switch (status) {
        case 'Processing':
            startProcessingPreOrder();
            break;
        case 'Ready':
            changeStatusBtn.classList.add('hidden');
            statusElement.innerHTML = '- Ready';
            break;
    }
});

function checkAllItemsTickBoxes(){
    let allChecked = true;
    itemTickBoxes.forEach(input => {
        if (!input.checked)
            allChecked = false;
    });
    if (allChecked)
        changeStatusBtn.classList.remove('disabled-link');
    else
        changeStatusBtn.classList.add('disabled-link');
}

function checkItemCheckBox(){
    const itemCheckBoxesState = JSON.parse(localStorage.getItem('processingPreOrder'+pre_order_id)) || {};

    itemTickBoxes.forEach((input) => {
        const checkBoxId = input.id;
        input.checked = itemCheckBoxesState[checkBoxId] || false;
        input.addEventListener('change', () => {
            itemCheckBoxesState[checkBoxId] = input.checked;
            localStorage.setItem('processingPreOrder'+pre_order_id, JSON.stringify(itemCheckBoxesState));
            checkAllItemsTickBoxes();
        });
    });
}