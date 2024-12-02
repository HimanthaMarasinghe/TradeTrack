<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Inventory Request</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <h2>New Requests</h2>
            <div class="scroll-box grid g-resp-300">
                <?php 
                    foreach ($newOrders as $nOrder)
                    {
                        $this->component('card/order', $nOrder); 
                    }
                ?>
            </div>
        </div>

        <div class="panel mg-10 fg1">
        <h2>Requests in process</h2>
            <div class="scroll-box grid g-resp-300">
                <?php
                    foreach ($processingOrders as $pOrder)
                    {
                        $this->component('card/order', $pOrder); 
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div class="popUpDiv hidden" id="requestDetails">
    <h2>Inventory Request Details</h2>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <h3>Request Id</h3>
            <h3>Distributor Business Name</h3>
            <h3>Distributor Name</h3>
            <h3>Distributor Phone</h3>
            <h3>Date</h3>
            <h3>Time</h3>
            <h3>Total</h3>
            <h3>Status</h3>
        </div>
        <div class="colomn fg1">
            <h3 id="order_id"></h3>
            <h3 id="sa_business_name"></h3>
            <h3 id="sa_name"></h3>
            <h3 id="sa_phone"></h3>
            <h3 id="date"></h3>
            <h3 id="time"></h3>
            <h3 id="total"></h3>
            <h3 id="status"></h3>
        </div>
        <img id="dis-img" class="profile-img big" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    </div>
    <div class="billScroll">
        <table class="bill min-w-1200">
            <thead>
                <tr class="BillHeadings">
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Bulk Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="orderItems">
            </tbody>
        </table>
    </div>
    <button id="Start-processing" class="btn">Start Processing</button>
</div>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script>
    const LINKROOT = '<?= LINKROOT ?>';
    let refreshRequired = false;
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('click', function() {
            let order_id = this.id;
            let url = LINKROOT + '/Supplier/orderDetails/' + order_id;
            fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                document.getElementById('order_id').innerText = data.order_id;
                document.getElementById('sa_business_name').innerText = data.sa_busines_name;
                document.getElementById('sa_name').innerText = data.first_name + ' ' + data.last_name;
                document.getElementById('sa_phone').innerText = data.sa_phone;
                document.getElementById('date').innerText = data.date;
                document.getElementById('time').innerText = data.time;
                document.getElementById('total').innerText = 'Rs.'+data.total.toFixed(2);
                document.getElementById('status').innerText = data.status;

                if(data.status === 'Pending') {
                    document.getElementById('Start-processing').classList.remove('hidden');
                    document.getElementById('Start-processing').onclick = () => updateStatus(order_id, 'Processing');
                } else {
                    document.getElementById('Start-processing').classList.add('hidden');
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

    function updateStatus(order_id, status) {
        fetch(LINKROOT + '/Supplier/updateStatus/' + order_id + '/' + status)
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById('status').innerText = status;
                document.getElementById('Start-processing').classList.add('hidden');
                refreshRequired = true;
            }
        });
    }

    document.getElementById('popUpBackDrop').addEventListener('click', function() {
        if(refreshRequired) {
            location.reload();
        }
    });
</script>

<?php $this->component("footer") ?>