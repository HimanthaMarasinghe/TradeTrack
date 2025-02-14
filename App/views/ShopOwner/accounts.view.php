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
                <h2>Rs.48372.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Creditors</h2>
                <h2>Rs.5432243.00</h2>
            </div>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Profit (Des)</h2>
                <h2>Rs.84021.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Withdrawal (Des)</h2>
                <h2>Rs.948302.00</h2>
            </div>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Income (Des)</h2>
                <h2>Rs.9389.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Expenses (Des)</h2>
                <h2>Rs.40324.00</h2>
            </div>
        </div>
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
                <h2>Recent Bills</h2>
                <h5>Click on any row to see more details</h5>
                <div class="billScroll">
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
                        <tbody id="bills">
                            <?php
                            foreach($recentBills as $bill){
                                echo "<tr class='Item clickable' id='".$bill['bill_id']."'>
                                        <td class='center-al'>".$bill['bill_id']."</td>
                                        <td class='left-al'>".$bill['date']."</td>
                                        <td class='left-al'>".$bill['time']."</td>
                                        <td class='left-al'>".$bill['first_name']." ".$bill['last_name']."</td>
                                        <td class='left-al'>Rs.".number_format($bill['total'],2)."</td>
                                    </tr>";
                            }
                        ?>
                            <tr></tr>
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
<div id="BillDetails" class="popUpDiv hidden">
    <h1>Bill details</h1>
    <div class="row spc-btwn w-100">
        <div class="colomn">
            <p>Bill Id</p>
            <p>Date</p>
            <p>Time</p>
            <p>Customer</p>
            <p>Customer Phone</p>
        </div>
        <div class="colomn fg1">
            <p id="More-details-bill-id"></p>
            <p id="More-details-bill-date"></p>
            <p id="More-details-bill-time"></p>
            <p id="More-details-bill-name"></p>
            <p id="More-details-bill-phone"></p>
        </div>
        <img id="More-details-bill-cus-img" class="profile-img" src="<?=ROOT?>/images/Profile/PhoneNumber.jpg" alt="">
    </div>
    <div class="billScroll">
        <table class="bill min-w-1200">
            <thead>
                <tr class="BillHeadings">
                    <th class='center-al'>Barcode</th>
                    <th class='left-al'>Product Name</th>
                    <th class='left-al'>Quantity</th>
                    <th class='left-al'>Unit Price</th>
                    <th class="left-al">Total</th>
                </tr>
            </thead>
            <tbody id="billDetailsItems">
            </tbody>
        </table>
        <h1 class="right-al" id="More-details-bill-total"></h1>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<script type="text/javascript">

const LINKROOT = "<?=LINKROOT?>";
const billDetailsItems = document.getElementById('billDetailsItems');
const bills = document.getElementById('bills');

bills.querySelectorAll('tr.Item').forEach((billItem) => {
    billItem.addEventListener('click', (e) => {
        const id = billItem.id;
        // console.log(id);
        fetch(LINKROOT+'/ShopOwner/getBillDetails/'+id)
        .then(res => res.json())
        .then(data => {
            let billTotal = 0;
            document.getElementById('More-details-bill-id').innerText = " - " + data.billDetails.bill_id;
            document.getElementById('More-details-bill-date').innerText = " - " + data.billDetails.date;
            document.getElementById('More-details-bill-time').innerText = " - " + data.billDetails.time;
            if (data.billDetails.cus_phone) {
                document.getElementById('More-details-bill-name').innerHTML = " - <a class='link' href='" + (LINKROOT + "/ShopOwner/customer/" + data.billDetails.cus_phone) + "'>" + data.billDetails.first_name + ' ' + data.billDetails.last_name + "</a>";
                document.getElementById('More-details-bill-phone').innerText = " - " + data.billDetails.cus_phone;
                document.getElementById('More-details-bill-cus-img').src = `<?=ROOT?>/images/Profile/${data.billDetails.cus_phone}.${data.billDetails.pic_format}`;
                document.getElementById('More-details-bill-cus-img').onerror = function() {this.src = `<?=ROOT?>/images/Profile/PhoneNumber.jpg`;};
            } else {
                document.getElementById('More-details-bill-name').innerText = " - Unregisterd";
                document.getElementById('More-details-bill-phone').innerText = " - Unregisterd";
                document.getElementById('More-details-bill-cus-img').src = `<?=ROOT?>/images/Profile/PhoneNumber.jpg`;
            }
            billDetailsItems.innerHTML = '';
            data.billItems.forEach(item => {
                const itemTotal = (item.sold_price*item.quantity).toFixed(2);
                billDetailsItems.innerHTML += `<tr class='Item'>
                    <td class='center-al'>${item.barcode}</td>
                    <td class='left-al'>${item.product_name}</td>
                    <td class='left-al'>${item.quantity}</td>
                    <td class='left-al'>Rs.${item.sold_price.toFixed(2)}</td>
                    <td class='left-al'>Rs.${itemTotal}</td>
                </tr>`;
                billTotal += parseFloat(itemTotal);
            });
            document.getElementById('More-details-bill-total').innerText = "Total : Rs."+billTotal.toFixed(2);
            viewPopUp('BillDetails');
        });
    });
});


    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var Assests = google.visualization.arrayToDataTable([
        ['Type', 'Amount'],
        ['Cash', 4392],
        ['Bank', 7382.48],
        ['Stock', 12000],
        ['Creditors', 5433]
    ]);

    var AssestsOptions = {
        // title: 'Assests',
        backgroundColor: { fill:'transparent' },
        pieHole: 0.4,
    };

    var profit = google.visualization.arrayToDataTable([
        ['Month', 'Expense', 'Income', 'Gross Profit'],
        ['January', 30000, 40000, 10000],
        ['February', 35000, 45000, 10000],
        ['March', 40000, 50000, 10000],
        ['April', 45000, 55000, 10000],
        ['May', 50000, 60000, 10000],
        ['June', 55000, 65000, 10000],
        ['July', 60000, 70000, 10000],
        ['August', 40324, 71359, 31035],
        ['September', 50000, 85000, 35000],
        ['October', 45000, 70000, 25000],
        ['November', 60000, 95000, 35000],
        ['December', 55000, 80000, 25000]
    ])

    var profitOp = {
        // title: 'Monthly Income, Expences, and Profit',
        backgroundColor: { fill:'transparent' },
        width: '70%',
    }

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    var curve_chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(Assests, AssestsOptions);
    curve_chart.draw(profit, profitOp);
    }
</script>
<?php $this->component("footer") ?>