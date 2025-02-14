<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

  <div class="bar">
      <img src="<?=ROOT?>/images/icons/home.svg" alt="">
      <h1><?=$_SESSION['Customer']['first_name']?> <?=$_SESSION['Customer']['last_name']?></h1>
      <div class="row gap-10">
          <a href="<?=LINKROOT?>/Customer/announcements"><img src="<?=ROOT?>/images/icons/Announcement.svg" alt=""></a>
          <?php $this->component("notification") ?>
          <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
      </div>
  </div>

  <div class="grid-box fg1">

    <div class="panel pre-orders-f" id="pre-orders">
        <h2>Current Pre-Orders</h2>
        <a class="link" href="<?=LINKROOT?>/Customer/preOrderHistory">Pre-order history</a>
        <svg id="down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path id="path-down" d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
        <div class="scroll-box" id="elements-Scroll-Div"></div>
    </div>

    <div class="panel bills-container">
      <div class="mg-0 row col-max-1024">
        <h2>Bills</h2>
        <input type="text" class="search-bar fg1" id="bill-searchBar" placeholder="Search">
        <input type="date" id="bill_Date" class="filter-js-bill">
      </div>
      <br>
      <div class="billScroll" id="billScroll">
        <table class="bill">
          <thead>
            <tr class="BillHeadings">
              <th>Id.</th>
              <th>Shop Name</th>
              <th>Date</th>
              <th>Time</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody id="billTbody">
        </table>
      </div>
    </div>

    <div class="panel new-lc-req closed-grid" id="new-lc-req">
      <h2>New Loyalty Customer Requests</h2>
      <svg id="up" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path id="path-up" d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/></svg>
      <div class="scroll-box" id="lcr-Scroll-Div"></div>
    </div>

  </div>
</div>

<div id="popUpBackDrop" class="hidden"></div>
<?php $this->component("billDetails", [$role = 'Customer']) ?>
<div id="notification-container"></div>

<script>
    const ROOT = "<?=ROOT?>";
    const LINKROOT = "<?=LINKROOT?>"
    const ws_id = "<?=$_SESSION['customer']['phone']?>";
    const ws_token = "<?=$_SESSION['web_socket_token']?>";
</script>
<script src="<?=ROOT?>/js/popUp.js"></script>
<script src="<?=ROOT?>/js/Customer/home.js" type="module"></script>

<?php 
    unset($_SESSION['web_socket_token']);
    $this->component("footer") 
?>