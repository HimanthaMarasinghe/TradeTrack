<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.

?>

<div class="main-content colomn">
    <div class="scroll-box">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <h1>Accounts</h1>
            <div class="row gap-10">
                <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
            </div>
        </div>

        <div class="panel p-i-50 m-i-100 balance spc-btwn mg-0">
            <div class="row w-100 spc-btwn">
                <h1>Cash Drawer</h1>
                <h1 id="cash_drawer">Rs.<?=number_format($cashDrawerBallance, 2)?></h1>
            </div>
            <h4 class="red-text hidden" id="negative-balance-warning">Warning: The Cash Drawer balance is below zero. You might have missed recording a cash inflow.</h4>
        </div>
        <div class="row p-i-100 mg-0">
            <div class="panel p-i-50 row w-50 spc-btwn">
                <h2>Debtors</h2>
                <h2>Rs.<?=number_format($debtors,2)?></h2>
            </div>
            <div class="panel p-i-50 row w-50 spc-btwn">
                <h2>Creditors</h2>
                <h2>Rs.<?=number_format($creditors,2)?></h2>
            </div>
        </div>
        <br>
        <br>
        <div class="panel m-i-100">
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
                    <h2>Income</h2>
                    <h2 id="income">Rs.00.00</h2>
                </div>
                <div class="panel row w-50 spc-btwn">
                    <h2>Expenses</h2>
                    <h2 id="expenses">Rs.xxx.xx</h2>
                </div>
                <div class="panel row w-50 spc-btwn">
                    <h2>Profit</h2>
                    <h2 id="profit">Rs.84021.00</h2>
                </div>
            </div>
        </div>
        <br>
        <!-- <div class="panel m-i-100">
            <h2>Monthly Income, Expences, and Gross Profit</h2>
            <div id="curve_chart" style="height: 500px;"></div>
        </div> -->
        <br>
        <br>
        <div class="row m-i-auto">
            <a class="btn fg1" id="rec_withdraw">Cash Drawer Withdrawal</a>
            <a class="btn fg1" id="rec_cash_in">Add Cash to Drawer</a>
            <a class="btn fg1" id="rec_expence">Record Expences</a>
            <!-- <a class="btn fg1" id="repor">Cash Flow Statement</a> -->
        </div>
        <br>
        <div class="row mg-10 gap-10">
            <div class="colomn fg1 panel">
            <div class="mg-0 row col-max-1024">
                <h2>Bills</h2>
                <input type="text" class="search-bar fg1" id="bill-searchBar" placeholder="Search by bill id or customer name">
                <input type="date" id="bill_Date" class="filter-js-bill">
            </div>
                <h5>Click on any row to see more details</h5>
                <div class="billScroll h-350" id="billScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th class='center-al'>Bill Id</th>
                                <th class='left-al'>Date</th>
                                <th class='left-al'>Time</th>
                                <th class='left-al'>Customer</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="billTbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="colomn fg1 panel">
            <div class="mg-0 row col-max-1024">
                <h2>Recived Stocks</h2>
                <input type="text" class="search-bar fg1" id="order-searchBar" placeholder="Search by order id">
                <input type="date" id="order_Date" class="filter-js-order">
            </div>
                <h5>Click on any row to see more details</h5>
                <div class="billScroll h-350" id="orderScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th class='center-al'>Id</th>
                                <th class='left-al'>Date</th>
                                <th class='left-al'>Time</th>
                                <th class='left-al'>Distributor</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="orderTbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="row mg-10 gap-10">
            <div class="colomn fg1 panel">
            <div class="mg-0 row col-max-1024">
                <h2 class="fg1">Cash Added to / Withdrawn from Drawer</h2>
                <input type="text" class="hidden" id="cash-add-searchBar" placeholder="Search"> 
                <!-- This search-bar is used because apiFetcher required a search field. It is hidden because seaching cash flow is useless. -->
                <input type="date" id="cash-add_Date" class="filter-js-cash-add">
            </div>
                <div class="billScroll h-350" id="cash-add-scroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th class='center-al'>Date</th>
                                <th class='center-al'>Time</th>
                                <th class='left-al'>Type</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="cash-add-Tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="colomn fg1 panel">
            <div class="mg-0 row col-max-1024">
                <h2 class="fg1">Other expences</h2>
                <input type="text" class="search-bar fg1 hidden" id="expences-searchBar" placeholder="Search">
                <!-- This search-bar is used because apiFetcher required a search field. It is hidden because seaching cash flow is useless. -->
                <select id="expence-type" class="filter-js-expences" name="type">
                    <option value="all" selected>All</option>
                    <option value="Electricity">Electricity</option>
                    <option value="Water">Water</option>
                    <option value="Telephone">Telephone</option>
                    <option value="Rent">Rent</option>
                    <option value="Tax">Tax</option>
                    <option value="Payed to Creditors">Payed to Creditors (Unregisterd)</option>
                    <option value="Other">Other</option>
                </select>
                <input type="date" id="expences_Date" class="filter-js-expences">
            </div>
                <div class="billScroll h-350" id="expenceScroll">
                    <table class="bill">
                        <thead>
                            <tr class="BillHeadings">
                                <th class='center-al'>Date</th>
                                <th class='center-al'>Time</th>
                                <th class='center-al'>Payed from Drawer</th>
                                <th class='left-al'>Type</th>
                                <th class="left-al">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="expencesTbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<?php $this->component("billDetails", [$role = 'Shop_Owner']) ?>

<div id="expence" class="popUpDiv hidden">
    <h2>Record Expence</h2>
    <form id="expence_form">
    <table class="profile">
        <tr>
            <td>Date</td>
            <td><input class="userInput" type="date" name="date" required></td>
        </tr>
        <tr>
            <td>Time</td>
            <td><input class="userInput" type="time" name="time" required></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><select class="userInput w-100" name="type">
                <option value="Electricity" selected>Electricity</option>
                <option value="Water">Water</option>
                <option value="Telephone">Telephone</option>
                <option value="Rent">Rent</option>
                <option value="Tax">Tax</option>
                <option value="Payed to Creditors">Payed to Creditors</option>
                <option value="Other">Other</option>
            </select></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="exp_from_cash_drawer" name="cashDrawer" checked></td>
            <td>
                <label for="exp_from_cash_drawer">
                    Paid from cash drawer
                </label>
            </td>
        </tr>
        <tr>
            <td>Amount</td>
            <td>
                <input class="userInput" type="number" name="amount" id="exp_amount" min="1" max="<?=$cashDrawerBallance?>" required>
            </td>
        </tr>
    </table>
    <button type="button" id="record_expence" class="btn w-75 m-i-auto">Record</button>
    </form>
</div>

<div id="withdraw" class="popUpDiv hidden">
    <h2>Cash Drawer Withdrawal</h2>
    <form id="withdraw_form">
    <table class="profile">
        <tr>
            <td>Date</td>
            <td><input class="userInput" name="date" type="date" required></td>
        </tr>
        <tr>
            <td>Time</td>
            <td><input class="userInput" name="time" type="time" required></td>
        </tr>
        <tr>
            <td>Type</td>
            <td><select class="userInput w-100" name="type">
                <option value="Personnel Use">Personnel Use</option>
                <option value="Bank Deposit">Bank Deposit</option>
                <option value="Invest in other businesses">Invest in other businesses</option>
                <option value="Other">Other</option>
            </select></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td>
                <input class="userInput" type="number" name="amount" id="withdraw_amount" min="1" max="<?=$cashDrawerBallance?>" required>
            </td>
        </tr>
    </table>
    <button id="record_withdrwal" type="button" class="btn w-75 m-i-auto">Record</button>
    </form>
</div>

<div id="cash_in" class="popUpDiv hidden">
    <h2>Add Cash to Drawer</h2>
    <form id="cash_in_form">
    <table class="profile">
        <tr>
            <td>Date</td>
            <td><input class="userInput" type="date" name="date" required></td>
        </tr>
        <tr>
            <td>Time</td>
            <td><input class="userInput" name="time" type="time" required></td>
        </tr>
        <tr>
            <td>Amount</td>
            <td>
                <input class="userInput" type="number" name="amount" min="1" required>
            </td>
        </tr>
    </table>
    <input name="type" value="Add cash in" class="hidden" required readonly>
    <button id="record_cash_in" type="button" class="btn w-75 m-i-auto">Record</button>
    </form>
</div>

<?php $this->component("orderDetails") ?>

<script src="<?=ROOT?>/js/popUp.js"></script>

<script type="text/javascript">
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
    var cashDrawerBallance = <?=$cashDrawerBallance?>;
</script>
<script src="<?=ROOT?>/js/ShopOwner/accounts.js" type="module"></script>

<?php $this->component("footer") ?>