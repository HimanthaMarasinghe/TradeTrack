<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>


<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All Products</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search" id="searchBar">
                <a class="btn"  href="<?=LINKROOT?>/Admin/addNewProducts">Add new product</a>
                <a class="btn"  href="<?=LINKROOT?>/Admin/newProductRequests">New product add requests</a>
            </div>
            <div class="scroll-box grid g-resp-200" id="elements-Scroll-Div">
             </div>
        </div>
    </div>

</div>

<script>
    const LINKROOT = "<?=LINKROOT?>";
    const ROOT = "<?=ROOT?>";
    const clickLink = "Admin/product";
  </script>
  <script src="<?=ROOT?>/js/loadAllProducts.js" type="module"></script>

<?php $this->component("footer") ?>