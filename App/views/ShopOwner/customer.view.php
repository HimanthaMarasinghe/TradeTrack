<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$customer['cus_first_name']." ".$customer['cus_last_name']?></h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile w-100">
            <tr>
                <td>Phone number</td>
                <td><?=$customer['cus_phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$customer['cus_address']?></td>
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
                        <button class="btn fg1" onclick="revokeLoyalty('<?=$customer['cus_phone']?>', '<?=$loyalty['wallet']?>')">Revoke Loyalty Privilege</button>
                        <button class="btn fg1">Update wallet</button>
                    </div>
                </td>
            </tr>
        <?php }else{ ?>

            <tr>
                <td colspan="2"><h2>Not a Loyalty Customer</h2></td>
            </tr>

            <tr>
                <td>
                    <button class="btn fg1">Invite to be a Loyalty Customer</button>
                </td>
            </tr>

        <?php } ?>

        </table>
        <?php if(file_exists("./images/Profile/".$customer['cus_phone'].".jpg")){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Profile/<?=$customer['cus_phone']?>.jpg" alt="">
        <?php }else{ ?>
        <img class="profile-img big" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
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
<script src="<?=ROOT?>/js/customer.js"></script>

<?php $this->component("footer") ?>