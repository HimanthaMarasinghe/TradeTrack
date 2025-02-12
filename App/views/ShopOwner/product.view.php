<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Product Details</h1>
        <div class="row gap-10">
            <a href="<?=LINKROOT?>/ShopOwner/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
            <?php $this->component("notification") ?>
            <a href="<?=LINKROOT?>/ShopOwner/profileUpdate"><img src="<?=ROOT?>/images/icons/Profile.svg" alt=""></a>
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Product Name</td>
                <td><?=$product['product_name']?></td>
            </tr>
            <tr>
                <td>Barcode</td>
                <td><?=$product['barcode']?></td>
            </tr>
            <tr>
                <td>Unit Price</td>
                <td>Rs.<?= number_format($product['unit_price'], 2) ?></td>
            </tr>
            <!-- <tr>
                <td colspan="2">
                    <button onclick="addLoyCustmer('<?=$product['cus_phone']?>')" class="btn">Accept Loyalty Customer Request</button>
                </td>
            </tr> -->
        </table>
        <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/default.jpg" alt="">
        <?php } ?>
    </div>
    
    <h3>Distributors that you can purchase this product from</h3>
    <div class="grid g-resp-200 scroll-box">
    <?php
        foreach ($agents as $agent)
        {
        $this->component('card/ShopOwner/agent', $agent); 
        }
    ?>
    </div>
</div>
        
<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
</script>

<script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>

<?php $this->component("footer") ?>