<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h1>Distributors</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search Distributor">
      <button class="btn">Search</button>
    </div>

    <div class="grid g-resp-200 scroll-box">
      <?php
      $agents = [
        [
            "first_name" => "Saman",
            "last_name" => "Kumara",
            "sa_busines_name" => "Maliban Galle Distributor",
            "sa_phone" => "0372222690"

        ],[
            "first_name" => "Nimal",
            "last_name" => "Perera",
            "sa_busines_name" => "Ceylon Tea Distributors",
            "sa_phone" => "0112345678"
        ],[
            "first_name" => "Ranjith",
            "last_name" => "Dias",
            "sa_busines_name" => "Ranjith Super Distributors",
            "sa_phone" => "0112456789"
        ],[
            "first_name" => "Lakshan",
            "last_name" => "Silva",
            "sa_busines_name" => "Silva Grocery Distributors",
            "sa_phone" => "0412233456"
        ],[
            "first_name" => "Harsha",
            "last_name" => "Bandara",
            "sa_busines_name" => "Bandara Retail and Wholesale",
            "sa_phone" => "0712233444"
        ]
        
        
        
        ];
        foreach ($agents as $agent)
        {
          $this->component('card/shopDistributor', $agent); 
        }
      ?>
    </div>
<!-- Your html code goes here -->

</div>


<script src="<?=ROOT?>/js/popUp.js"></script>

<?php $this->component("footer") ?>