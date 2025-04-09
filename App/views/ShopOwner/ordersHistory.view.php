<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <div class="coloum center-al">
            <h1>Stock Orders History</h1>
        </div>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
        <div class="row">
            <input id="searchBar" type="text" class="search-bar fg1" placeholder="Search">
            <select id="Filter" class="filter-js">
                <option value="all">All</option>
                <option value="Pending">Pending</option>
                <option value="Processing">Processing</option>
                <option value="Ready">Delivering</option>
                <option value="Picked">Delivered</option>
            </select>
            <input type="date" id="order_Date" class="filter-js">
        </div>
        <div class="scroll-box grid g-resp-300" id="elements-Scroll-Div">
        </div>
    </div>

</div>

<!-- PopUp -->
<div id="popUpBackDrop" class="hidden"></div>
<?php $this->component("billDetails", ['role' =>'Distributor']) ?>


<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>
<script src="<?=ROOT?>/js/ShopOwner/ordersHistory.js" type="module"></script>
<script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>