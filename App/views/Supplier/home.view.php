<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs); 
    //this code will create the side menu. You don't have to create it again.
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="">
        <!-- <h1><?=$_SESSION['name']?></h1> -->
        <h1>Business Name</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="">
        </div>
    </div>

    <div class="row fg1">
        <div class="column w-25 panel">
            <h2>Orders</h2>
            <div class="scroll-box">
            </div>
        </div>
        <div class="column w-75 panel">
            <h2>Sales for the Last 30 Days</h2>
            <br>
            <div class="w-100">
                <canvas id="sales"></canvas>
            </div>
        </div>
    </div>
    <!-- Your html code goes here -->
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesChart = document.getElementById('sales');
    const weeks = ['Oct 27 to Nov 2', 'Nov 3 to Nov 9', 'Nov 10 to Nov 16', 'Nov 17 to Nov 23', 'Nov 24 to Nov 30'];

    new Chart(salesChart, {
        type: 'bar',
        data: {
            labels: weeks,
            datasets: [
                {
                    label: 'Maliban Chocolate Biscuit',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(90, 252, 3, 1)',
                    backgroundColor: 'rgba(90, 252, 3, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Smart cream cracker',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Sun Cracker',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(252, 49, 3, 1)',
                    backgroundColor: 'rgba(252, 49, 3, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Lemon Puff',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Milk Biscuit',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Gold Marie',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(153, 102, 255, 1)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Nice Biscuit',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Cream Cracker',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(75, 0, 130, 1)',
                    backgroundColor: 'rgba(75, 0, 130, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Chocolate Puff',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(220, 20, 60, 1)',
                    backgroundColor: 'rgba(220, 20, 60, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                },
                {
                    label: 'Maliban Digestive',
                    data: Array.from({ length: weeks.length }, () => Math.floor(Math.random() * 10000)),
                    borderColor: 'rgba(34, 139, 34, 1)',
                    backgroundColor: 'rgba(34, 139, 34, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                }
            ]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of units sold'
                    },
                    beginAtZero: true
                },
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<?php $this->component("footer") ?>