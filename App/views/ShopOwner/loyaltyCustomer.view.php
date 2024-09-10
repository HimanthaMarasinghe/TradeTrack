<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$loyalCus['name']?></h2>
        <div>
                <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile w-100">
            <tr>
                <td>Phone number</td>
                <td><?=$loyalCus['phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$loyalCus['address']?></td>
            </tr>
            <tr>
                <td><h2>Wallet</h2></td>
                <td><h2>Rs.1000.00</h2></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="row">
                        <button class="btn fg1">Revoke Loyalty Privilege</button>
                        <button class="btn fg1">Update wallet</button>
                    </div>
                </td>
            </tr>
        </table>
        <img class="profile-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
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