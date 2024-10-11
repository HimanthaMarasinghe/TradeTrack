<?php 
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="center">
        
            <h1>Total</h1>
            <h1 id="total"><?=$total?></h1>
        
            <h2>Cash</h2>
            <input class="userInput red-text" type="text" id="cash">
        
            <h2>Change</h2>
            <span class="row">
                <h2 class="fg1 red-text" id="change">-<?=$total?></h2>
                <a href="" class="btn">Add to wallet<br>
                    <h6>(Phone number required)</h6>
                </a>
            </span>
        
            <h4>Customer's Phone number</h4>
            <input class="userInput" type="text">
        
            <h4>Customer's E-mail</h4>
            <input class="userInput" type="text">
        
                <a href="" class="btn fg1">Print the bill</a>
                <a href="" class="btn fg1">Send the bill via SMS</a>
                <a href="" class="btn fg1">Send the bill via E-mail</a>
                <a href="<?=LINKROOT?>/ShopOwner/purchaseDone" class="btn fg1">Skip</a>

    </div>
</div>

<script>
    document.getElementById('cash').addEventListener('input', function(e) {
        let change = e.target.value - document.getElementById('total').innerHTML;
        if(change < 0) {
            document.getElementById('change').classList.remove('green-text');
            e.target.classList.remove('green-text');
            document.getElementById('change').classList.add('red-text');
            e.target.classList.add('red-text');
        } else {
            document.getElementById('change').classList.remove('red-text');
            e.target.classList.remove('red-text');
            document.getElementById('change').classList.add('green-text');
            e.target.classList.add('green-text');
        }
        document.getElementById('change').innerHTML = change;
    });
</script>

<?php $this->component("footer") ?>