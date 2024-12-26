<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Pre-Order</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Customer Name</td>
                <td><?=$preOrder['name']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$preOrder['phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>N0.123, Nugegoda, Colombo</td>
            </tr>
        </table>
        <img class="profile-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    </div>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quntiti</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i = 1; $i<25; $i++){
                    echo "<tr class='Item'>
                            <td class='center-al'>$i</td>
                            <td class='left-al'>Rice 10kg</td>
                            <td>150</td>
                            <td>3</td>
                            <td>450</td>
                            <td><input type='checkbox'></td>
                        </tr>";
                }
            ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="row fg1 mg-0">
            <h2>Total</h2>
            <h2>Rs.200.00</h2>
        </div>
        <a href="<?=LINKROOT?>/Manufacturer/new/orderReady" class="btn">Set order status to ready</a>

    </div>
</div>

<?php $this->component("footer") ?>