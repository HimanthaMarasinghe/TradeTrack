<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1><?=$_SESSION['manufacturer']['company_name']?></h1>
        <div>
            <!-- <img src="<?=ROOT?>/images/icons/settings.svg" alt=""> -->
            <a href="<?=LINKROOT?>/Manufacturer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>

    <div class="row fg1">
        <div class="column w-25 panel">
            <h2>Orders</h2>
             <div class="scroll-box">
             <?php
                foreach ($order as $order) { ?>

                            <a class = "card btn-card center-al" id="<?=$order['order_id']?>">
                            <div class="profile-photo">
                                <img src="<?=ROOT?>/images/Profile/SA/<?=$order['dis_phone']?>.<?=$order['pic_format']?>" alt="J"
                                    onerror="this.onerror=null; this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg';">
                            </div>
                            <div class="details center-al">
                            <span class="badge">Order ID <?=$order['order_id']?></span>
                                <h4><?=$order['date']?></h4>
                                <h4><?=$order['time']?></h4>
                                <h4><?=$order['status']?></h4>
                            </div>
                            </a>
                       <?php }
                ?>
            </div>
        </div>
        <div class="column w-75 panel">
             <br>
        <div class="w-100">
        <div class="profile-container" style="max-width:600px; margin:auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.1);">
    
                <div class="profile-header" style="text-align:center;">
                    <h2>Manufacture Profile</h2>
                 </div>

        <div class="profile-details" style="margin-top:20px;">
            <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="font-weight:bold; padding:8px 0; color:#555;">Manufacture Business Name:</td>
                <td id="dis_business_name" style="padding:8px 0; color:#333;">
                <?= $manufacturers['company_name'] ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold; padding:8px 0; color:#555;">Phone:</td>
                <td id="dis_phone" style="padding:8px 0; color:#333;">
                <?= $manufacturers['phone'] ?>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold; padding:8px 0; color:#555;">Business Address:</td>
                <td id="dis_business_address" style="padding:8px 0; color:#333;">
                <?= $manufacturers['company_address'] ?>
                </td>
            </tr>
            </table>
    </div>

</div>

            </div>
        </div>
    </div>
    <!-- Your html code goes here -->
    
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



<script>
    
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";

    // console.log(manufacturerData);
    
</script>
<script src="<?=ROOT?>/js/Manufacture/home.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>