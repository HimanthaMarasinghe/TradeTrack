<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <a href="<?=LINKROOT?>/Admin/customers">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </a>
        <h2>Customer details</h2>
        <div style="opacity: 0;">
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Customer name</td>
                <td><?=$customer['first_name']?> <?=$customer['last_name']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$customer['address']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$customer['phone']?></td>
            </tr>
        </table>
        <img 
            class="profile-img big" 
            src="<?=ROOT?>/images/Profile/<?=$customer['phone']?>.<?=$customer['pic_format']?>" 
            alt=""
            onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
    </div>
    <h2 class="center-al">History</h2>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Bill Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Shop</th>
                </tr>
            </thead>
            <tbody>
            <?php                
                if(!empty($bills)) {
                    foreach($bills as $bill){
                        echo "<tr class='Item'>
                                <td class='center-al'>" . $bill['bill_id'] . "</td>
                                <td class='left-al'>" . $bill['date'] . "</td>
                                <td class='left-al'>" . $bill['time'] . "</td>
                                <td>" . $bill['shop_name'] . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='center-al'>No bill history found</td></tr>";
                }
                ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>

<?php $this->component("footer") ?>