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
                <td>Chenuka</td>
            </tr>
            <tr>
                <td>Shop name</td>
                <td>Gunarathna stores</td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>0771488164</td>
            </tr>
        </table>
        <img class="profile-img big" src="<?=ROOT?>/images/Profile/0987654321.jpg" alt="">
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
                    <th>Customer</th>
                    <th>More Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 1; $i<10; $i++){
                    echo "<tr class='Item'>
                            <td class='center-al'>$i</td>
                            <td class='left-al'>2024.03.20</td>
                            <td class='left-al'>09.45 a.m.</td>
                            <td>Rs.300.00</td>
                            <td>Bandara</td>
                            <td class='center-al'><button class='btn btn-mini'>More</button></td>
                        </tr>";
                }
            ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
    <h3>Loyalty customers</h3>
    <div class="grid g-resp-200 scroll-box">
        <?php for($x = 0; $x <6; $x++){?>
            <a href="" class="card btn-card colomn asp-rtio">
                    <img class="product-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
                    <div class="details h-50">
                        <h4>chenuka</h4>
                        <h4>111, colombo, srilanka</h4>
                        <h4>0771488164</h4>
                    </div>
            </a>
        <?php } ?>
    </div>
    <h3>Sales agents</h3>
    <div class="grid g-resp-200 scroll-box">
        <?php for($x = 0; $x <5; $x++){?>
            <a href="" class="card btn-card colomn asp-rtio">
                    <img class="product-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
                    <div class="details h-50">
                        <h4>Sumudu distributers</h4>
                        <h4>Maliban</h4>
                        <h4>0771488164</h4>
                    </div>
            </a>
        <?php } ?>
    </div>
</div>
<?php $this->component("footer") ?>