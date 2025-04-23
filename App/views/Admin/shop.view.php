<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content scroll-box">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Shop Owner details</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop owner name</td>
                <td><?=$shop['first_name']?> <?=$shop['last_name']?></td>
            </tr>
            <tr>
                <td>Shop name</td>
                <td><?=$shop['shop_name']?></td>
            </tr>
            <tr>
                <td>Shop Address</td>
                <td><?=$shop['shop_address']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$shop['so_phone']?></td>
            </tr>
        </table>
        <img class="profile-img big" 
        src="<?=ROOT?>/images/Shops/<?=$shop['so_phone']?><?=$shop['shop_pic_format']?>" 
        alt=""
        onerror="this.src='<?=ROOT?>/images/Shops/default.jpeg'">
    </div>
    <h2 class="center-al">History</h2>
    <div class="billScroll h-350">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Bill Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Customer</th>
                </tr>
            </thead>
            <tbody>
                <?php                
                foreach($bills as $bill){
                    echo "<tr class='Item'>
                            <td class='center-al'>" . $bill['bill_id'] . "</td>
                            <td class='left-al'>" . $bill['date'] . "</td>
                            <td class='left-al'>" . $bill['time'] . "</td>
                            <td>" .  $bill['first_name'] . " " . $bill['last_name'] . "</td>
                        </tr>";
                }
                ?>
                
                <tr></tr>
            </tbody>
        </table>
    </div>
    <h3>Loyalty customers</h3>
    <div class="grid g-resp-200 scroll-box">
    <?php
    // Initialize the LoyaltyCustomers model
    $loyaltyModel = new LoyaltyCustomers();
    
    // Get the shop owner's phone number from the current shop data
    $shopOwnerPhone = $shop['so_phone'];
    
    // Retrieve loyalty customers for this shop (first 10 by default)
    $loyaltyCustomers = $loyaltyModel->allLoyaltyCustomers($shopOwnerPhone);
    
    // Check if we have any loyalty customers
    if (!empty($loyaltyCustomers)) {
        foreach ($loyaltyCustomers as $customer) {
            // Create path for customer profile image
            $imagePath = ROOT . '/images/Profile/';
            $imageFile = !empty($customer['pic_format']) ? 
                         $customer['phone'] . $customer['pic_format'] : 
                         'PhoneNumber.jpg';
            
            echo '<a href="' . ROOT . '/Admin/customer/' . $customer['phone'] . '" class="card btn-card colomn asp-rtio">
                    <img class="product-img" src="' . $imagePath . $imageFile . '" alt=""
                         onerror="this.src=\'' . $imagePath . 'PhoneNumber.jpg\'">
                    <div class="details h-50">
                        <h4>' . $customer['first_name'] . ' ' . $customer['last_name'] . '</h4>
                        <h4>' . $customer['address'] . '</h4>
                        <h4>' . $customer['phone'] . '</h4>
                    </div>
                  </a>';
        }
    } else {
        echo '<p>No loyalty customers found for this shop.</p>';
    }
    ?>
<?php $this->component("footer") ?>