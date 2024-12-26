<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All distributors</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row">
      <input type="text" class="search-bar fg1" placeholder="Search">
      <button class="btn">Search</button>
    </div>

    <div class="grid g-resp-200 scroll-box">
            <?php
        $profiles = [
            ["name" => "Sumudu Distributors", "address" => "111, Colombo, Sri Lanka", "phone" => "0771488164", "image" => "0987654321.jpg"],
            ["name" => "Saman Traders", "address" => "222, Kandy, Sri Lanka", "phone" => "0771122334", "image" => "0372222701.jpg"],
            ["name" => "Ravi Enterprises", "address" => "333, Galle, Sri Lanka", "phone" => "0772233445", "image" => "0372222702.jpg"],
            ["name" => "Priya Stores", "address" => "444, Matara, Sri Lanka", "phone" => "0773344556", "image" => "0372222703.jpg"],
            ["name" => "Anjali Supplies", "address" => "555, Kurunegala, Sri Lanka", "phone" => "0774455667", "image" => "0372222704.jpg"],
            ["name" => "Kumara Enterprises", "address" => "666, Jaffna, Sri Lanka", "phone" => "0775566778", "image" => "0372222705.jpeg"],
            ["name" => "Nimal Distributors", "address" => "777, Negombo, Sri Lanka", "phone" => "0776677889", "image" => "0372222706.jpg"],
            ["name" => "Chamara Traders", "address" => "888, Batticaloa, Sri Lanka", "phone" => "0777788990", "image" => "0372222703.jpg"],
            ["name" => "Lakshika Enterprises", "address" => "999, Anuradhapura, Sri Lanka", "phone" => "0778899001", "image" => "0372222704.jpg"],
            ["name" => "Vishal Supplies", "address" => "1010, Badulla, Sri Lanka", "phone" => "0779900112", "image" => "0372222705.jpeg"]
        ];

        for($x = 0; $x < 10; $x++) {
            echo '<a href="' . LINKROOT . '/Admin/distributor" class="card btn-card colomn asp-rtio">
                    <img class="product-img" src="' . ROOT . '/images/Profile/' . $profiles[$x]['image'] . '" alt="">
                    <div class="details h-50">
                        <h4>' . $profiles[$x]['name'] . '</h4>
                        <h4>' . $profiles[$x]['address'] . '</h4>
                        <h4>' . $profiles[$x]['phone'] . '</h4>
                    </div>
                </a>';
        }
        ?>

    </div>

<?php $this->component("footer") ?>