<?php
    $this->component("header", $styleSheet);
    $this->component("sidebar", $tabs);
    // Side menu is created here
?>

<div class="main-content colomn">

    <div class="bar">
        <img src="<?=ROOT?>/images/icons/home.svg" alt="Home Icon">
        <h1>Maliban Galle Distributor</h1>
        <div>
            <img src="<?=ROOT?>/images/icons/settings.svg" alt="Settings Icon">
            <img src="<?=ROOT?>/images/icons/Profile.svg" alt="Profile Icon">
        </div>
    </div>
    
    <div class="row fg1 ovf-hdn">
        <div class="panel mg-10 fg1">
            <div class="row">
                <input type="text" class="search-bar fg1" placeholder="Search Order">
                <button class="btn">Search</button>
                <a class="btn" href="<?=LINKROOT?>/SalesAgent/orderHistory">
                    <h4>Order History</h4>
                </a>
            </div>
            <div class="scroll-box grid g-resp-300">
                <!-- Order Cards -->
                <?php
                    // Define orders
                    $orders = [
                        [
                            "name" => "Galle Supermarket",
                            "time" => "30 minutes ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Sunrise Grocery Store",
                            "time" => "1 hour ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Green Valley Groceries",
                            "time" => "2 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Fort Fresh Market",
                            "time" => "3 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Ocean View Grocery",
                            "time" => "4 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Galle Essentials",
                            "time" => "5 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Southern Groceries",
                            "time" => "6 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Cinnamon Market",
                            "time" => "7 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Hilltop Grocery",
                            "time" => "8 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Galle Mart",
                            "time" => "9 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Pearl Groceries",
                            "time" => "10 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Harbor View Mart",
                            "time" => "11 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Beachside Groceries",
                            "time" => "12 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Golden Leaf Mart",
                            "time" => "13 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Coral Coast Groceries",
                            "time" => "14 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Southern Spice Market",
                            "time" => "15 hours ago",
                            "status" => "pending"
                        ],
                        [
                            "name" => "Tropical Delights Grocery",
                            "time" => "16 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Coconut Grove Groceries",
                            "time" => "17 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Fort Bazaar Grocery",
                            "time" => "18 hours ago",
                            "status" => "ready"
                        ],
                        [
                            "name" => "Lighthouse Grocery Center",
                            "time" => "19 hours ago",
                            "status" => "pending"
                        ]
                    ];

                    // Sorting orders by time (latest first)
                    usort($orders, function($a, $b) {
                        // Convert time string to number of minutes or hours
                        $aTime = convertToTimestamp($a['time']);
                        $bTime = convertToTimestamp($b['time']);
                        return $bTime - $aTime; // Sort in descending order
                    });

                    // Helper function to convert time to timestamp for comparison
                    function convertToTimestamp($timeStr) {
                        $now = time();
                        if (strpos($timeStr, 'minute') !== false) {
                            preg_match('/(\d+)\sminute/', $timeStr, $matches);
                            return $now - $matches[1] * 60;
                        } elseif (strpos($timeStr, 'hour') !== false) {
                            preg_match('/(\d+)\shour/', $timeStr, $matches);
                            return $now - $matches[1] * 3600;
                        }
                        return $now; // Default to current time if the format is not matched
                    }

                    // Separate orders by status
                    $pendingOrders = [];
                    $readyOrders = [];
                    
                    foreach ($orders as $order) {
                        switch ($order['status']) {
                            case 'pending':
                                $pendingOrders[] = $order;
                                break;
                            case 'ready':
                                $readyOrders[] = $order;
                                break;
                        }
                    }

                    // Display orders grouped by status
                    $allOrders = array_merge($pendingOrders, $readyOrders);
                ?>

                <?php foreach ($allOrders as $order): ?>
                    <a href="<?=LINKROOT?>/SalesAgent/orderDetails" class="card btn-card center-al">
                        <div class="profile-photo">
                            <img src="<?=ROOT?>/images/Shops/default.jpeg" alt="<?= $order['name']; ?>">
                        </div>
                        <div class="details center-al">
                            <h4><?= $order['name']; ?></h4>
                            <h4><?= $order['time']; ?></h4>
                            <h4 class="status-<?= $order['status']; ?>"><?= $order['status']; ?></h4> <!-- Add the status class -->
                        </div>
                    </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

<?php $this->component("footer") ?>
