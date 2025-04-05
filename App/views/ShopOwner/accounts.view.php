<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.

?>

<div class="main-content colomn">
    <div class="scroll-box">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h1><?=$_SESSION['shop_owner']['shop_name']?></h1>
            <div class="row gap-10">
                <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
            </div>
        </div>

        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Cash Drawer</h2>
                <h2>Rs.<?=number_format($_SESSION['shop_owner']['cash_drawer_balance'], 2)?></h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Bank Balance</h2>
                <h2>Rs.<?=number_format($_SESSION['shop_owner']['bank_balance'], 2)?></h2>
            </div>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Debtors</h2>
                <h2>Rs.<?=number_format($debtors,2)?></h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Creditors</h2>
                <h2>Rs.<?=number_format($creditors,2)?></h2>
            </div>
        </div>
        <br>
        <br>
        <div class="row spc-btwn w-50 m-i-auto">
            <svg id="pre_Mo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M9.4 278.6c-12.5-12.5-12.5-32.8 0-45.3l128-128c9.2-9.2 22.9-11.9 34.9-6.9s19.8 16.6 19.8 29.6l0 256c0 12.9-7.8 24.6-19.8 29.6s-25.7 2.2-34.9-6.9l-128-128z"/></svg>
            <div  class="row">
                <h2 id="monthYear"><?=date('F Y')?></h2>
                <input type="month" id="monthInput" max="<?php echo date('Y-m'); ?>" value="<?php echo date('Y-m'); ?>">
                <svg id="down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
            </div>
            <svg id="next_Mo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M246.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-9.2-9.2-22.9-11.9-34.9-6.9s-19.8 16.6-19.8 29.6l0 256c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l128-128z"/></svg>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Profit</h2>
                <h2>Rs.84021.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Withdrawal</h2>
                <h2>Rs.948302.00</h2>
            </div>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Income</h2>
                <h2 id="income">Rs.00.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Expenses</h2>
                <h2 id="expenses">Rs.00.00</h2>
            </div>
        </div>
        <br>
        <br>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction/Withdrow" class="btn fg1">Record Withdrawal</a>
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction/BankDeposit" class="btn fg1">Record Bank Deposits</a>
        </div>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction/PutCapital" class="btn fg1">Putting Capital</a>
            <a href="<?=LINKROOT?>/ShopOwner/ProfitandLossStatement" target="_blank" class="btn fg1">See Analytics</a>
        </div>
        <br>
        <div class="row mg-10 gap-10">
            <div class="colomn fg1">
            <div class="mg-0 row col-max-1024">
                <h2>Bills</h2>
                <input type="text" class="search-bar fg1" id="bill-searchBar" placeholder="Search">
                <input type="date" id="bill_Date" class="filter-js-bill">
            </div>
                <h5>Click on any row to see more details</h5>
                <div class="billScroll" id="billScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th class='center-al'>Bill Id</th>
                                <th class='left-al'>Date</th>
                                <th class='left-al'>Time</th>
                                <th class='left-al'>Customer</th>
                                <th class="left-al">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="billTbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="colomn fg1">
                <h2>Other expences (December)</h2>
                <h5>Click on any row to see more details</h5>
                <div class="billScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th class='center-al'>Id</th>
                                <th class='left-al'>Date</th>
                                <th class='left-al'>Time</th>
                                <th class='left-al'>Type</th>
                                <th class="left-al">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for($i = 1; $i<16; $i++){
                                echo "<tr class='Item'>
                                        <td class='center-al'>$i</td>
                                        <td class='left-al'>2024.03.20</td>
                                        <td class='left-al'>09.45 a.m.</td>
                                        <td class='left-al'>Utility Bill</td>
                                        <td class='left-al'>Rs.300.00</td>
                                    </tr>";
                            }
                        ?>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <br>
        <br>
        <br>
        <br>

        <h2>Current Assets</h2>
        <div id="donutchart" style="width: 900px; height: 500px; margin: 10px auto"></div>
        <h2>Monthly Income, Expences, and Gross Profit</h2>
        <div id="curve_chart" style="height: 500px; margin: 10px auto"></div>
    </div>
</div>


<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<?php $this->component("billDetails", [$role = 'Shop_Owner']) ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<script type="text/javascript">
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/accounts.js" type="module"></script>
<script src="<?=ROOT?>/js/ShopOwner/accountsCharts.js"></script>

<?php $this->component("footer") ?>