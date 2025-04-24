<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>New Product Requests</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
            </div>
            <div class="scroll-box grid g-resp-300" id="elements-Scroll-Div">
            </div>
        </div>
    </div>

</div>

<!-- add new product request popup -->
<div id="popUpBackDrop" class="hidden"></div>

<div id="productDetails" class="hidden popUpDiv colomn">
    <h2>New Product Request</h2>
    <div class="row">
        <div class="colomn">
            <h3>Product Image</h3>
            <img src="<?=ROOT?>/images/Default/Product.jpeg" id="product_image" alt="" class="default big">
        </div>
        <div class="colomn">
            <h3>Barcode Proof</h3>
            <img src="<?=ROOT?>/images/Default/Product.jpeg" id="proof_image" alt="" class="default big">
        </div>
    </div>
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
        <button class="btn fg1" id="accept-btn">Accept</button>
        <button class="btn fg1" id="reject-btn">Reject</button>
    </div>
</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Admin/productsRequests.js" type="module"></script>

<?php $this->component("footer") ?>