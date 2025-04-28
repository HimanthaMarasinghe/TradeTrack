<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs) 
?>

<div class="main-content colomn scroll-box">
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
            </tr>
            <tr>
                <td>Bulk Price</td>
                <td>Rs.<?= number_format($product['bulk_price'], 2) ?></td>
            </tr>
        </table>
        <?php if(file_exists("./images/Products/".$product['barcode'].".".$product['pic_format'])){ ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/<?=$product['barcode']?>.<?=$product['pic_format']?>" alt="">
        <?php } else { ?>
            <img class="profile-img big" src="<?=ROOT?>/images/Products/default.jpg" alt="">
        <?php } ?>
    </div>
    <!-- <div class="row">
        <div class="w-50 colomn alitem-center">
            <h4>Sales By District</h4>
            <canvas id="salesByDistrict"></canvas>
        </div>
        <div class="w-50 colomn alitem-center">
            <h4>Sales By Month</h4>
            <canvas id="salesByMonth"></canvas>
        </div>
    </div> -->
</div>
    

<!-- Chart.js -->

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<!-- <script>
    const salesByDistrict = document.getElementById('salesByDistrict');
    const salesByMonth = document.getElementById('salesByMonth');

    const options = {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Number of units sold'
                    },
                    beginAtZero: true
                }
            },
        };

    const districts = [
        'Colombo', 'Gampaha', 'Kalutara', 'Kandy', 'Matale', 'Nuwara Eliya', 
        'Galle', 'Matara', 'Hambantota', 'Jaffna', 'Kilinochchi', 'Mannar', 
        'Vavuniya', 'Mullaitivu', 'Batticaloa', 'Ampara', 'Trincomalee', 
        'Kurunegala', 'Puttalam', 'Anuradhapura', 'Polonnaruwa', 'Badulla', 
        'Monaragala', 'Ratnapura', 'Kegalle'
    ];

    const salesData = Array.from({ length: districts.length }, () => Math.floor(Math.random() * 10000));

    new Chart(salesByDistrict, {
        type: 'bar',
        data: {
            labels: districts,
            datasets: [{
                label: 'Sales by District',
                data: salesData,
                borderColor: 'rgba(22, 35, 89, 1)',
                backgroundColor: 'rgba(22, 35, 89, 0.2)',
                borderWidth: 1
            }]
        },
        options: options
    });

    const months = [
        'January', 'February', 'March', 'April', 'May', 'June', 
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    const monthlySalesData = Array.from({ length: months.length }, () => Math.floor(Math.random() * 10000));

    new Chart(salesByMonth, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Sales by Month',
                data: monthlySalesData,
                borderColor: '#162359',
                borderWidth: 1,
                fill: false,
                tension: 0.2
            }]
        },
        options: options
    });
</script> -->
 
        

<!-- <script>
    const LINKROOT = "<?=LINKROOT?>";
</script>
<script src="<?=ROOT?>/js/addLoyCustomer.js"></script> -->

<?php $this->component("footer") ?>