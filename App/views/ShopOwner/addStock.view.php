<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Gamunu Stores</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <p>Add stock that you receive outside of the system's order.</p>
            <p>Do you have a unique product that's not on this list? Add it to your <a href="">unique products</a>.</p>
            <div class="row">
                <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
                <!-- <button class="btn">Search</button> -->
            </div>
            <div class="scroll-box grid g-resp-300" id="productsList">
            </div>
        </div>
    </div>

</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<div id="addStock" class="popUpDiv hidden">
    <img id="popUp-prdct-image" class="profile-img big" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
    <div class="details h-50 center-al">
        <h4 id="popUp-prdct-name">product_name</h4>
        <table>
            <tr>
                <td>Unit Price</td>
                <td id="popUp-prdct-unit-price">Rs.100.00</td>
            </tr>
            <tr>
                <td>Bulk Price</td>
                <td id="popUp-prdct-bulk-price">Rs.100.00</td>
            </tr>
        </table>
    </div>
    <form class="colomn mg-10 gap-10" id="addStockForm" onsubmit="event.preventDefault();">
        <input type="hidden" id="popUp-prdct-barcode" name="barcode">
        <table>
            <tr>
                <td><label for="quantity">Quanitity</label></td>
                <td><input type="number" class="userInput" id="quantity" name="quantity"></td>
            </tr>
            <tr>
                <td><label for="cost">Cost</label></td>
                <td><input type="number" class="userInput" id="cost" name="cost"></td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="onCash-radio" name="purchaseType" value="onCash" checked> 
                </td>
                <td>
                    <label for="onCash-radio">Purchased On Cash</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="onCredit-radio" name="purchaseType" value="onCredit"> 
                </td>
                <td>
                    <label for="onCredit-radio">Purchased On Credit</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="none-radio" name="purchaseType" value="none"> 
                </td>
                <td>
                    <label for="none-radio">Do not update accounts</label>
                </td>
            </tr>
        </table>
        <button id="addStockBtn" class="btn">Add</button>
    </form>
</div>

<script src="<?=ROOT?>/js/popUp.js"></script>
<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/addStock.js"></script>

<?php $this->component("footer") ?>