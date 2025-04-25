
<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs);
    // Side menu is created here
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="Home Icon">
        <h1><?= $_SESSION['distributor']['dis_busines_name']?></h1>
        <div class="row gap-10">
                <a href="<?=LINKROOT?>/Distributor/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
                <?php $this->component("notification") ?>
                <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search Product" id="search">
                <a class="btn" href="<?=LINKROOT?>/Distributor/newInventryRequest">
                    <h4>New Inventory Request</h4>
                </a>
                <a class="btn" href="<?=LINKROOT?>/Distributor/requestDetails">
                    <h4>Request Details</h4>
                </a>
            </div>
            <div class="scroll-box grid g-resp-300" id = "elements">

            </div>
        </div>
    </div>

    <!-- Product popup -->
    <div id="popUpBackDrop" class="hidden"></div>
    <div class="popUpDiv hidden" id="productViewPopUp">
        <div>
            <img id="popUpProductImage" class="popup-image" src=""
            onerror="this.src='<?=ROOT?>/images/Default/Product.jpeg'" 
            alt="Product Image">
            <h2 id="popUpProductName">Product Name</h2>
            <table class="profile">
            <tr>
                <td><strong>Barcode</strong></td>
                <td>: <span id="popUpProductBarcode"></span></td>
            </tr>
            <tr>
                <td><strong>Quantity</strong></td>
                <td>: <span id="popUpProductQuantity"></span></td>
            </tr>
            <tr>
                <td><strong>Low Quantity Level</strong></td>
                <td>: <span id="popUpProductLowQuantityLevel"></span></td>
            </tr>
            <tr>
                <td><strong>Bulk Price</strong></td>
                <td>: <span id="popUpProductBulkPrice"></span></td>
            </tr>
            <tr>
                <td><strong>Unit Price</strong></td>
                <td>: <span id="popUpProductUnitPrice"></span></td>
            </tr>
            <tr>
                <td colspan = "2">
                    <div class="row">
                        <button class = "btn fg1" id ="editLowQuantityLevelBtn">Edit Low Quantity Level</button>
                        <a class = "btn fg1" href = "<?=LINKROOT?>/Distributor/newInventryRequest">Request Inventory</a>
                    </div>
                </td>
            </tr>
            </table>
        </div>
    </div>

    <!-- Edit Low Quantity Level PopUp -->
    <div id="editLowQuantityLevel" class="popUpDiv hidden">
        <h2>Edit Low Quantity Level</h2>
        <img id="editPopUpProductImage" class="popup-image" src=""
            onerror="this.src='<?=ROOT?>/images/Default/Product.jpeg'" 
            alt="Product Image">
        <h4 id = "editPopUpProductName"></h4>
        <table class = "profile">
            <tr>
                <td><strong>Barcode</strong></td>
                <td>: <span id="editPopUpProductBarcode"></span></td>
            </tr>
            <tr>
                <td><strong>Quantity</strong></td>
                <td>: <span id="editPopUpProductQuantity"></span></td>
            </tr>
            <tr>
                <td><strong>Low Quantity Level</strong></td>
                <td>: <span id="editPopUpProductLowQuantityLevel"></span></td>
            </tr>
        </table>
        <form 
            method="post" 
            class="colomn mg-10 gap-10" 
            id="editLowQuantityLevelForm">
            <table>
                <tr>
                    <td>Low Quantity Level</td>
                    <td><input type="number" class="userInput" id="lowQuantityLevel" name="lowQuantityLevel" min=0 required></td>
                </tr>
            </table>
            <button type="submit" class="btn" id="editSubmit">Edit Low Quantity Level</button>
        </form>
    </div>

    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
        const ws_id = "<?=$_SESSION['Distributor']['phone']?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/stock.js"></script>
    <script src ="<?=ROOT?>/js/popUp.js"></script>
    <script src='<?=ROOT?>/js/notificationConfig.js' type="module"></script>

<?php $this->component("footer") ?>
