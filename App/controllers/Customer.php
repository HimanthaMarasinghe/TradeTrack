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
        $this->data['shop_name'] = (new Shops)->first(data: ['so_phone' => $so_phone], readFields: ['shop_name'])['shop_name'];
        $this->data['so_phone'] = $so_phone;
        $this->data['tabs']['active'] = 'Shops';
        $this->view('Customer/placePreOrder',$this->data);
    }

    public function products(){
        $this->data['tabs']['active'] = 'Products';
        $this->view('Customer/Products',$this->data);
    }

    public function product($barcode, $so_phone = null){
        if(strlen($barcode) == 2 && $so_phone != null) {
            $this->data['product'] = (new ShopUniqueProducts)->first(['product_code' => $barcode, 'so_phone' => $so_phone]);
            $this->data['product']['barcode'] = "x$barcode";
            $this->data['product']['picture'] = $so_phone.$barcode.".".$this->data['product']['pic_format'];
            $this->data['shops'] = [(new Shops)->first(['so_phone' => $so_phone])];
        }
        else {
            $this->data['product'] = (new Products)->first(['barcode' => $barcode]);
            $this->data['product']['picture'] = $barcode.".".$this->data['product']['pic_format'];
            $this->data['shops'] = (new ShopStock)->shopsThatSellProduct($barcode);
        }
        $this->data['tabs']['active'] = 'Products';
        $this->view('Customer/product',$this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
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
        else
            $this->data['chat'] = (new Chat)->getMessages($_SESSION['customer']['phone'], $sop);        
        $this->data['tabs']['active'] = 'Shops';
        $this->view('Customer/shop',$this->data);
    }

    public function announcements(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/announcements', $this->data);
    }

    public function preOrderHistory() {
        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/preOrderHistory', $this->data);
    }

    public function preOrder($order_id) {
        $preOrder = new PreOrder;
        $preOrderItems = new PreOrderItems;
        $this->data['preOrder'] = $preOrder->preOrderDetailsForCustomer($order_id);
        
        if(!$this->data['preOrder'])
            redirect('Customer/preOrderHistory');

        $this->data['preOrder']['total'] = $preOrderItems->preOrderAmount($order_id);
        $this->data['preOrderItems'] = $preOrderItems->where(['pre_order_id' => $order_id]);

        foreach ($this->data['preOrderItems'] as &$item) {
            $item['row_total'] = number_format($item['po_unit_price'] * $item['quantity'], 2);
        }

        $this->data['tabs']['active'] = 'Home';
        $this->view('customer/preOrder', $this->data);
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

            (new NotificationService)->sendNotification(
                $_POST['so_phone'], 
                'loyaltyReq',  
                $_SESSION['customer']['phone'],
                'New Loyalty Request', 
                "{$_SESSION['customer']['first_name']} {$_SESSION['customer']['last_name']} requested to be a loyalty customer", 
                "ShopOwner/loyaltyCustomerRequest/{$_SESSION['customer']['phone']}", 
                "Profile/{$_SESSION['customer']['phone']}.{$_SESSION['customer']['pic_format']}");
            echo json_encode(['success' => true]);
        }
        else
            redirect('Customer/shops');
    }

    public function getStocks($offset = 0){
        if (!isset($_GET['shop_phone'])) {
            echo json_encode(['error' => 'Error: Missing shop phone number']);
            return;
        }
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        
        $search = $_GET['search'] ?? null;
        $stck = new ShopProductsService;
        $stocks = $stck->readStock($_GET['shop_phone'], 'DESC', $offset, $search, $_GET['preOrderable']);

        foreach($stocks as &$s){
            if ($s['pre_orderable_stock'] > $s['amount_alowed_per_pre_Order'])
                $s['pre_orderable_stock'] = $s['amount_alowed_per_pre_Order'];
        }

        echo json_encode($stocks);
    }

    public function getBillDetails($billId){
        $bills = new Bills;
        if ($bills->first(['bill_id' => $billId, 'cus_phone' => $_SESSION['customer']['phone']]) == null) {
            echo json_encode(['error' => 'Error: Bill is not alowed for this customer.']);
            return;
        }
        $Billdata = (new BillService)->readBill($billId);
        echo json_encode($Billdata);
    }

    public function placePreOrderP($so_phone) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
            redirect('Customer/shops');

        $preOrderItems = jsonPostDecode()['preOrderItems'];

        $preOrderP = new PreOrder;
        $preOrderItemsP = new PreOrderItems;
        $products = new Products;
        $shopStock = new ShopStock;

        $con = $preOrderP->startTransaction();

        $preOrderP->insert(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $so_phone], $con);
        $preOrderId = $con->lastInsertId();

        foreach ($preOrderItems as &$item) {
            $price = (new SoMyPrice)->first(['barcode' => $item['barcode'], 'so_phone' => $so_phone], [], ['price'])['price'];
            $item['po_unit_price'] = $price ?: $products->first(['barcode' => $item['barcode']], [],['unit_price'])['unit_price'];
            $item['pre_order_id'] = $preOrderId;
        }

        $preOrderItemsP->bulkInsert($preOrderItems, ['barcode', 'quantity', 'po_unit_price', 'pre_order_id'], $con);
        $shopStock->updatePreOrderableStockItems($preOrderItems, $so_phone, $con);
        
        if ($con->commit()){
            $returnData = ['status' => 'success'];
            (new NotificationService)->sendNotification(
                $so_phone, 
                'preOrder',  
                $preOrderId,
                'New Pre Order', 
                "{$_SESSION['customer']['first_name']} {$_SESSION['customer']['last_name']} placed a pre-order", 
                "ShopOwner/preOrder/{$preOrderId}", 
                "Profile/{$_SESSION['customer']['phone']}.{$_SESSION['customer']['pic_format']}");
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

    public function changePreOrderStatus($preOrderId){ 
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $preOrderId === null) redirect('Customer/preOrderHistory');
        $s = jsonPostDecode();
        if ($s === 1){
            $status = 'Pending';
            $title = "Updated Pre-Order Accepted";
            $body = "{$_SESSION['customer']['first_name']} {$_SESSION['customer']['last_name']} accepted the changes in the pre-order";
        } else if ($s === 2){
            (new ShopStock)->updatePreOrderableStockByOrder($_POST['pre_order_id'], null, true);
            $status = 'Canceled';
            $title = "Pre-Order got Canceled";
            $body = "{$_SESSION['customer']['first_name']} {$_SESSION['customer']['last_name']} canceled the pre-order";
        }
        $preOrderM = new PreOrder;
        $preOrderM->update(['cus_phone' => $_SESSION['customer']['phone'], 'pre_order_id' => $preOrderId], ['status' => $status]);
        $so_phone = $preOrderM->first(['cus_phone' => $_SESSION['customer']['phone'], 'pre_order_id' => $preOrderId], [], ['so_phone'])['so_phone'];
        (new NotificationService)->sendNotification(
            $so_phone,
            'preOrder',
            $preOrderId,
            $title,
            $body,
            "ShopOwner/preOrder/{$preOrderId}", 
            "Profile/{$_SESSION['customer']['phone']}.{$_SESSION['customer']['pic_format']}");
        echo json_encode(true);
    }


    public function new($viewName) {
        $this->view('Customer/'.$viewName, $this->data);
    }

}