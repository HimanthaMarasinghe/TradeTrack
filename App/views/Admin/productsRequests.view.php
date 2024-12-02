<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Business Name</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search">
                <button class="btn">Search</button>
            </div>
            <div class="scroll-box grid g-resp-300">
                <?php
                    foreach ($pendingProducts as $stock) { 
                        $this->component('card/product', $stock, ['special' => "Request Pending"]); 
                     } ?>
            </div>
        </div>
    </div>

</div>

<!-- add new product request popup -->
<div id="popUpBackDrop" class="hidden"></div>

<div id="productDetails" class="hidden popUpDiv colomn">
    <h2>New Product Request</h2>
    <img src="<?=ROOT?>/images/Default/Product.jpeg" alt="" class="default big">
    <table>
        <h3 id="req-prd-name">Lorem ipsum dolor sit amet.</h3>
        <tr>
            <td>Barcode</td>
            <td id="req-prd-barcode"></td>
        </tr>
        <tr>
            <td>Unit Price</td>
            <td id="req-prd-price"></td>
        </tr>
        <tr>
            <td>Bulk Price</td>
            <td id="req-prd-bulk"></td>
        </tr>
    </table>
    <div class="row">
        <button class="btn fg1" id="update-btn">Accept</button>
        <button class="btn fg1" id="delete-btn">Reject</button>
    </div>
</div>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script>
    const LINKROOT = '<?=LINKROOT?>';
    const productDetailsPopUp = document.getElementById('productDetails');

    document.querySelectorAll(".card-js").forEach((card) => {
        card.addEventListener("click", function(event) {
            console.log(encodeURIComponent(event.currentTarget.id));
            fetch(LINKROOT+'/Admin/pendingProductRequestDetails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'barcodeIn=' + encodeURIComponent(event.currentTarget.id)
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('req-prd-barcode').textContent = data.barcode;
                document.getElementById('req-prd-name').textContent = data.product_name;
                document.getElementById('req-prd-price').textContent = 'Rs.' + data.unit_price.toFixed(2);
                document.getElementById('req-prd-bulk').textContent = 'Rs.' + data.bulk_price.toFixed(2);
            })
            .catch(error => console.error('Error:', error));
            viewPopUp('productDetails');
        })
    });
</script>

<?php $this->component("footer") ?>