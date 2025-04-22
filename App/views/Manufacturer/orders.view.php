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
        <div class="row">
            <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search"  >
            <select id="Filter" class="filter-js">
                <option value="">All</option>
                <option value="Pending">Pending</option>
                <option value="Processing">Processing</option>
                <option value="Ready">Ready</option>
                <option value="Done">Done</option>
            </select>
            <input type="date" id="order_date" class="filter-js">
        </div>
        <!-- <div class="scroll-box grid g-resp-200" id="elements-Scroll-Div">
        </div> -->
    


    <!-- <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <h2>New Requests</h2> -->
            <div class="scroll-box grid g-resp-200" id="scrollBox" >
                
            <!-- </div>
        </div> -->

        <!-- <div class="panel mg-10 fg1">
        <h2>Requests in process</h2>
            <div class="scroll-box grid g-resp-300"> -->
                
            </div>
        <!-- </div>
    </div>
</div> -->
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
    <button id="submitButton" class="btn">Start Processing</button>
</div>

<script src="<?=ROOT?>/js/popUp.js"></script>

<script>
    const LINKROOT = '<?=LINKROOT?>';
    const ROOT = '<?=ROOT?>';
</script>
<script src="<?=ROOT?>/js/Manufacture/orders.js"></script>
<?php $this->component("footer") ?>