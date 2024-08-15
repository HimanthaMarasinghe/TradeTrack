<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center">
        <div class="billSettle-item">
            <h1>Total</h1>
            <h1>10,000</h1>
        </div>
        <div class="billSettle-item">
            <h2>Cash</h2>
            <input type="text">
        </div>
        <div class="billSettle-item">
            <h2>Change</h2>
            <div class="row">
                <h2>500</h2>
                <a href="" class="btn">Add to wallet<br>
                    <h6>(Phone number required)</h6>
                </a>
            </div>
        </div>
        <div class="billSettle-item">
            <h4>Customer's Phone number</h4>
            <input type="text">
        </div>
        <div class="billSettle-item">
            <h4>Customer's E-mail</h4>
            <input type="text">
        </div>
        <div class="billSettle-item">
            <div class="btn-div">
                <a href="" class="btn fg1">Print the bill</a>
                <a href="" class="btn fg1">Send the bill via SMS</a>
                <a href="" class="btn fg1">Send the bill via E-mail</a>
                <a href="" class="btn fg1">Skip</a>
            </div>
        </div>

    </div>
</div>

<?php $this->component("footer") ?>