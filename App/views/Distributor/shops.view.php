<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Shops</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" id="search" class="search-bar fg1" placeholder="Search">
        <label class="row alitem-center">
            <input type="checkbox" id="loyalty" class="filter-js" checked>
            <span>Customer shops only</span>
        </label>
    </div>
    
    <!-- Shops -->
    <div class="grid g-resp-200 scroll-box" id="elements">
    <!-- <?php foreach($this->data['shops'] as $shop): ?>
        <a href="#" class="card btn-card colomn asp-rtio">
            <img class="product-img" src="<?php echo htmlspecialchars($shop['shop_pic_format']); ?>" alt="<?php echo htmlspecialchars($shop['shop_name']); ?>">
            <div class="details h-50">
                <h4><?php echo htmlspecialchars($shop['shop_name']); ?></h4>
                <h4>Address: <?php echo htmlspecialchars($shop['shop_address']); ?></h4>
                 <p>Shop Phone: <?php echo htmlspecialchars($shop['so_phone']); ?></p>
                <p>Owner: <?php echo htmlspecialchars($shop['first_name'] . ' ' . $shop['last_name']); ?></p>
            </div>
        </a> 
    <?php endforeach; ?> -->
    </div>
    
    <script>
        const LINKROOT = "<?=LINKROOT?>";
        const ROOT = "<?=ROOT?>";
    </script>
    <script src="<?=ROOT?>/js/Distributor/shops.js"></script>


<?php $this->component("footer") ?>