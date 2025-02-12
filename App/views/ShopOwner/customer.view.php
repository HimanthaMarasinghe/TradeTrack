<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2><?=$customer['first_name']." ".$customer['last_name']?></h2>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile w-100">
            <tr>
                <td>Phone number</td>
                <td><?=$customer['phone']?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?=$customer['address']?></td>
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
                        <button class="btn fg1" id="revoke_btn">Revoke Loyalty Privilege</button>
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
        <img 
            src="<?=ROOT?>/images/Profile/<?=$customer['phone']?>.<?=$customer['pic_format']?>" 
            class="profile-img big" 
            alt="Customers Profile Photo"
            <!-- onerror="this.src='<?=ROOT?>/images/Profile/PhoneNumber.jpg'" -->
        >
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
                <!-- <?php
                for($i = 1; $i<25; $i++){
                    echo "<tr class='Item'>
                            <td class='center-al'>$i</td>
                            <td class='left-al'>2024.03.20</td>
                            <td class='left-al'>09.45 a.m.</td>
                            <td>Rs.300.00</td>
                            <td class='center-al'><button class='btn btn-mini'>More</button></td>
                        </tr>";
                }
            ?> -->
            <?php
            // Predefined array of bills, sorted by date
            $bills = [
                ["id" => 1, "date" => "2024.03.18", "time" => "10.15 a.m.", "amount" => "Rs.450.00"],
                ["id" => 2, "date" => "2024.03.19", "time" => "11.30 a.m.", "amount" => "Rs.300.00"],
                ["id" => 3, "date" => "2024.03.20", "time" => "09.45 a.m.", "amount" => "Rs.600.00"],
                ["id" => 4, "date" => "2024.03.21", "time" => "01.00 p.m.", "amount" => "Rs.250.00"],
                ["id" => 5, "date" => "2024.03.22", "time" => "02.30 p.m.", "amount" => "Rs.500.00"],
                ["id" => 6, "date" => "2024.03.23", "time" => "03.00 p.m.", "amount" => "Rs.350.00"],
                ["id" => 7, "date" => "2024.03.24", "time" => "04.15 p.m.", "amount" => "Rs.400.00"],
                ["id" => 8, "date" => "2024.03.25", "time" => "05.45 p.m.", "amount" => "Rs.550.00"],
                ["id" => 9, "date" => "2024.03.26", "time" => "06.30 p.m.", "amount" => "Rs.200.00"],
                ["id" => 10, "date" => "2024.03.27", "time" => "07.00 p.m.", "amount" => "Rs.650.00"]
            ];

            // Sort the bills array by date if it's not already sorted
            usort($bills, function($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });

            // Generate the table rows
            foreach ($bills as $bill) {
                echo "<tr class='Item'>
                        <td class='center-al'>{$bill['id']}</td>
                        <td class='left-al'>{$bill['date']}</td>
                        <td class='left-al'>{$bill['time']}</td>
                        <td>{$bill['amount']}</td>
                        <td class='center-al'><button class='btn btn-mini'>More</button></td>
                    </tr>";
            }
            ?>

                <tr></tr>
            </tbody>
        </table>
    </div>
</div>
<div id="notification-container"></div>
<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const loy_phone = "<?=$customer['phone']?>";
    const wallet_amount = "<?=$loyalty['wallet']?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>
<script src="<?=ROOT?>/js/customer.js" type="module"></script>

<?php $this->component("footer") ?>