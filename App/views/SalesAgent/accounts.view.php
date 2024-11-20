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
            <h1>Agent Name</h1>
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
                <h2>Profit (Aug)</h2>
                <h2>Rs.84021.00</h2>
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
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Bank Deposits (Aug)</h2>
                <h2>Rs.7382.48</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Withdrawal (Aug)</h2>
                <h2>Rs.948302.00</h2>
            </div>
        </div>
        <div class="row mg-0">
            <div class="panel row w-50 spc-btwn">
                <h2>Debtors (Aug)</h2>
                <h2>Rs.48372.00</h2>
            </div>
            <div class="panel row w-50 spc-btwn">
                <h2>Creditors (Aug)</h2>
                <h2>Rs.5432243.00</h2>
            </div>
        </div>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/SalesAgent/recordTransaction" class="btn fg1">Record Withdrawal</a>
            <a href="<?=LINKROOT?>/SalesAgent/recordTransaction" class="btn fg1">Record Bank Deposits</a>
        </div>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/SalesAgent/recordTransaction" class="btn fg1">Record Payments to Creditors</a>
            <a href="<?=LINKROOT?>/SalesAgent/recordTransaction" class="btn fg1">Record Receivings from the Debtors</a>
        </div>
        <div class="row max-w-900 m-i-auto">
            <a href="<?=LINKROOT?>/SalesAgent/recordTransaction" class="btn fg1">Putting Capital</a>
            <a href="<?=LINKROOT?>/SalesAgent/recordTransaction" class="btn fg1">See Analytics</a>
        </div>
    </div>
</div>
<?php $this->component("footer") ?>