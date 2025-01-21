<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1><?=$_SESSION['shop_owner']['shop_name']?></h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>


    <div class="grid-box fg1">
        <div class="panel pre-orders-f" id="pre-orders">
            <h2>New Pre-Orders</h2>
            <a class="link" href="<?=LINKROOT?>/ShopOwner/preOrderHistory">Pre-order history</a>
            <svg id="down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path id="path-down" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                <?php if(!$preOrders){ ?>
                    <h1 class="center-al m-b-auto faded-text">No new Pre-Orders</h1>
                <?php }else{ ?>
                    <div class="scroll-box">
                <?php
                    foreach ($preOrders as $order)
                    {
                        $this->component('card/preOrder', $order); 
                    }
                ?>
                    </div>
                <?php } ?>
        </div>

        <div class="panel loyalty-cus">
            <div class="mg-0 row col-max-1024">
                <h2>Loyalty Customers</h2>
                <input type="text" class="search-bar fg1" id="searchBar" placeholder="Search">
                <!-- <button class="btn">Search</button> -->
            </div>
            <div class="scroll-box grid g-resp-300" id="elements-Scroll-Div">
            </div>
        </div>

        <div class="panel new-lc-req closed-grid" id="new-lc-req">
            <h2>New Loyalty Customer Requests</h2>
            <svg id="up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path id="path-up" d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/></svg>
            <?php if(!$newLoyalCusReq){ ?>
                <h1 class="center-al m-b-auto faded-text">No New Loyalty Customer Requests</h1>
            <?php }else{ ?>
            <div class="scroll-box">
                <?php 
                    if(!$newLoyalCusReq){
                        echo "<h3>No New Loyalty Customer Requests</h3>";
                    }else{
                        foreach ($newLoyalCusReq as $req)
                        {
                            $this->component('card/newLoyalCusReq', $req); 
                        }
                    }
                ?>
            </div>
            <?php } ?>
        </div>

    </div>
</div>

<script>
    const ROOT = '<?=ROOT?>';
    const LINKROOT = '<?=LINKROOT?>';
    const newLoyalCusReq = <?=json_encode($newLoyalCusReq)?>;
</script>
<script src="<?=ROOT?>/js/ShopOwner/customers.js"></script>
<script src="<?=ROOT?>/js/apiFetcher.js"></script>

<?php $this->component("footer") ?>