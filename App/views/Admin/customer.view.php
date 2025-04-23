<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Customer details</h2>
        <div>
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
                    <th>Amount</th>
                    <th>Shop</th>
                    <th>More Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 1; $i<25; $i++){
                    echo "<tr class='Item'>
                            <td class='center-al'>$i</td>
                            <td class='left-al'>2024.03.20</td>
                            <td class='left-al'>09.45 a.m.</td>
                            <td>Rs.300.00</td>
                            <td>Stores</td>
                            <td class='center-al'><button class='btn btn-mini'>More</button></td>
                        </tr>";
                }
            ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>

<?php $this->component("footer") ?>