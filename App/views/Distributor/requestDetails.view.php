<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <div>
        <h2 class="center-al">Request History</h2>
        <h5 class="center-al">Click on any row to see more details</h5>
        </div>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>

    <div class="row">
        <input type="text" class="search-bar fg1" placeholder="Search order" id = "searchOrders">
     </div>
    
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th class="right-al">Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

    <?php foreach ($pendingOrders as $request): ?>
        <tr class='Item clickable' id="<?=$request['order_id']?>">
            <td class='center-al'><?=$request['order_id']?></td>
            <td class='center-al'><?=$request['date']?></td>
            <td class='center-al'><?=$request['time']?></td>
            <td>Rs.<?= $request['total']; ?>.00</td>
            <td class='center-al status-<?= $request['status']; ?>'><?= $request['status']; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- Popup Modal -->
<div id="order-modal" class="order-modal">
    <div class="order-modal-content">
        <span class="order-close-btn" onclick="closeModal()">&times;</span>
        <h2>Request Details</h2>
        <hr>
        <div class="row">
            <div class="colomn">
                <h3>Request Id</h3>
                <h3>Date</h3>
                <h3>Time</h3>
                <h3>Status</h3>
            </div>
            <div class="colomn">
                <h3 id="order-modal-id"></h3>
                <h3 id="order-modal-date"></h3>
                <h3 id="order-modal-time"></h3>
                <h3 id="order-modal-status"></h3>
            </div>
        </div>
        <table class="order-details-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="order-modal-body">
            </tbody>
        </table>
        <hr>
        <h3 id="order-modal-total"></h3>
        <hr>
        <br>
        <div class="row jus-center">
            <button class="btn fg1" id="edit-btn">Edit</button>
            <button class="btn fg1" id="delete-btn">Delete</button>
            <button class="btn fg1" id="received-btn">Received</button>
        </div>
   
    </div>
</div>

<script>
function openModal(id) {
    console.log(id);
    fetch("<?=ROOT?>/Distributor/requestDetail/" + id)
        .then(response => response.json())
        .then(data => {
    console.log(data);

            const modalBody = document.getElementById("order-modal-body");
            modalBody.innerHTML = "";
            data.orderProducts.forEach(item => {
                modalBody.innerHTML += `
                    <tr>
                        <td>${item.barcode}</td>
                        <td>${item.product_name}</td>
                        <td>${item.bulk_price}</td>
                        <td>${item.quantity}</td>
                        <td>${item.bulk_price * item.quantity}</td>
                    </tr>
                `;
            });
            document.getElementById("order-modal-id").textContent = `${data.order.order_id}`;
            document.getElementById("order-modal-date").textContent = `${data.order.date}`;
            document.getElementById("order-modal-time").textContent = `${data.order.time}`;
            document.getElementById("order-modal-total").textContent = `Rs. ${data.total}.00`;
            document.getElementById("order-modal-status").textContent = `${data.order.status}`;
            if(data.order.status == "Pending"){
                document.getElementById("edit-btn").onclick = () => editOrder(data.order.order_id);
                document.getElementById("delete-btn").onclick = () => deleteOrder(data.order.order_id);
                document.getElementById("edit-btn").style.display = "block";
                document.getElementById("delete-btn").style.display = "block";
                document.getElementById("received-btn").style.display = "none";
            }else if(data.order.status == "Delivering"){
                document.getElementById("received-btn").onclick = () => orderReceived(data.order.order_id);
                document.getElementById("received-btn").style.display = "block";
                document.getElementById("edit-btn").style.display = "none";
                document.getElementById("delete-btn").style.display = "none";
            }
             else {
                document.getElementById("edit-btn").style.display = "none";
                document.getElementById("delete-btn").style.display = "none";
                document.getElementById("received-btn").style.display = "none";
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    
    const modal = document.getElementById("order-modal");
    modal.style.display = "flex"; // Use flex to enable centering
}

function closeModal() {
    const modal = document.getElementById("order-modal");
    modal.style.display = "none";
}

document.querySelectorAll(".clickable").forEach(item => {
    item.addEventListener("click", () => openModal(item.id));
});

function editOrder(id) {
    // alert("Edit order clicked!" + id);
    location.href = "<?=ROOT?>/Distributor/editInventoryRequest/" + id;
}

function deleteOrder(id) {
    // alert("Delete order clicked!" + id);
    fetch("<?=ROOT?>/Distributor/deleteOrder/" + id, {
        method: "DELETE"
    })
    .then(response => response.json())
    .then(data => {
        if(data.success)
            location.reload();
        else
            alert(data.error);
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function orderReceived(id){
    // window.location.href = "<?=ROOT?>/Distributor/receivedInventory";
    fetch( "<?=ROOT?>/Distributor/receivedInventory/" + id, {
        method: "POST"
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Stock Updated');
            location.reload();
        }
    })
}

//Search function
const searchInput = document.getElementById('searchOrders');
    const rows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function () {
        const value = this.value.toLowerCase();

        rows.forEach(row => {
            const id = row.children[0].textContent.toLowerCase();     
            const date = row.children[1].textContent.toLowerCase(); 
            const status = row.children[4].textContent.toLowerCase(); 

            if (id.includes(value) || date.includes(value) || status.includes(value)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });


</script>

<?php $this->component("footer") ?>
                 

               