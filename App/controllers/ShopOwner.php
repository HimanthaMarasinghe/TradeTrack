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
        $preOrderUniqueItemsM = new PreOrderUniqueItems;
        $preOrders = $preOrderM->allPreOrdersForShopOwner($_SESSION['shop_owner']['phone'], $status, $search, $offset);
        foreach ($preOrders as &$preOrder) {
            $preOrderDate = new DateTime($preOrder['date_time']);
            $diff = (new DateTime())->diff($preOrderDate);
            if($diff->days < 1)
               $preOrder['date_time'] = $diff->format('%hh %im') . ' ago';
            $preOrder['total'] =$preOrderItemsM->preOrderAmount($preOrder['pre_order_id']);
            $preOrder['total'] += $preOrderUniqueItemsM->preOrderAmount($preOrder['pre_order_id']);
            $preOrder['total'] = number_format($preOrder['total'], 2);
        }
        return $preOrders;
    }

    public function index () 
    {

        //$_SESSION['shop_owner']['phone'] = '0112223333'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';

        $stck = new ShopProductsService;
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
        $this->data['bill'] = $_SESSION['bill']; // For printing the bill
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
        $cus_phone = empty($_POST['cus-phone']) ? null : $_POST['cus-phone'];
        $lastId = $billService-> addBill($cus_phone, $_POST['wallet'] ?? 0);
        $this->data['cus_phone'] = empty($_POST['cus-phone']) ? null : $_POST['cus-phone'];
        $this->data['cus_email'] = $_POST['cus-email'] ?? null;
        $this->data['total'] = $_SESSION['total'];
        $this->data['tabs']['active'] = 'Home';

        unset($_SESSION['total']);
        unset($_SESSION['bill']);

        if ($_POST['cus-phone'])
        (new NotificationService)->sendNotification(
            $_POST['cus-phone'], 
            'bill', 
            $lastId,
            "Bill Settled (ID : {$lastId})", 
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

        $this->data['shouldCheckStock'] = !in_array($this->data['preOrder']['status'], ['Picked', 'Rejected']);
        $preOrderItems = (new PreOrderService)->getPreOrderItems($order_id, $this->data['shouldCheckStock']);

        $this->data['preOrder']['total'] = $preOrderItems['total'];
        $this->data['preOrderItems'] = $preOrderItems['items'];
        $this->data['shouldBeUpdated'] = $preOrderItems['shouldBeUpdated'];
        $this->data['shouldBeRejected'] = $preOrderItems['shouldBeRejected'];

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
        if($this->data['loyalty']){
            $this->data['chat'] = (new Chat)->getMessages($_SESSION['shop_owner']['phone'], $this->data['customer']['phone']);
        }
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
        if ($barcodeIn[0] == 'x') {
            $barcodeIn = substr($barcodeIn, 1, 2);
            $prd = new ShopUniqueProducts;
            $this->data['product'] = $prd->first(['product_code' => $barcodeIn, 'so_phone' => $_SESSION['shop_owner']['phone']]);
            $this->data['tabs']['active'] = 'Stocks';
            $this->view('shopOwner/uniqueProduct', $this->data);
            return;
        }
        $prd = new Products;
        $this->data['product'] = $prd->first(['barcode' => $barcodeIn]);
        $this->data['product']['my_price'] = (new SoMyPrice)->first(['barcode' => $barcodeIn, 'so_phone' => $_SESSION['shop_owner']['phone']], readFields:['price'])['price'] ?? 0;
        $this->data['stock'] = (new ShopStock)->first(data: ['barcode' => $barcodeIn, 'so_phone' => $_SESSION['shop_owner']['phone']], readFields:['quantity', 'pre_orderable_stock', 'amount_alowed_per_pre_Order', 'low_stock_level']);
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/product', $this->data);
    }
    
    public function accounts() {
        $this->data['tabs']['active'] = 'Accounts';

        $shopAcc = (new shops)->first(data: ['so_phone' => $_SESSION['shop_owner']['phone']], readFields:['cash_drawer_balance', 'non_registerd_creditors']);

        $this->data['debtors'] = 0;
        $this->data['creditors'] = $shopAcc['non_registerd_creditors'];
        $this->data['cashDrawerBallance'] = $shopAcc['cash_drawer_balance'];

        $wallets = (new LoyaltyCustomers)->where(data: ['so_phone' => $_SESSION['shop_owner']['phone']], readFields:['wallet']) ?: [];
        array_push($wallets, ...(new WalletSoDis)->where(data: ['so_phone' => $_SESSION['shop_owner']['phone']], readFields:['wallet']) ?: []);
        foreach($wallets as $wallet){
            if ($wallet['wallet'] > 0) $this->data['debtors'] += $wallet['wallet'];
            else $this->data['creditors'] += abs($wallet['wallet']);
        }


        $this->view('shopOwner/accounts', $this->data);
    }

    public function recordTransaction() {
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('shopOwner/recordTransaction', $this->data);
    }

    public function profitAndLossStatement() {
        $this->view('shopOwner/profitAndLossStatement');
    }
    
    public function updateStockView() {
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

    public function orderStocks($dis_phone) {
        $this->data['dis_phone'] = $dis_phone;
        $this->data['dis_busines_name'] = (new DistributorM)->first(data: ['dis_phone' => $dis_phone], readFields: ['dis_busines_name'])['dis_busines_name'];
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/orderStocks', $this->data);
    }

    public function Distributors() {
        
        $this->data['tabs']['active'] = 'Distributors';
        $this->view('shopOwner/distributors', $this->data);

    }

    public function Distributor($dis_phone) {

        $this->data['distributor'] = (new DistributorM)->first(['dis_phone' => $dis_phone]);
        $this->data['distributor']['wallet'] = (new WalletSoDis)->first(data: ['dis_phone' => $dis_phone, 'so_phone' => $_SESSION['shop_owner']['phone']], readFields:['wallet'])['wallet'];
        
        $this->data['tabs']['active'] = 'Distributors';
        $this->view('shopOwner/distributor', $this->data);
    }

    public function addStock() {
        writeToFile($_POST);
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['barcode']) && !empty($_POST['quantity']) && !empty($_POST['cost'])){
            if ($_POST['unique'] == 0) {
                $stck = new ShopStock;
                $orderItems = new ShopOrderItems;
                $code = 'barcode';
                $redirecLink = "ShopOwner/product/{$_POST['barcode']}";
            } else {
                $stck = new ShopUniqueProducts;
                $orderItems = new ShopOrderUniqueItems;
                $code = 'product_code';
                $redirecLink = "ShopOwner/product/x{$_POST['barcode']}";
            }

            $con = $stck->startTransaction();
            $stck->updateStock($_POST['barcode'], $_SESSION['shop_owner']['phone'], $_POST['quantity'], $con);

            (new ShopOrder)->insert(['so_phone' => $_SESSION['shop_owner']['phone'], 'status' => 'Delivered'], $con);
            $lastId = $con->lastInsertId();
            $sold_bulk_price = $_POST['cost'] / $_POST['quantity'];
            $orderItems->insert(['order_id' => $lastId, $code => $_POST['barcode'], 'quantity' => $_POST['quantity'], 'sold_bulk_price' => $sold_bulk_price], $con);

            $shop = new Shops;

            switch ($_POST['purchaseType']) {
                case 'fromDrawer':
                    $shop->updateCashDrawer($_SESSION['shop_owner']['phone'], -1 * $_POST['cost'], $con);
                    break;
                case 'onCredit':
                    $shop->updateCreditors($_SESSION['shop_owner']['phone'], $_POST['cost'], $con);
                    break;
            }

            $con->commit();
            redirect( $redirecLink);
            return;
        }
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/addStock', $this->data);
    }

    public function ordersHistory() {
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/ordersHistory', $this->data);
    }

    // Form Submition
    
    public function editProduct($barcode, $old_my_price, $old_low_stock_level, $old_aapp) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_POST['unitPrice'] == null)
                (new SoMyPrice)->delete(['so_phone' => $_SESSION['shop_owner']['phone'], 'barcode' => $barcode]);
            else if($_POST['unitPrice'] != $old_my_price) 
                (new SoMyPrice)->editMyPrice($_POST['unitPrice'], $_SESSION['shop_owner']['phone'], $barcode);
            if($_POST['aapp'] != $old_aapp || $_POST['lowStockLevel'] != $old_low_stock_level) 
                (new ShopStock)->updateStockDetail($_SESSION['shop_owner']['phone'], $barcode, $_POST['lowStockLevel'], $_POST['aapp']);
            redirect(path: "ShopOwner/product/{$barcode}");
        }
    }

    public function addUniqueProduct() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new ShopUniqueProducts;
            $data = $_POST;
            $data['product_code'] = substr($data['product_code'], 1, 2);
            $data['so_phone'] = $_SESSION['shop_owner']['phone'];
            if(!$model->first(['product_code' => $data['product_code'], 'so_phone' => $data['so_phone']])) {
                $data['pic_format'] = (new ImageUploader)->upload('image', $data['so_phone'].$data['product_code'], 'Products') ?: null;
                $model->insert($data);
            }
            redirect( "ShopOwner/product/x{$data['product_code']}");
        } else {
            redirect('ShopOwner/addStock');
        }
    }

    public function editUniqueProduct() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model = new ShopUniqueProducts;
            $data = $_POST;
            $data['product_code'] = substr($data['product_code'], 1, 2);
            $imageUploader = new ImageUploader;
            writeToFile($data['remove_image'], 'remove_image');
            writeToFile($data);
            writeToFile($_POST);
            if($data['remove_image'] == 'true') {
                $oldPicFormat = $model->first(['product_code' => $data['product_code'], 'so_phone' => $_SESSION['shop_owner']['phone']], readFields: ['pic_format'])['pic_format'];
                $imageUploader->removeImage("Products/{$_SESSION['shop_owner']['phone']}{$data['product_code']}.{$oldPicFormat}");
                $data['pic_format'] = null;
            }
            $pic_format = $imageUploader->upload('image', $_SESSION['shop_owner']['phone'].$data['product_code'], 'Products') ?: null;
            if($pic_format) {
                $data['pic_format'] = $pic_format;
                $oldPicFormat = $model->first(['product_code' => $data['product_code'], 'so_phone' => $_SESSION['shop_owner']['phone']], readFields: ['pic_format'])['pic_format'];
                if($oldPicFormat !== $pic_format) {
                    $imageUploader->removeImage("Products/{$_SESSION['shop_owner']['phone']}{$data['product_code']}.{$oldPicFormat}");
                }
            }
            $model->update(['product_code' => $data['product_code'], 'so_phone' => $_SESSION['shop_owner']['phone']], $data);
            redirect('ShopOwner/product/x'.$data['product_code']);
        }else{
            redirect('ShopOwner/addStock');
        }
    }
    
    public function recordWaste($barcode) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            (new ShopStock)->updateStock($barcode, $_SESSION['shop_owner']['phone'], -1*$_POST['quantity']);
        }
        redirect(path: "ShopOwner/product/{$barcode}");
    }

    public function recordUniqueWaste($barcode) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            (new ShopUniqueProducts)->updateStock($barcode, $_SESSION['shop_owner']['phone'], -1*$_POST['quantity']);
        }
        redirect(path: "ShopOwner/product/x{$barcode}");
    }

    public function removeFromStock($barcode) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            (new ShopStock)->delete(['barcode' => $barcode, 'so_phone' => $_SESSION['shop_owner']['phone']]);
        }
        redirect(path: "ShopOwner/product/{$barcode}");
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

    public function getProducts($offset = 0){ 
        $search = $_GET['search'] ?? null;
        $products = (new ShopProductsService)->newProducts($_SESSION['shop_owner']['phone'], $offset, $search) ?: [];
        echo json_encode($products);
    }

    public function getStocks($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        
        $search = $_GET['search'] ?? null;
        $stck = new ShopProductsService;
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

        if ($_GET['barcode'])
            $distributors = $distributor->distributorsForProduct($offset, $search, $_GET['barcode']);
        else
            $distributors = $distributor->searchDistributors($search, $offset);
        
        header('Content-Type: application/json');
        echo json_encode($distributors);
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
            $con = $preOrder->startTransaction();
            $preOrder->update(['pre_order_id' => $_POST['pre_order_id'], 'so_phone' => $_SESSION['shop_owner']['phone']], ['status' => $_POST['status']], $con);
            
            $cus_phone = $preOrder->first(['pre_order_id' => $_POST['pre_order_id']], [], ['cus_phone'])['cus_phone'];

            switch ($_POST['status']) {
                case 'Processing':
                    $title = 'Pre-Order Processing';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} is now being processed.";
                    break;
                case 'Ready':
                    (new ShopStock)->updateStockOnPreOrder($_POST['pre_order_id'], $con);
                    (new ShopUniqueProducts)->updateStockOnPreOrder($_POST['pre_order_id'], $con);
                    $title = 'Pre-Order Ready';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} is ready for pickup.";
                    break;
                case 'Picked':
                    if(empty($_POST['wallet_update'])) {
                        $con->rollBack();
                        echo json_encode(['success' => false]);
                        return;
                    }
                    $preOrderItems = (new PreOrderItems)->readPreOrderItems($_POST['pre_order_id']) ?: [];
                    foreach($preOrderItems as &$item){
                        $item['unique'] = 0;
                    }
                    $preOrderUniqueItems = (new PreOrderUniqueItems)->readPreOrderItems($_POST['pre_order_id']) ?: [];
                    foreach($preOrderUniqueItems as &$item){
                        $item['unique'] = 1;
                    }
                    $preOrderItems = array_merge($preOrderItems, $preOrderUniqueItems);
                    (new BillService)->addBill($cus_phone, $_POST['wallet_update'], $preOrderItems, $con);
                    $title = 'Pre-Order Picked';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} has been picked.";
                    break;
                case 'Rejected':
                    (new ShopStock)->updatePreOrderableStockByOrder($_POST['pre_order_id'], $con, true);
                    (new ShopUniqueProducts)->updatePreOrderableStockByOrder($_POST['pre_order_id'], $con, true);
                    $title = 'Pre-Order Rejected';
                    $body = "Your pre-order at {$_SESSION['shop_owner']['shop_name']} has been rejected.";
                    break;
            };

            if(!$con->commit()){
                echo json_encode(['success' => false]);
                return;
            }

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
            $shopStock = new ShopStock;
            $preOrderUniqueItems = new PreOrderUniqueItems;
            $shopUniqueProducts = new ShopUniqueProducts;
            $con = $preOrder->startTransaction();
            $preOrder->update(['pre_order_id' => $_POST['pre_order_id']], ['status' => 'Updated'], $con);
            $shopStock->updatePreOrderableStockByOrder($_POST['pre_order_id'], $con, true);
            $shopUniqueProducts->updatePreOrderableStockByOrder($_POST['pre_order_id'], $con, true);

            $preOrderCommonItemsArray = array_filter($newPreOrderItems, function($item) {
                return $item['barcode'][0] != 'x';
            });

            $preOrderUniqueItemsArray = array_filter($newPreOrderItems, function($item) {
                return $item['barcode'][0] == 'x';
            });

            if(count($preOrderCommonItemsArray) > 0){
                foreach($preOrderCommonItemsArray as $item){
                    if($item['quantity'] == 0) $preOrderItems->delete(['pre_order_id' => $_POST['pre_order_id'], 'barcode' => $item['barcode']], $con);
                    else $preOrderItems->update(['pre_order_id' => $_POST['pre_order_id'], 'barcode' => $item['barcode']], ['quantity' => $item['quantity']], $con);
                }
                // $shopStock->updatePreOrderableStockItems($newPreOrderItems, $_SESSION['shop_owner']['phone'], $con);
            }

            if(count($preOrderUniqueItemsArray) > 0){
                foreach($preOrderUniqueItemsArray as $item){
                    if($item['quantity'] == 0) $preOrderUniqueItems->delete(['pre_order_id' => $_POST['pre_order_id'], 'product_code' => substr($item['barcode'], 1)], $con);
                    else $preOrderUniqueItems->update(['pre_order_id' => $_POST['pre_order_id'], 'product_code' => substr($item['barcode'], 1)], ['po_quantity' => $item['quantity']], $con);
                }
                // $shopUniqueProducts->updatePreOrderableStockItems($newPreOrderItems, $_SESSION['shop_owner']['phone'], $con);
            }

            if ($con->commit()) {
                $shopStock->updatePreOrderableStockByOrder($_POST['pre_order_id'], null);
                $shopUniqueProducts->updatePreOrderableStockByOrder($_POST['pre_order_id'], null);
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
            if($_POST['barcodeIn'][0] == 'x' && strlen($_POST['barcodeIn']) == 3)
                $item = (new ShopUniqueProducts)->first(['product_code' => substr($_POST['barcodeIn'], 1), 'so_phone' => $_SESSION['shop_owner']['phone']]);
            else 
                $item = (new ShopProductsService)->getProduct($_POST['barcodeIn'], $_SESSION['shop_owner']['phone']);

            echo json_encode($item);
        }
    }

    public function addBillItemsToSession() {
        $_SESSION['bill'] = jsonPostDecode();
        echo json_encode(['status' => 'success']);
    }

    public function accountsForMonth($month, $year) {
        if (!filter_var($month, FILTER_VALIDATE_INT) || !filter_var($year, FILTER_VALIDATE_INT) || $month < 1 || $month > 12 || $year < 2000 || $year > 2100) {
            $year = date('Y');
            $month = date('n');
        }
        $accounts['income'] = (new BillItems)->getBillsTotal($month, $year) ?? 0;
        $accounts['expenses'] = (new soOtherExpences)->totalForMonth($year, $month, $_SESSION['shop_owner']['phone']) ?? 0;
        $accounts['expenses'] += (new ShopOrder)->monthlyTotla($month, $year);
        $accounts['profit'] = $accounts['income'] - $accounts['expenses'];
        echo json_encode($accounts);
    }

    public function getNewStockDetails($offset) {
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        $details = (new DistributorStocks)->search($_GET['disPhone'], $_GET['search'], $_GET['orderable'], $offset);
        header('Content-Type: application/json');
        echo json_encode($details);
    }

    public function placeStockOrder($dis_phone) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
            redirect("ShopOwner/orderStocks/{$dis_phone}");

        $orderItems = jsonPostDecode()['orderItems'];

        $shopOrder = new ShopOrder;
        $shopOrderItems = new ShopOrderItems;

        $con = $shopOrder->startTransaction();
        $shopOrder->insert(['dis_phone' => $dis_phone, 'so_phone' => $_SESSION['shop_owner']['phone']], $con);
        $orderId = $con->lastInsertId();

        $orderItems = array_map(function($item) use ($orderId) {
            $item['order_id'] = $orderId;
            $item['sold_bulk_price'] = (new Products)->first(data:['barcode' => $item['barcode']], readFields:['bulk_price'])['bulk_price'];
            return($item);
        }, $orderItems);

        $shopOrderItems->bulkInsert($orderItems, ['barcode', 'quantity', 'order_id', 'sold_bulk_price'], $con);

        if ($con->commit()){
            $returnData = ['status' => 'success'];
            (new NotificationService)->sendNotification(
                $dis_phone, 
                'stkOrdr',  
                $orderId,
                'New Order', 
                "{$_SESSION['shop_owner']['first_name']} {$_SESSION['shop_owner']['last_name']} placed an order", 
                "ShopOwner/preOrder/{$orderId}", 
                "Profile/{$_SESSION['shop_owner']['phone']}.{$_SESSION['shop_owner']['pic_format']}");
        }
        else{
            $returnData = ['status' => 'fail'];
        }
        echo json_encode($returnData);
    }

    public function getAllStockOrders($offset = 0){ 
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $search = $_GET['search'] ?? null;
        $status = $_GET['status'] ?? null;
        $dis_phone = $_GET['dis_phone'] ?? null;
        $date = $_GET['date'] ?? null;

        $orders = (new ShopOrder)->search($search, $status, $offset, $dis_phone, $date);
        header('Content-Type: application/json');
        echo json_encode($orders);        
    }

    public function getOrderDetails($order_id){
        $order = (new ShopOrder)->first(['order_id' => $order_id, 'o.so_phone' => $_SESSION['shop_owner']['phone']]);
        if (!$order){
            echo json_encode(['error' => 'Error: Orders is not avilable']);
            return;
        }
        $orderDetails = (new ShopOrderItems)->orderDetails($order_id) ?: (new ShopOrderUniqueItems)->orderDetails($order_id);
        writeToFile($orderDetails);
        echo json_encode($orderDetails);
    }

    public function recordExpence() {
        $shop = new Shops;
        $con = $shop->startTransaction();
        $cashDrawer = 0;
        if($_POST['cashDrawer']){
            $cashDrawer = 1;
            $shop->updateCashDrawer($_SESSION['shop_owner']['phone'], -1*$_POST['amount'], $con);
        }
        (new soOtherExpences)->insert(['date' => $_POST['date'], 'time' => $_POST['time'], 'cashDrawer' => $cashDrawer, 'type' => $_POST['type'], 'amount' => $_POST['amount'], 'so_phone' => $_SESSION['shop_owner']['phone']], $con);
        if($con->commit())
            echo json_encode(['success' => true]);
        else
            echo json_encode(['success' => false]);
    }

    public function getAllExpences($offset) {
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $data = ['so_phone' => $_SESSION['shop_owner']['phone']];

        if ($_GET['date']) $data['date'] = $_GET['date'];
        if ($_GET['type'] != 'all') $data['type'] = $_GET['type'];
            
        $cashFlows = (new soOtherExpences)->where(data: $data, offset: $offset, limit: 10, orderBy:['date', 'time']);

        header('Content-Type: application/json');
        echo json_encode($cashFlows);  
    }

    public function recordCashFlow() {
        $soCashDraweFlow = new soCashDrawerFlow;
        $con = $soCashDraweFlow->startTransaction();
        $amount = $_POST['type'] == 'Add cash in' ? $_POST['amount'] : -1*$_POST['amount'];
        $soCashDraweFlow->insert(['so_phone' => $_SESSION['shop_owner']['phone'], 'date' => $_POST['date'], 'time' => $_POST['time'], 'type' => $_POST['type'], 'amount' => $amount], $con);
        (new Shops)->updateCashDrawer($_SESSION['shop_owner']['phone'], $amount, $con);
        if($con->commit())
            echo json_encode(['success' => true]);
        else
            echo json_encode(['success' => false]);
    }

    public function getAllCashFlows($offset = 0){ 
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid

        $data = ['so_phone' => $_SESSION['shop_owner']['phone']];

        if ($_GET['date']) $data['date'] = $_GET['date'];
            
        $cashFlows = (new soCashDrawerFlow)->where(data: $data, offset: $offset, limit: 10, orderBy:['date', 'time']);

        header('Content-Type: application/json');
        echo json_encode($cashFlows);        
    }

    public function fetchChashDrawer() {
        echo json_encode(['cashDrawer' => (new shops)->first(['so_phone' => $_SESSION['shop_owner']['phone']])['cash_drawer_balance']]);
    }

    public function payToDistributor(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $SoDisPayment = new SoDisPayment;
            $con = $SoDisPayment->startTransaction();
            $SoDisPayment->insert(['so_phone' => $_SESSION['shop_owner']['phone'], 'dis_phone' => $_POST['dis_phone'], 'ammount' => $_POST['amount'], 'status' => 0], $con);
            $cashDrawer = 0;
            if($_POST['cashDrawer']){
                $cashDrawer = 1;
                (new Shops)->updateCashDrawer($_SESSION['shop_owner']['phone'], -1*$_POST['amount'], $con);
            }
            (new soOtherExpences)->insert(['cashDrawer' => $cashDrawer, 'type' => 'Payed to Creditors', 'amount' => $_POST['amount'], 'so_phone' => $_SESSION['shop_owner']['phone']], $con);
            $success = $con->commit();
            echo json_encode(['success' => $success]);
        }
    }

    public function getDisPayments($offset = null) {
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;  // Default to 0 if invalid
        $dis_phone = $_GET['dis_phone'];
        $search = $_GET['search'];
        $date = $_GET['date'];
        $payments = (new SoDisPayment)->searchPayment($dis_phone, $search, $date, $offset, $_SESSION['shop_owner']['phone']);
        echo json_encode($payments);
    }

    public function productCodeCheck($code) {
        $codeOk = (new ShopUniqueProducts)->first(['product_code' => $code, 'so_phone' => $_SESSION['shop_owner']['phone']]) ? false : true;
        echo json_encode($codeOk);
    }

    public function setOrderStatusToReceived($orderId) {
        $shopOrder = new ShopOrder;
        $con = $shopOrder->startTransaction();
        $shopOrder->update(['order_id' => $orderId, 'so_phone' => $_SESSION['shop_owner']['phone']], ['status' => 'Delivered'], $con);
        (new ShopStock)->updateStockOnOrder($orderId, $con);
        $success = $con->commit();
        echo json_encode(['success' => $success]);
    }
}