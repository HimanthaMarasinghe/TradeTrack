<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">
    <div class="scroll-box">
        <div class="bar">
            <img src="<?=ROOT?>/images/icons/home.svg" alt="">
            <!-- <h1><?=$_SESSION['name']?></h1> -->
            <h1>Shop Name</h1>
            <div>
                <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
            </div>
        </div>

        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Cash Drawer</h2>
                <h2>Rs.4392.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Bank Balance</h2>
                <h2>Rs.7382.48</h2>
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
                <h2>Profit (Aug)</h2>
                <h2>Rs.84021.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Withdrawal (Aug)</h2>
                <h2>Rs.948302.00</h2>
            </div>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Income (Aug)</h2>
                <h2>Rs.9389.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Expenses (Aug)</h2>
                <h2>Rs.40324.00</h2>
            </div>
        </div>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction/Withdrow" class="btn fg1">Record Withdrawal</a>
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction/BankDeposit" class="btn fg1">Record Bank Deposits</a>
        </div>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction/PutCapital" class="btn fg1">Putting Capital</a>
            <a href="<?=LINKROOT?>/ShopOwner/recordTransaction" class="btn fg1">See Analytics</a>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
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