<?php
    $this->component("header");
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Product Details</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
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
            <tr>
                <td>
                    <a href="<?=LINKROOT?>/Admin/updateProducts/<?=$product['barcode']?>" class="btn">Update Details</a>
                    <button onclick="deleteProduct('<?=$product['barcode']?>')" class="btn">Delete Product</button>
                </td>
            </tr>
        </table>
        <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/default.jpeg" alt="">
        <?php } ?>



    </div>
</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    function deleteProduct(barcode){
        fetch(LINKROOT+'/Admin/deleteProduct', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'barcode=' + encodeURIComponent(barcode)
    })
    .then(
        () => location.reload()
    )
    .catch(error => console.error('Error:', error));
    }
</script>

<?php $this->component("footer") ?>