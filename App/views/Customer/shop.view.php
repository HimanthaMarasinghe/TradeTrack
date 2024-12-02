<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$shop['shop_name']?></h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile w-100">
            <tr>
                <td>Shop owner's name</td>
                <td><?=$shop['first_name']." ".$shop['last_name']?></td>
            </tr>
            <tr>
                <td>Shop owner's Phone number</td>
                <td><?=$shop['so_phone']?></td>
            </tr>
            <tr>
                <td>Shop Address</td>
                <td><?=$shop['shop_address']?></td>
            </tr>

        <?php if($loyalty){ ?>
            <tr>
                <td><h2>Wallet</h2></td>
                <td><h2>Rs.<?=number_format($loyalty['wallet'], 2)?></h2></td>
            </tr>
            <tr>
                <td colspan="2">Loyalty customer since <?=$loyalty['since']?></td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="row max-w-900">
                        <button class="btn fg1">Reject Loyalty Privilege</button>
                        <a class="btn fg1" href="<?=LINKROOT?>/Customer/placePreOrder">Make A Pre-Order</a>
                    </div>
                </td>
            </tr>
        <?php }else{ ?>

            <tr>
                <td colspan="2"><h2>You are not a Loyalty Customer</h2></td>
            </tr>

            <tr>
                <td>
                    <div class="row max-w-900">
                        <button class="btn fg1">Request to be a Loyalty Customer</button>
                    </div>
                </td>
            </tr>

        <?php } ?>

        </table>
        <?php if(file_exists("./images/shops/".$shop['so_phone'].$shop['shop_pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/shops/<?=$shop['so_phone'].$shop['shop_pic_format']?>" alt="">
        <?php }else{ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/shops/default.jpeg" alt="">
        <?php } ?>
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

<script>
    const LINKROOT = "<?=LINKROOT?>";
</script>

<?php $this->component("footer") ?>