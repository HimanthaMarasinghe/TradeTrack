<?php

class ShopOwner extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Customers', 'Stocks', 'Distributors', 'Accounts'], 'userType' => 'ShopOwner'],
        'styleSheet' => ['styleSheet'=>'shopOwner']
    ];

    public function __construct() {
        if(!isset($_SESSION['shop_owner'])){
            redirect('login');
            exit;
        }
    }

    // Load pre-orders for the shop owner.Used in index and customers methods.
    private function loadPreOrders($status = null, $search = null, $offset = null) {
        $preOrderM = new PreOrder;
        $preOrderItemsM = new PreOrderItems;
        $preOrders = $preOrderM->allPreOrdersForShopOwner($_SESSION['shop_owner']['phone'], $status, $search, $offset);
        foreach ($preOrders as &$preOrder) {
            $preOrderDate = new DateTime($preOrder['date_time']);
            $diff = (new DateTime())->diff($preOrderDate);
            if($diff->days < 1)
               $preOrder['date_time'] = $diff->format('%hh %im') . ' ago';
            $preOrder['total'] = $preOrderItemsM->preOrderAmount($preOrder['pre_order_id']);
        }
        return $preOrders;
    }

    public function index () 
    {

        //$_SESSION['shop_owner']['phone'] = '0112223333'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';

        $stck = new ShopStock;
        $this->data['lowStocks'] = $stck->readStock($_SESSION['shop_owner']['phone'], 'low');

        $shop = new Shops;
        $this->data['cashDrawerBallance'] = $shop->first(['so_phone' => $_SESSION['shop_owner']['phone']])['cash_drawer_balance'];
        

        $this->view('ShopOwner/home', $this->data);
    }

    public function newPurchase() {

        unset($_SESSION['bill']);
        unset($_SESSION['total']);
        unset($_SESSION['LastBillItemBarcode']);
        unset($_SESSION['LastBillItemName']);
        unset($_SESSION['lastBillItemPrice']);

        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/newPurchase', $this->data);
    }

    public function billSettle() {
        if (!isset($_SESSION['bill'])) redirect('ShopOwner/newPurchase');
        $this->data['bill'] = $_SESSION['bill'];
        $_SESSION['total'] = 0;
        foreach($this->data['bill'] as $item){
            $_SESSION['total'] += $item['price'] * $item['qty'];
        }
        $this->data['total'] = $_SESSION['total'];
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/billSettle', $this->data);
    }

    public function purchaseDone() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_SESSION['bill'] == null)
        {
            header('Location: ' . LINKROOT . '/ShopOwner/newPurchase');
        }
        $billService = new BillService;
        $lastId = $billService-> addBill($_POST['cus-phone'] ?? null, $_POST['wallet'] ?? 0);
        $this->data['cus_phone'] = $_POST['cus-phone'] ?? null;
        $this->data['cus_email'] = $_POST['cus-email'] ?? null;
        $this->data['total'] = $_SESSION['total'];
        $this->data['tabs']['active'] = 'Home';

        unset($_SESSION['total']);
        unset($_SESSION['bill']);

        if ($_POST['cus_phone'])
        (new NotificationService)->sendNotification(
            $_POST['cus_phone'], 
            'bill', 
            $lastId,
            "Bill Settled", 
            "Your bill at {$_SESSION['shop_owner']['shop_name']} has been settled.", 
            "Customer/shop/{$_SESSION['shop_owner']['phone']}", 
            "Profile/{$_SESSION['shop_owner']['phone']}.{$_SESSION['shop_owner']['pic_format']}");
        
        $this->view('shopOwner/purchaseDone', $this->data);
    }

    public function example() {

        $this->view('ShopOwner/example', $this->data);
    }

    public function preOrder($order_id) {
        $preOrder = new PreOrder;
        $preOrderItems = new PreOrderItems;
        $stock = new ShopStock;
        $this->data['preOrder'] = $preOrder->preOrderDetailsForShopOwner($order_id);
        
        if(!$this->data['preOrder'])
            redirect('ShopOwner/customers');

        $this->data['preOrder']['total'] = $preOrderItems->preOrderAmount($order_id);
        $this->data['preOrderItems'] = $preOrderItems->where(['pre_order_id' => $order_id]);

        $this->data['shouldCheckStock'] = !in_array($this->data['preOrder']['status'], ['Picked', 'Rejected']);

        foreach ($this->data['preOrderItems'] as &$item) {
            $item['row_total'] = number_format($item['po_unit_price'] * $item['quantity'], 2);
            if ($this->data['shouldCheckStock']) {
                $item['stock'] = $stock->getStockLevel($item['barcode'], $_SESSION['shop_owner']['phone']);
                if ($item['stock']['quantity'] < $item['quantity']) {
                    $this->data['shouldBeUpdated'] = true;
                }
            }
        }

        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/preOrder', $this->data);
    }

    public function preOrderHistory() {
        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/preOrderHistory', $this->data);
    }

    public function customers() {

        $this->data['preOrders'] = $this->loadPreOrders();

        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/customers', $this->data);
    }

    public function loyaltyCustomerRequest($cusPhone = null) {

        if($cusPhone == null){
            header('Location: ' . LINKROOT . '/ShopOwner/customers');
            return;
        }


        $loyReq = new LoyaltyRequests;
        $this->data['newLoyalCusReq'] = $loyReq->first(['so_phone' => $_SESSION['shop_owner']['phone'], 'cus_phone' => $cusPhone]);

        if(!$this->data['newLoyalCusReq']){
            header('Location: ' . LINKROOT . '/ShopOwner/customers');
            return;
        }

        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/addLoyalCus', $this->data);
    }

    public function customer($id = null) {
        if($id == null)
        {
            header('Location: ' . LINKROOT . '/ShopOwner/customers');
            return;
        }
        $customer = new User;
        $loyaltyCustomer = new LoyaltyCustomers;
        $this->data['customer'] = $customer->first(['phone' => $id]);
        $this->data['loyalty'] = $loyaltyCustomer->first(['cus_phone' => $id, 'so_phone' => $_SESSION['shop_owner']['phone']]);
        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/customer', $this->data);
    }

    public function revokeLoyalty() {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $loyaltyCustomer = new LoyaltyCustomers;
            $loyaltyCustomer->delete(['cus_phone' => $_POST['loy_phone'], 'so_phone' => $_SESSION['shop_owner']['phone']]);
        }
    }
    
    public function stocks() {
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/stocks', $this->data);
    }

    public function product($barcodeIn = null){
        if ($barcodeIn == null){
            header('Location: ' . LINKROOT . '/ShopOwner/stocks');
            return;
        }
        $prd = new Products;
        $agnt = new DistributorM;
        $this->data['product'] = $prd->first(['barcode' => $barcodeIn]);
        $this->data['agents'] = $agnt->readAll(); //todo : Emplement properly
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/product', $this->data);
    }
    
    public function accounts() {
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('shopOwner/accounts', $this->data);
    }

    public function recordTransaction() {
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('shopOwner/recordTransaction', $this->data);
    }

    public function profitAndLossStatement() {
        $this->view('shopOwner/profitAndLossStatement');
    }
    
    public function UpdateStock() {
        $this->view('shopOwner/updateStock', $this->data);
    }

    public function profileUpdate() {
        $shop = new Shops;
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['so_phone']) && !empty($_POST['shop_name']) && !empty($_POST['so_first_name']) && !empty($_POST['so_last_name']) && !empty($_POST['shop_address']) && !empty($_POST['so_address'])){
            $shop->update(['so_phone' => $_SESSION['shop_owner']['phone']], $_POST);
            $_SESSION['shop_owner'] = $_POST;
        }
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/profileUpdate', $this->data);
    }


    public function announcements(){
        $announcement = new Announcements;
        
        $this->data['announcements'] = $announcement->where(['role' => 1]);
        $this->data['tabs']['active'] = 'Home';
        $this->view('ShopOwner/announcements', $this->data);
    }

    public function orderStocks() {
        
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/orderStocks', $this->data);
    }

    public function Distributors() {
        
        $this->data['tabs']['active'] = 'Distributors';
        $this->view('shopOwner/distributors', $this->data);

    }

    public function addStock() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['barcode']) && !empty($_POST['quantity']) && !empty($_POST['cost']) && !empty($_POST['purchaseType'])){
            $stck = new ShopStock;
            $con = $stck->startTransaction();
            $stck->addStock($_POST['barcode'], $_SESSION['shop_owner']['phone'], $_POST['quantity'], $con);
            if($_POST['purchaseType'] == 'onCash'){
                $shop = new Shops;
                $shop->updateCashDrawer($_SESSION['shop_owner']['phone'], -1 * $_POST['cost'], $con);
            }
            $stck->commit($con);
            return;
        }
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/addStock', $this->data);
    }

    // API endpoints

    public function addLoyCus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['cus_phone'])){
            $loyCus = new LoyaltyCustomers;
            $loyReq = new LoyaltyRequests;
            // if($loyReq->readNewLoyReq($_SESSION['shop_owner']['phone'], $_POST['cus_phone'])){     //Only if there is a request, customer can become loyal.
            if($loyReq->first(['so_phone' => $_SESSION['shop_owner']['phone'], 'cus_phone' => $_POST['cus_phone']])){     //Only if there is a request, customer can become loyal.
                $loyReq->delete(['cus_phone' => $_POST['cus_phone'], 'so_phone' => $_SESSION['shop_owner']['phone']]);
                $loyCus->insert(['cus_phone' => $_POST['cus_phone'], 'so_phone' => $_SESSION['shop_owner']['phone']]);
            }

            (new NotificationService)->sendNotification(
                $_POST['cus_phone'], 
                'loyaltyReq', 
                $_SESSION['shop_owner']['phone'], 
                'Loyalty Request Accepted', 
                "{$_SESSION['shop_owner']['shop_name']} accepted your request to be a loyal customer", 
                "Customer/shop/{$_SESSION['shop_owner']['phone']}", 
                "Profile/{$_SESSION['shop_owner']['phone']}.{$_SESSION['shop_owner']['pic_format']}");
        }
    }

    public function getProducts($offset = 0, $type = null){ 
        $search = $_GET['search'] ?? null;
        $prdct = new Products;
        if($search == null && $type == null)
            $products = $prdct->readAll(10, $offset);

        else
            $products = $prdct->searchProducts($search, null,$offset);

        if(!$products)
            $products = [];
        echo json_encode($products);
    }

    public function getStocks($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        
        $search = $_GET['search'] ?? null;
        $stck = new ShopStock;
        $stocks = $stck->readStock($_SESSION['shop_owner']['phone'], 'ASC', $offset, $search);

        echo json_encode($stocks);
    }

    //Used in billSettle.js
    public function checkCustomer(){
        if (!isset($_POST['cus-phone']))
        {
            header('Location: ' . LINKROOT . '/ShopOwner/newPurchase');
        }

        $customer = new User;
        $loyaltyCustomer = new LoyaltyCustomers;

        $customerData = $customer->first(['phone' => $_POST['cus-phone'], 'role' => 0]);
        $loyaltyCustomerData = $loyaltyCustomer->first(['cus_phone' => $_POST['cus-phone'], 'so_phone' => $_SESSION['shop_owner']['phone']]);

        if ($customerData){
            unset($customerData['cus_password']);
            $dataArr = $customerData;

            if($loyaltyCustomerData){
                unset($loyaltyCustomerData['cus_phone']);
                unset($loyaltyCustomerData['so_phone']);
                $dataArr['loyalty'] = $loyaltyCustomerData;
            }

            echo json_encode($dataArr);
        }
        else{
            echo json_encode(false);
        }
    }
    
    public function getBillDetails($billId){
        $bills = new Bills;
        if ($bills->first(['bill_id' => $billId, 'b.so_phone' => $_SESSION['shop_owner']['phone']]) == null) {
            echo json_encode(['error' => 'Error: Bill is not alowed for this customer.']);
            return;
        }
        $Billdata = (new BillService)->readBill($billId);
        echo json_encode($Billdata);
    }
    
    public function getAnnouncement($id){
        $announcement = new Announcements;
        $announcement = $announcement->first(['id' => $id]);
        echo json_encode($announcement);
    }

    public function getDistributors($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $search = $_GET['search'] ?? null;
        $distributor = new DistributorM;

        if($search == null)
            $distributors = $distributor->readAll(10, $offset);

        else
            $distributors = $distributor->searchDistributors($search, $offset);

        // if(!$distributors)
        //     $distributors = [];
        
        echo json_encode($distributors);
    }

    public function getDistributorProductsBarcodes($dis_phone){
        $distributorStocks = new DistributorStocks;
        $barcodes = $distributorStocks->getStockBarcodes($dis_phone);
        echo json_encode($barcodes);
    }

    public function getLoyaltyCustomers($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $search = $_GET['search'] ?? null;

        $loyaltyCustomer = new LoyaltyCustomers;
        $loyaltyCustomers = $loyaltyCustomer->allLoyaltyCustomers($_SESSION['shop_owner']['phone'], $search, $offset);
        
        echo json_encode($loyaltyCustomers);
    }

    public function updateStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['pre_order_id']) && !empty($_POST['status'])){
            $preOrder = new PreOrder;
            $preOrder->update(['pre_order_id' => $_POST['pre_order_id'], 'so_phone' => $_SESSION['shop_owner']['phone']], ['status' => $_POST['status']]);
            
            $cus_phone = $preOrder->first(['pre_order_id' => $_POST['pre_order_id']], [], ['cus_phone'])['cus_phone'];

            switch ($_POST['status']) {
                case 'Processing':
                    $title = 'Pre-Order Processing';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} is now being processed.";
                    break;
                case 'Ready':
                    $title = 'Pre-Order Ready';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} is ready for pickup.";
                    break;
                case 'Picked':
                    $title = 'Pre-Order Picked';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} has been picked.";
                    break;
                case 'Rejected':
                    $title = 'Pre-Order Rejected';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} has been rejected.";
                    break;
            };
            (new NotificationService)->sendNotification(
                $cus_phone, 
                'preOrder', 
                $_POST['pre_order_id'], 
                $title, 
                $body, 
                "Customer/preOrder/{$_POST['pre_order_id']}", 
                "Shops/{$_SESSION['shop_owner']['phone']}{$_SESSION['shop_owner']['shop_pic_foramt']}");
            echo json_encode(['success' => true]);
        }
        else{
            echo json_encode(['success' => false]);
        }
    }

    public function getAllPreOrders($offset = 0){ 
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $search = $_GET['search'] ?? null;
        $status = $_GET['status'] ?? null;

        $preOrders = $this->loadPreOrders($status, $search, $offset);
        echo json_encode($preOrders);        
    }

    public function updatePreOrder(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['pre_order_id']) && !empty($_POST['newPreOrderItems'])){
            // Retrieve and decode the URL-encoded JSON string
            $jsonString = urldecode($_POST['newPreOrderItems']);

            // Decode JSON string into a PHP array
            $newPreOrderItems = json_decode($jsonString, true);

            $preOrder = new PreOrder;
            $preOrderItems = new PreOrderItems;
            $con = $preOrder->startTransaction();
            $preOrder->update(['pre_order_id' => $_POST['pre_order_id']], ['status' => 'Updated'], $con);
            foreach($newPreOrderItems as $item){
                if($item['quantity'] == 0){
                    $preOrderItems->delete(['pre_order_id' => $_POST['pre_order_id'], 'barcode' => $item['barcode']], $con);
                }
                else{
                    $preOrderItems->update(['pre_order_id' => $_POST['pre_order_id'], 'barcode' => $item['barcode']], ['quantity' => $item['quantity']], $con);
                }
            }

            if ($con->commit()) {
                $cus_phone = $preOrder->first(['pre_order_id' => $_POST['pre_order_id']], [], ['cus_phone'])['cus_phone'];
                (new NotificationService)->sendNotification(
                    $cus_phone,
                    'preOrder', 
                    $_POST['pre_order_id'], 
                    'Pre-Order Updated', 
                    "Your pre-order at {$_SESSION['shop_owner']['shop_name']} has been updated. Please check it and accept.", 
                    "Customer/preOrder/{$_POST['pre_order_id']}", 
                    "Shops/{$_SESSION['shop_owner']['phone']}{$_SESSION['shop_owner']['shop_pic_foramt']}");
                echo json_encode(['success' => true]);
            }
            else echo json_encode(['success' => false]);
        }
        else{
            echo json_encode(['success' => false]);
        }
    }

    public function getLoyaltyReqs() {
        $loyReq = new LoyaltyRequests;
        echo json_encode($loyReq->where(['so_phone' => $_SESSION['shop_owner']['phone']]));
    }

    public function getProduct()
    {
        if(isset($_POST['barcodeIn']))
        {
            $product = new Products;
            $item = $product->first(['barcode' => $_POST['barcodeIn']]);
            if($item) echo json_encode($item);
        }
    }

    public function addBillItemsToSession() {
        $_SESSION['bill'] = jsonPostDecode();
        echo json_encode(['status' => 'success']);
    }
}