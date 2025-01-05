<?php

class ShopOwner extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Customers', 'Stocks', 'Accounts'], 'userType' => 'ShopOwner'],
        'styleSheet' => ['styleSheet'=>'shopOwner']
    ];

    public function __construct() {
        if(!isset($_SESSION['so_phone']) || !isset($_SESSION['shop'])){
            redirect('login');
            exit;
        }
    }


    public function index () 
    {

        //$_SESSION['so_phone'] = '0112223333'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        
        $this->data['preOrders'] = [
            ['phone' => 'PhoneNumber', 'name' => 'John Doe', 'total' => 15000, 'time' => '5 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Jane Smith', 'total' => 24000, 'time' => '10 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Alice Johnson', 'total' => 32000, 'time' => '7 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Bob Brown', 'total' => 27000, 'time' => '8 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Carol Davis', 'total' => 16000, 'time' => '3 min'],
            ['phone' => 'PhoneNumber', 'name' => 'David Wilson', 'total' => 20000, 'time' => '12 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Eve Miller', 'total' => 18000, 'time' => '6 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Frank Moore', 'total' => 21000, 'time' => '4 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Grace Taylor', 'total' => 30000, 'time' => '9 min'],
            ['phone' => 'PhoneNumber', 'name' => 'Henry Anderson', 'total' => 22000, 'time' => '11 min']
        ];

        $stck = new ShopStock;
        $this->data['lowStocks'] = $stck->readStock($_SESSION['so_phone'], 'low');

        $shop = new Shops;
        $this->data['cashDrawerBallance'] = $shop->first(['so_phone' => $_SESSION['so_phone']])['cash_drawer_balance'];
        

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
        $this->data['total'] = $_SESSION['total'];
        $this->data['bill'] = $_SESSION['bill'];
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/billSettle', $this->data);
    }

    public function purchaseDone() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_SESSION['bill'] == null)
        {
            header('Location: ' . LINKROOT . '/ShopOwner/newPurchase');
        }
        $billService = new BillService;
        $billService-> addBill($_POST['cus-phone'] ?? null, $_POST['wallet'] ?? 0);
        $this->data['cus_phone'] = $_POST['cus-phone'] ?? null;
        $this->data['cus_email'] = $_POST['cus-email'] ?? null;
        $this->data['total'] = $_SESSION['total'];
        $this->data['tabs']['active'] = 'Home';

        unset($_SESSION['total']);
        unset($_SESSION['bill']);
        unset($_SESSION['LastBillItemBarcode']);
        unset($_SESSION['LastBillItemName']);
        unset($_SESSION['lastBillItemPrice']);
        
        $this->view('shopOwner/purchaseDone', $this->data);
    }

    public function example() {

        $this->view('ShopOwner/example', $this->data);
    }

    public function preOrder() {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->data['preOrder'] = $_POST;
            $this->data['tabs']['active'] = 'Home';
            $this->view('shopOwner/preOrder', $this->data);
        }
    }

    public function customers() {
        $this->data['preOrders'] = [
            ['phone' => 'PhoneNumber', 'name' => 'John Doe', 'total' => 15000, 'time' => '5 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Jane Smith', 'total' => 24000, 'time' => '10 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Alice Johnson', 'total' => 32000, 'time' => '7 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Bob Brown', 'total' => 27000, 'time' => '8 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Carol Davis', 'total' => 16000, 'time' => '3 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'David Wilson', 'total' => 20000, 'time' => '12 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Eve Miller', 'total' => 18000, 'time' => '6 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Frank Moore', 'total' => 21000, 'time' => '4 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Grace Taylor', 'total' => 30000, 'time' => '9 min', 'pic_format' => 'jpeg'],
            ['phone' => 'PhoneNumber', 'name' => 'Henry Anderson', 'total' => 22000, 'time' => '11 min', 'pic_format' => 'jpeg']
        ];

        $loyReq = new LoyaltyRequests;
        $this->data['newLoyalCusReq'] = $loyReq->allRequests($_SESSION['so_phone']);
        
        $loyaltyCustomer = new LoyaltyCustomers;
        $this->data['loyalCus'] = $loyaltyCustomer->allLoyaltyCustomers($_SESSION['so_phone']);

        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/customers', $this->data);
    }

    public function loyaltyCustomerRequest($cusPhone = null) {

        if($cusPhone == null){
            header('Location: ' . LINKROOT . '/ShopOwner/customers');
            return;
        }


        $loyReq = new LoyaltyRequests;
        // $this->data['newLoyalCusReq'] = [
        //     'name' => 'John Doe',
        //     'phone' => '0112224690',
        //     'address' => 'No 123, Main Street, Colombo 07'
        // ];
        $this->data['newLoyalCusReq'] = $loyReq->readNewLoyReq($_SESSION['so_phone'], $cusPhone);

        if(!$this->data['newLoyalCusReq']){
            header('Location: ' . LINKROOT . '/ShopOwner/customers');
            return;
        }

        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/addLoyalCus', $this->data);
    }

    public function addLoyCus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['cus_phone'])){
            $loyCus = new LoyaltyCustomers;
            $loyReq = new LoyaltyRequests;
            if($loyReq->readNewLoyReq($_SESSION['so_phone'], $_POST['cus_phone'])){     //Only if there is a request, customer can become loyal.
                $loyReq->delete(['cus_phone' => $_POST['cus_phone'], 'so_phone' => $_SESSION['so_phone']]);
                $loyCus->insert(['cus_phone' => $_POST['cus_phone'], 'so_phone' => $_SESSION['so_phone']]);
            }
        }
    }

    public function customer($id = null) {
        if($id == null)
        {
            header('Location: ' . LINKROOT . '/ShopOwner/customers');
            return;
        }
        $customer = new Customers;
        $loyaltyCustomer = new LoyaltyCustomers;
        $this->data['customer'] = $customer->first(['cus_phone' => $id]);
        $this->data['loyalty'] = $loyaltyCustomer->first(['cus_phone' => $id, 'so_phone' => $_SESSION['so_phone']]);
        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/customer', $this->data);
    }

    public function revokeLoyalty() {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $loyaltyCustomer = new LoyaltyCustomers;
            $loyaltyCustomer->delete(['cus_phone' => $_POST['loy_phone'], 'so_phone' => $_SESSION['so_phone']]);
        }
    }

    public function orderReady() {
        $this->data['cusName'] = 'John Doe';
        $this->data['tabs']['active'] = 'Customers';
        $this->view('shopOwner/orderReady', $this->data);
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
        $bill = new Bills;
        $billItems = new BillItems;
        $this->data['recentBills'] = $bill->getRecentBillDetails($_SESSION['so_phone']);
        foreach($this->data['recentBills'] as &$bill){
            $bill['total'] = $billItems->getBillTotal($bill['bill_id']);
        }
        $shop = new Shops;
        $this->data['cashDrawerBallance'] = $shop->first(['so_phone' => $_SESSION['so_phone']])['cash_drawer_balance'];
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
            $shop->update(['so_phone' => $_SESSION['so_phone']], $_POST);
            $_SESSION['so_phone'] = $_POST['so_phone'];
        }
        $this->data['shopOwner'] = $shop->first(['so_phone' => $_SESSION['so_phone']]);
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
        
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/distributors', $this->data);

    }

    public function addStock() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['barcode']) && !empty($_POST['quantity']) && !empty($_POST['cost']) && !empty($_POST['purchaseType'])){
            $stck = new ShopStock;
            $con = $stck->startTransaction();
            $stck->addStock($_POST['barcode'], $_SESSION['so_phone'], $_POST['quantity'], $con);
            if($_POST['purchaseType'] == 'onCash'){
                $shop = new Shops;
                $shop->updateCashDrawer($_SESSION['so_phone'], -1 * $_POST['cost'], $con);
            }
            $stck->commit($con);
            return;
        }
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/addStock', $this->data);
    }

    // API endpoints

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

    public function getStocks($offset = 0, $type = null){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        
        $search = $_GET['search'] ?? null;
        $stck = new ShopStock;
        if($search == null && $type == null)
            $stocks = $stck->readStock($_SESSION['so_phone'], 'ASC', $offset);

        else
            $stocks = $stck->searchStock($search, $offset, $_SESSION['so_phone']);

        if(!$stocks)
            $stocks = [];

        echo json_encode($stocks);
    }

    //Used in billSettle.js
    public function checkCustomer(){
        if (!isset($_POST['cus-phone']))
        {
            header('Location: ' . LINKROOT . '/ShopOwner/newPurchase');
        }

        $customer = new Customers;
        $loyaltyCustomer = new LoyaltyCustomers;

        $customerData = $customer->first(['cus_phone' => $_POST['cus-phone']]);
        $loyaltyCustomerData = $loyaltyCustomer->first(['cus_phone' => $_POST['cus-phone'], 'so_phone' => $_SESSION['so_phone']]);

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
        $bill = new Bills;
        $Billdata['billDetails'] = $bill->first(['bill_id' => $billId]);
        $billItem = new BillItems;
        $Billdata['billItems'] = $billItem->where(['bill_id' => $billId]);
        $Billdata['total'] = 0;
        foreach($Billdata['billItems'] as &$item){
            $item['total'] += $item['unit_price'] * $item['quantity'];
        }
        foreach($Billdata['billItems'] as $item){
            $Billdata['total'] += $item['total'];
        }
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

        if(!$distributors)
            $distributors = [];
        
        echo json_encode($distributors);
    }
}