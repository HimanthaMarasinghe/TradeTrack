<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content colomn">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Product</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Product Name</td>
                <td>Maliban Milk Powder 400g</td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td>5000</td>
            </tr>
            <tr>
                <td>Quantity Price</td>
                <td>Rs.1260.00</td>
            </tr>
            <tr>
            <td><a href="<?=LINKROOT?>/Supplier/new/updateQuantity" class="btn">Update Quantity</a></td>
            </tr>
        </table>
        <img class="profile-img big" src="<?=ROOT?>/images/Products/4790015950624.png" alt="">
    </div>


</div>

<?php $this->component("footer") ?>