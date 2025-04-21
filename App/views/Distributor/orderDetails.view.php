<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Order <?=$order['order_id']?></h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop Name</td>
                <td><?=$order['shop_name']?></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td><?=$order['so_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$order['shop_address']?></td>
            </tr>
            <tr>
                <td>Date</td>
                <td><?=$order['date']?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?=$order['status']?></td>
            </tr>
        </table>
        <img 
        class="profile-img" 
        src="<?=ROOT?>/images/shops/<?=$order['so_phone']?><?=$order['shop_pic_format']?>"
        onerror="this.src='<?=ROOT?>/images/shops/Default.jpeg'" 
        alt="shop image">
    </div>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Sold Bulk Price</th>
                    <th>Quntity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                foreach($orderItems as $item){ 
                    $i++;
                    ?>
                    <tr class='Item'>
                            <td class='center-al'><?=$i?></td>
                            <td class='left-al'><?=$item['product_name']?></td>
                            <td>Rs.<?=number_format($item['sold_bulk_price'],2)?></td>
                            <td><?=$item['quantity']?> <?=$item['unit_type']?></td>
                            <td><?=number_format($item['total'],2)?></td>
                            <td><input type='checkbox'></td>
                        </tr>
                    <?php } ?>
                <tr></tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="row fg1 mg-0">
            <h2>Total</h2>
            <h2>Rs.<?=number_format($netTotal,2)?></h2>
        </div>
        <a href="#" class="btn">Set order status to ready</a>

    </div>
</div>

<?php $this->component("footer") ?>