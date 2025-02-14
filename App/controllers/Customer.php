<?php

class Customer extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Shops'], 'userType' => 'Customer'],
        'styleSheet' => ['styleSheet'=>'customer']
    ];

    public function __construct() {
        if(!isset($_SESSION['customer'])){
            redirect('login');
            exit;
        }
    }

    private function loadPreOrders($status = null, $search = null, $offset = null) {
        $preOrderM = new PreOrder;
        $preOrderItemsM = new PreOrderItems;
        $preOrders = $preOrderM->allPreOrdersForCusotmers($_SESSION['customer']['phone'], $status, $search, $offset);
        foreach ($preOrders as &$preOrder) {
            $preOrderDate = new DateTime($preOrder['date_time']);
            $diff = (new DateTime())->diff($preOrderDate);
            if($diff->days < 1)
               $preOrder['date_time'] = $diff->format('%hh %im') . ' ago';
            $preOrder['total'] = $preOrderItemsM->preOrderAmount($preOrder['pre_order_id']);
        }
        return $preOrders;
    }

    private function LoyalToShop($so_phone){
        $loyalty = new LoyaltyCustomers;
        return $loyalty->first(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $so_phone]);
    }

    public function index(){

        //$_SESSION['customer']['phone'] = '0123456789'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/home',$this->data);
    }

    public function placePreOrder($so_phone){
        if(!$this->LoyalToShop($so_phone))
            redirect('Customer/shops');
        $this->data['so_phone'] = $so_phone;
        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/placePreOrder',$this->data);
    }

    public function products(){
        $this->data['tabs']['active'] = 'Products';
        $this->view('Customer/Products',$this->data);
    }

    public function product($barcode){
        $prdct = new Products;
        $stock = new ShopStock;
        $this->data['product'] = $prdct->first(['barcode' => $barcode]);
        $this->data['shops'] = $stock->shopsThatSellProduct($barcode);
        $this->data['tabs']['active'] = 'Products';
        $this->view('Customer/product',$this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
        // $shops = new LoyaltyCustomers;
        // $this->data['shops'] = $shops->notLoyaltyShops($_SESSION['customer']['phone']);
        $this->view('Customer/shops',$this->data);
    }

    public function shop($sop){
        $shops = new Shops;
        $loyShops = new LoyaltyCustomers;
        $loyReq = new LoyaltyRequests;
        $this->data['shop'] = $shops->first(['so_phone' => $sop]);
        $this->data['loyalty'] = $loyShops->first(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $sop]);        
        if(!$this->data['loyalty'])
            $this->data['loyaltyReq'] = $loyReq->first(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $sop]);
        $this->data['tabs']['active'] = 'Shops';
        $this->view('Customer/shop',$this->data);
    }

    public function announcements(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/announcements', $this->data);
    }

    
    // API endpoints

    public function getAnnouncements($offset){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 
        $announcement = new Announcements;
        $announcements = $announcement->where(['role' => 0], [], 10, $offset);
        echo json_encode($announcements);
    }

    public function getShops($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 

        $search = $_GET['search'] ?? null;
        $location = $_GET['location'] ?? null;
        if($_GET['loyalty']){
            $loyalty = new LoyaltyCustomers;
            $shops = $loyalty->allLoyaltyShops($_SESSION['customer']['phone'], $search, $offset);
        }else{
            $shopsM = new Shops;
            $shops = $shopsM->allShops($search, $location, $offset);
        }
        echo json_encode($shops);
    }

    public function reqLoyalty(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['so_phone'])){
            $loyReq = new LoyaltyRequests;
            $loyReq->insert(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $_POST['so_phone']]);

            $notification = new NotificationService;
            $notification->sendNotification($_POST['so_phone'], 'loyaltyReq',  $_SESSION['customer']['phone'],'New Loyalty Request', "{$_SESSION['customer']['first_name']} {$_SESSION['customer']['last_name']} requested to be a loyalty customer", "ShopOwner/loyaltyCustomerRequest/{$_SESSION['customer']['phone']}", $_SESSION['customer']['phone'].".".$_SESSION['customer']['pic_format']);
            echo json_encode(['success' => true]);
        }
        else
            redirect('Customer/shops');
    }

    // Moved to LogedInUserCommon
    // public function getProducts($offset = 0){
    //     if (!filter_var($offset, FILTER_VALIDATE_INT)) 
    //         $offset = 0;
    //     if(isset($_GET['search'])){
    //         $prdct = new Products;
    //         $products = $prdct->searchProducts($_GET['search'], null, $offset);
    //     }else{
    //         $prdct = new Products;
    //         $products = $prdct->readAll(10, $offset);
    //     }
    //     echo json_encode($products);
    // }

    public function getBills($offset = 0){
        if (!isset($_GET['shop_phone'])) {
            echo json_encode(['error' => 'Error: Missing shop phone number']);
            return;
        }
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;
        $bill = new Bills;
        $billItems = new BillItems;
        $bills = $bill->where(['cus_phone' => $_SESSION['customer']['phone'], 'b.so_phone' => $_GET['shop_phone']], [], 10, $offset);
        foreach($bills as &$bill){
            $bill['total'] = $billItems->getBillTotal($bill['bill_id']);
        }
        echo json_encode($bills);
    }

    public function searchBills($offset = 0) {
        if (!filter_var($offset, FILTER_VALIDATE_INT)) $offset = 0;
        $bill = new Bills;
        $billItems = new BillItems;
        $bills = $bill->search($offset, $_GET['search'], $_GET['date']);
        foreach($bills as &$bill){
            $bill['total'] = $billItems->getBillTotal($bill['bill_id']);
        }
        echo json_encode($bills);
    }

    public function getStocks($offset = 0){
        if (!isset($_GET['shop_phone'])) {
            echo json_encode(['error' => 'Error: Missing shop phone number']);
            return;
        }
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        
        $search = $_GET['search'] ?? null;
        $stck = new ShopStock;
        $stocks = $stck->readStock($_GET['shop_phone'], 'DESC', $offset, $search, $_GET['preOrderable']);

        foreach($stocks as &$s){
            if ($s['pre_orderable_stock'] > $s['amount_alowed_per_pre_Order'])
                $s['pre_orderable_stock'] = $s['amount_alowed_per_pre_Order'];
        }

        echo json_encode($stocks);
    }

    public function getBillDetails($billId){
        $bills = new Bills;
        if ($bills->where(['bill_id' => $billId, 'cus_phone' => $_SESSION['customer']['phone']]) == null) {
            echo json_encode(['error' => 'Error: Bill is not alowed for this customer.']);
            return;
        }
        $billItem = new BillItems;
        $Billdata['billItems'] = $billItem->where(['bill_id' => $billId]);
        $Billdata['total'] = 0;
        foreach($Billdata['billItems'] as &$item){
            $item['total'] += $item['sold_price'] * $item['quantity'];
        }
        unset($item);
        foreach($Billdata['billItems'] as $item){
            $Billdata['total'] += $item['total'];
        }
        echo json_encode($Billdata);
    }

    public function placePreOrderP($so_phone) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
            redirect('Customer/shops');

        $preOrderItems = jsonPostDecode()['preOrderItems'];

        $preOrderP = new PreOrder;
        $preOrderItemsP = new PreOrderItems;
        $products = new Products;

        $con = $preOrderP->startTransaction();

        $preOrderP->insert(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $so_phone], $con);
        $preOrderId = $con->lastInsertId();

        foreach ($preOrderItems as &$item) {
            $item['po_unit_price'] = $products->first(['barcode' => $item['barcode']], [],['unit_price'])['unit_price'];
            $item['pre_order_id'] = $preOrderId;
        }

        $preOrderItemsP->bulkInsert($preOrderItems, ['barcode', 'quantity', 'po_unit_price', 'pre_order_id'], $con);
        
        if ($con->commit()){
            $returnData = ['status' => 'success'];
            $notification = new NotificationService;
            $notification->sendNotification($so_phone, 'preOrder',  $preOrderId,'New Pre Order', "{$_SESSION['customer']['first_name']} {$_SESSION['customer']['last_name']} placed a pre-order", "ShopOwner/preOrder/{$preOrderId}", $_SESSION['customer']['phone'].".".$_SESSION['customer']['pic_format']);

        }
        else{
            $returnData = ['status' => 'fail'];
        }
        echo json_encode($returnData);
    }

    public function getAllPreOrders($offset = 0){ 
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $search = $_GET['search'] ?? null;
        $status = $_GET['status'] ?? null;

        $preOrders = $this->loadPreOrders($status, $search, $offset);
        echo json_encode($preOrders);        
    }

    public function getLoyaltyReqs($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $loyaltyReq = new LoyaltyRequests;
        $loyaltyReqs = $loyaltyReq->newLoyReqFromCustomer($offset);
        echo json_encode($loyaltyReqs);
    }




    public function new($viewName) {
        $this->view('Customer/'.$viewName, $this->data);
    }

}