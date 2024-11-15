<?php
    $this->component("header");
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search">
      <button class="btn">Search</button>
      <a href="<?=LINKROOT?>/Supplier/addNewAgents" class="btn"><h5>Add new Agents</h5></a>
    </div>

    <div class="grid g-resp-200 scroll-box">
      <?php
        foreach ($agents as $agent)
        {
          $this->component('card/agent', $agent); 
        }
      ?>
    </div>
<!-- Your html code goes here -->

</div>

<?php $this->component("footer") ?>