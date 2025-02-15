<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <div class="coloum center-al">
            <h2>Pre-Order History</h2>
        </div>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
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
                <option value="Ready">Ready</option>
                <option value="Picked">Picked</option>
                <option value="Rejected">Rejected</option>
                <option value="Canceled">Canceled</option>
            </select>
        </div>
        <div class="scroll-box grid g-resp-300" id="elements-Scroll-Div">
        </div>
    </div>

</div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>";
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
</script>
<script src="<?=ROOT?>/js/Customer/preOrderHistory.js" type="module"></script>

<?php $this->component("footer") ?>