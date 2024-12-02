<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>All customers</h1>
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
        // Array containing customer details
        $customers = [
            [
                'name' => 'Chenuka',
                'address' => '111, Colombo, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222690.jpeg',
            ],
            [
                'name' => 'Amara',
                'address' => '222, Galle, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222691.jpg',
            ],
            [
                'name' => 'Kumara',
                'address' => '333, Kandy, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222692.jpg',
            ],
            [
                'name' => 'Nimal',
                'address' => '444, Jaffna, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222693.jpg',
            ],
            [
                'name' => 'Saman',
                'address' => '555, Anuradhapura, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222694.jpg',
            ],
            [
                'name' => 'Rajitha',
                'address' => '666, Kurunegala, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222695.jpg',
            ],
            [
                'name' => 'Dinuka',
                'address' => '777, Matara, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222696.jpg',
            ],
            [
                'name' => 'Harsha',
                'address' => '888, Negombo, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222697.jpeg',
            ],
            [
                'name' => 'Manoj',
                'address' => '999, Ratnapura, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222698.jpg',
            ],
            [
                'name' => 'Kasun',
                'address' => '101, Trincomalee, Sri Lanka',
                'image' => ROOT . '/images/Profile/SA/0372222699.jpg',
            ],
        ];

        // Loop through customer details
        foreach ($customers as $customer) { ?>
            <a href="<?= LINKROOT ?>/Admin/customer" class="card btn-card colomn asp-rtio">
                <img class="product-img" src="<?= $customer['image'] ?>" alt="Profile image of <?= $customer['name'] ?>">
                <div class="details h-50">
                    <h4><?= $customer['name'] ?></h4>
                    <h4><?= $customer['address'] ?></h4>
                </div>
            </a>
        <?php } ?>
    </div>

<?php $this->component("footer") ?>