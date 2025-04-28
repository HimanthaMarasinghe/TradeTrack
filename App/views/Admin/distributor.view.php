<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <a href="<?=LINKROOT?>/Admin/distributors">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        </a>
        <h2>Distributor details</h2>
        <div style="opacity: 0;">
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Distributor name</td>
                <td><?=$distributor['first_name']?> <?=$distributor['last_name']?></td>
            </tr>
            <tr>
                <td>Business name</td>
                <td><?=$distributor['dis_busines_name']?></td>
            </tr>
            <tr>
                <td>Business address</td>
                <td><?=$distributor['dis_busines_address']?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$distributor['dis_phone']?></td>
            </tr>
        </table>
        <img 
        class="profile-img big" 
        src="<?=ROOT?>/images/Profile/<?=$distributor['dis_phone']?>.<?=$distributor['pic_format']?>" 
        alt=""
        onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'">
    </div>
    <h3>Orderes from shops</h3>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Order Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Shop owner phone</th>
                </tr>
            </thead>
            <tbody>
            <?php                
                if(!empty($bills)) {
                    foreach($bills as $bill){
                        echo "<tr class='Item'>
                                <td class='center-al'>" . $bill['order_id'] . "</td>
                                <td class='left-al'>" . $bill['date'] . "</td>
                                <td class='left-al'>" . $bill['time'] . "</td>
                                <td class='left-al'>" . $bill['status'] . "</td>
                                <td>" . $bill['so_phone'] . "</td>
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