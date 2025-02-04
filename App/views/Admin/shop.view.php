<?php 
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>


<div class="main-content scroll-box">
    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <h2>Shop Owner details</h2>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>
    <div class="row spc-btwn">
        <table class="profile">
            <tr>
                <td>Shop owner name</td>
                <td>Amal</td>
            </tr>
            <tr>
                <td>Shop name</td>
                <td>Gunarathna stores</td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td>0771488164</td>
            </tr>
        </table>
        <img class="profile-img big" src="<?=ROOT?>/images/Profile/0987654321.jpg" alt="">
    </div>
    <h2 class="center-al">History</h2>
    <div class="billScroll">
        <table class="bill">
            <thead>
                <tr class="BillHeadings">
                    <th>Bill Id</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
                    <th>Customer</th>
                    <th>More Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = [
                    ["date" => "2024.03.20", "time" => "09.45 a.m.", "amount" => "Rs.300.00", "person" => "Bandara"],
                    ["date" => "2024.03.21", "time" => "10.00 a.m.", "amount" => "Rs.500.00", "person" => "Saman"],
                    ["date" => "2024.03.22", "time" => "11.30 a.m.", "amount" => "Rs.150.00", "person" => "Nimal"],
                    ["date" => "2024.03.23", "time" => "02.00 p.m.", "amount" => "Rs.600.00", "person" => "Kumara"],
                    ["date" => "2024.03.24", "time" => "03.15 p.m.", "amount" => "Rs.450.00", "person" => "Perera"],
                    ["date" => "2024.03.25", "time" => "04.30 p.m.", "amount" => "Rs.700.00", "person" => "Dinesh"],
                    ["date" => "2024.03.26", "time" => "06.00 a.m.", "amount" => "Rs.250.00", "person" => "Anjali"],
                    ["date" => "2024.03.27", "time" => "07.45 a.m.", "amount" => "Rs.350.00", "person" => "Ravi"],
                    ["date" => "2024.03.28", "time" => "08.30 p.m.", "amount" => "Rs.550.00", "person" => "Priya"],
                    ["date" => "2024.03.29", "time" => "01.00 p.m.", "amount" => "Rs.400.00", "person" => "Gamini"]
                ];
                
                for($i = 0; $i < count($data); $i++){
                    echo "<tr class='Item'>
                            <td class='center-al'>" . ($i + 1) . "</td>
                            <td class='left-al'>" . $data[$i]['date'] . "</td>
                            <td class='left-al'>" . $data[$i]['time'] . "</td>
                            <td>" . $data[$i]['amount'] . "</td>
                            <td>" . $data[$i]['person'] . "</td>
                            <td class='center-al'><button class='btn btn-mini'>More</button></td>
                        </tr>";
                }
                ?>
                
                <tr></tr>
            </tbody>
        </table>
    </div>
    <h3>Loyalty customers</h3>
    <div class="grid g-resp-200 scroll-box">
                <?php
            $profiles = [
                ["name" => "Chenuka", "address" => "111, Colombo, Sri Lanka", "phone" => "0771488164", "image" => "PhoneNumber.jpg"],
                ["name" => "Nimal", "address" => "234, Kandy, Sri Lanka", "phone" => "0771122334", "image" => "PhoneNumber.jpg"],
                ["name" => "Ravi", "address" => "456, Galle, Sri Lanka", "phone" => "0772233445", "image" => "PhoneNumber.jpg"],
                ["name" => "Priya", "address" => "789, Matara, Sri Lanka", "phone" => "0773344556", "image" => "PhoneNumber.jpg"],
                ["name" => "Anjali", "address" => "101, Kurunegala, Sri Lanka", "phone" => "0774455667", "image" => "PhoneNumber.jpg"],
                ["name" => "Kumara", "address" => "202, Jaffna, Sri Lanka", "phone" => "0775566778", "image" => "PhoneNumber.jpg"]
            ];

            for($x = 0; $x < 6; $x++) {
                echo '<a href="" class="card btn-card colomn asp-rtio">
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
    <h3>Distributors</h3>
    <div class="grid g-resp-200 scroll-box">
                <?php
            $profiles = [
                ["name" => "Sumudu Distributors", "address" => "Maliban", "phone" => "0771488164"],
                ["name" => "Saman Traders", "address" => "Colombo", "phone" => "0771122334"],
                ["name" => "Ravi Enterprises", "address" => "Galle", "phone" => "0772233445"],
                ["name" => "Priya Stores", "address" => "Kandy", "phone" => "0773344556"],
                ["name" => "Anjali Supplies", "address" => "Matara", "phone" => "0774455667"],
                ["name" => "Kumara Enterprises", "address" => "Kurunegala", "phone" => "0775566778"],
                ["name" => "Nimal Distributors", "address" => "Jaffna", "phone" => "0776677889"]
            ];

            for($x = 0; $x < 7; $x++) {
                echo '<a href="" class="card btn-card colomn asp-rtio">
                        <img class="product-img" src="' . ROOT . '/images/Profile/PhoneNumber.jpg" alt="">
                        <div class="details h-50">
                            <h4>' . $profiles[$x]['name'] . '</h4>
                            <h4>' . $profiles[$x]['address'] . '</h4>
                            <h4>' . $profiles[$x]['phone'] . '</h4>
                        </div>
                    </a>';
            }
            ?>

    </div>
</div>
<?php $this->component("footer") ?>