<?php

class Distributor extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Shops','Orders', 'Stocks', 'Manufacturer'], 'userType' => 'Distributor'],
        'styleSheet' => ['styleSheet'=>'distributor']
    ];

    public function __construct() {
        if(!isset($_SESSION['distributor']['phone'])){
            redirect('login');
            exit;
        }
    }

    //create new methods after this line.

    public function index(){
        $this->data['order'] = (new ShopOrder)->where(['status' => 'pending','dis_phone' => $_SESSION['distributor']['phone']]);
        
        $this->data['product'] = (new distributorStocks)->getLowStock();
        $this->data['tabs']['active'] = 'Home';
        $this->view('Distributor/home', $this->data);
    }

    public function stocks(){
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('Distributor/stocks', $this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('Distributor/shops', $this->data);
    }

    public function shopProfile($so_phone){
        $shop = new shops;
        $this->data["shop"] = $shop->first(['so_phone' => $so_phone]);
        $this->data['wallet'] = (new WalletSoDis)->first(['so_phone' => $so_phone, 'dis_phone' => $_SESSION['distributor']['phone']]);
        $this->data['tabs']['active'] = 'Shops';
        $this->view('Distributor/shopProfile', $this->data);
    }

    public function orderDetails($order_id){
        $order = new ShopOrder;
        $this->data['order'] = $order->first(['order_id' => $order_id, 'dis_phone' => $_SESSION['distributor']['phone']]);
        if(!$this->data['order']) redirect('Distributor/orders');
        
        $this->data['orderItems'] = (new ShopOrderItems)->where(['order_id' => $order_id]);
        $this->data['netTotal'] = 0;
        foreach($this->data['orderItems'] as &$item){
            $item['total'] = $item['sold_bulk_price'] * $item['quantity'];
            $this->data['netTotal'] += $item['total'];
        }
        $this->data['tabs']['active'] = 'Orders';
        $this->view('Distributor/orderDetails', $this->data);
    }

    public function Manufacturer(){
        $man = new Manufacturers;
        $this->data['man'] = $man->first(['man_phone' => $_SESSION['distributor']['man_phone']]);

        $this->data['wallet'] = (new WalletDisMan)->first(['man_phone' => $_SESSION['distributor']['man_phone'], 'dis_phone' => $_SESSION['distributor']['phone']]);
        
        $this->data['tabs']['active'] = 'Manufacturer';
        $this->view('Distributor/manufacturer', $this->data);
    }

    public function addManPayment(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $payment = new DisManPayments;
            $payment->insert(['dis_phone' => $_SESSION['distributor']['phone'], 'man_phone' => $_SESSION['distributor']['man_phone'], 'ammount' => $_POST['ammount']]);
        }
        redirect("Distributor/manufacturer");
    }

    public function recordTransaction(){
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('Distributor/recordTransaction', $this->data);
    }

    public function newInventryRequest(){
        $product = new Products;
        $this->data['products'] = $product->where(['man_phone'=> $_SESSION['distributor']['man_phone']]);
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('Distributor/newInventryRequest', $this->data);
    }

    public function orders(){
        $this->data['tabs']['active'] = 'Orders';
        $this->view('Distributor/orders', $this->data);
    }

    public function placeOrder(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $input = file_get_contents('php://input');

            // Decode the JSON data into a PHP array
            $billItems = json_decode($input, true);

            // $distributor = new DistributorM;
            // $man_phone = $distributor->first(['dis_phone'=> $_SESSION['distributor']['phone']])['man_phone'];
            $orders = new distributorOrders;
            $orderItems = new distributorOrdersItems;
            $con = $orders->startTransaction();
            $orders->insert(['dis_phone' => $_SESSION['distributor']['phone'], 'man_phone' => $_SESSION['distributor']['man_phone']], $con);
            $lastId = $orders->lastId($con);
            foreach ($billItems as &$item) {
                $item['order_id'] = $lastId;
            }
            $orderItems->bulkInsert($billItems, ['barcode', 'quantity', 'order_id'], $con);
            $con->commit();
        }
        echo json_encode(['success' => 'success']);
    }

    public function requestDetails(){
        $orders = new distributorOrders;
        $orderItems = new distributorOrdersItems;
        $this->data['pendingOrders'] = $orders->getOrderDetails($_SESSION['distributor']['phone']);

        foreach ($this->data['pendingOrders'] as &$order) {
            $order['total'] = $orderItems->getOrderTotal($order['order_id']);
        }

        $this->data['tabs']['active'] = 'Stocks';
        $this->view('Distributor/requestDetails', $this->data);
    }

    public function requestDetail($order_id){
        $orderItems = new distributorOrdersItems;
        $order = new distributorOrders;
        $OrderData['orderProducts'] = $orderItems->where(['order_id' => $order_id]);
        $OrderData['total'] = $orderItems->getOrderTotal($order_id);
        $OrderData['order'] = $order->first(['order_id' => $order_id]);
        header('Content-Type: application/json');
        echo json_encode($OrderData);
    }

    // public function searchRequestDetails(){
    //     $search = $_GET['searchTerm'];
    //     $filter = $_GET['filter'] ?? null;
    //     $date = $_GET['date'] ?? null;
    //     $order = new distributorOrders;
    //     $orders = $order->searchRequestDetails($search, $date, $filter) ?: [];
    //     header('Content-Type: application/json');
    //     echo json_encode($orders);

    // }

    public function deleteOrder($order_id){
        if($_SERVER['REQUEST_METHOD'] !== 'DELETE'){
            echo json_encode(['error' => 'Method not allowed']);
            return;
        }
        $order = new distributorOrders;
        if($order->first(['order_id' => $order_id])['status'] !== 'Pending'){
            echo json_encode(['error' => 'Order cannot be deleted']);
            return;
        }
        $orderItems = new distributorOrdersItems;
        $orderItems->delete(['order_id' => $order_id]);
        $order->delete(['order_id' => $order_id]);
        echo json_encode(['success' => 'Order deleted']);
    }

    public function editInventoryRequest($request_id) {
        $product = new Products;
        // $distributor = new DistributorM;
        $orderItems = new distributorOrdersItems;
        $order = new distributorOrders;
        // $distDetail = $distributor->first(['dis_phone'=> $_SESSION['distributor']['phone']]);
        $this->data['OrderData']['orderProducts'] = $orderItems->where(['order_id' => $request_id]);
        $this->data['OrderData']['total'] = $orderItems->getOrderTotal($request_id);
        $this->data['OrderData']['order'] = $order->first(['order_id' => $request_id]);
        $this->data['products'] = $product->where(['man_phone'=> $_SESSION['distributor']['man_phone']]);
        // header('Content-Type: application/json');
        // echo json_encode($this->data);
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('Distributor/editInventryRequest', $this->data);
    }

    public function updateRequest($order_id){
        $order = new distributorOrders;
        if($order->first(['order_id' => $order_id])['status'] !== 'Pending'){
            echo json_encode(['error' => 'Order cannot be edited']);
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = file_get_contents('php://input');
            $billItems = json_decode($input, true);
            $orderItems = new distributorOrdersItems;
            $con = $orderItems->startTransaction();
            $order->update(['order_id' => $order_id], ['date' => date('Y-m-d'), 'time' => date('H:i:s')], $con);
            $orderItems->delete(['order_id' => $order_id], $con);
            foreach ($billItems as &$item) {
                $item['order_id'] = $order_id;
            }
            $orderItems->bulkInsert($billItems, ['barcode', 'quantity', 'order_id'], $con);
            $con->commit();
        }
        echo json_encode(['success' => 'success']);
    }

    public function announcements(){
        $announcement = new Announcements;
        
        $this->data['announcements'] = $announcement->where(['role' => 3]);
        $this->data['tabs']['active'] = 'Home';
        $this->view('Distributor/announcements', $this->data);
    }

    //API Methods

    public function getAnnouncement($id){
        $announcement = new Announcements;
        $announcement = $announcement->first(['id' => $id]);
        echo json_encode($announcement);
    }

    public function searchOrders($so_phone = null) {
        $search = $_GET['searchTerm'];
        $filter = $_GET['filter'] ?? null;
        $date = $_GET['date'] ?? null;
        $order = new ShopOrder;
        $orders = $order->searchOrders($search, $so_phone, $date, $filter) ?: [];
        header('Content-Type: application/json');
        echo json_encode($orders);
    }

    public function searchStocks() {
        $search = $_GET['searchTerm'];
        $stock = new distributorStocks;
        $stocks = $stock->searchStocks($search) ?: [];
        header('Content-Type: application/json');
        echo json_encode($stocks);
    }

    public function searchShops(){
        $search = $_GET['searchTerm'];
        $loyalty = $_GET['loyalty'];
        $shop = new Shops;
        $shops = $shop->searchShops($search, $loyalty) ?: [];
        header('Content-Type: application/json');
        echo json_encode($shops);
    }

    public function searchPayment(){
        $searchPayment = $_GET['searchPay'];
        $paymentDate = $_GET['datePay'] ?? null ;
        writeToFile($_GET);
        $payments = (new SoDisPayment)->searchPayment($_SESSION['distributor']['phone'], $searchPayment,$paymentDate) ?: [];
        header('Content-Type: application/json');
        echo json_encode($payments);
    }

    public function searchDisManPayment(){
        $searchPayment = $_GET['searchPay'];
        $paymentDate = $_GET['datePay'] ?? null ;
        writeToFile($_GET);
        $payments = (new DisManPayments)->searchPayment($searchPayment,$paymentDate) ?: [];
        header('Content-Type: application/json');
        echo json_encode($payments);
    }
    
    public function new($viewName) {
        $this->view('Distributor/'.$viewName, $this->data);
    }

    public function updateOrderStatus($order_id){
        $status = $_POST['status'];
        $order = new ShopOrder;
        if($status == 'Pending'){
            $order->update(['order_id' => $order_id],['status' => 'Processing']);
        }else if($status == 'Processing'){
            $order->update(['order_id' => $order_id],['status' => 'Delivering']);   
            (new distributorStocks)->calculateNewStock($order_id);
        }else if($status == 'Delivering'){
            $order->update(['order_id' => $order_id],['status' => 'Delivered']);
        }
        redirect("Distributor/orderDetails/$order_id");
    }

    public function cancelOrder($order_id){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            (new ShopOrder)->update(['order_id' => $order_id,'dis_phone' => $_SESSION['distributor']['phone']],['status' => 'Cancelled']);
            (new distributorStocks)->calculateNewStock($order_id, 1);
        }
    }

    public function updatePaymentStatus($id){
        $status = $_POST['status'];
        $payment = new SoDisPayment;
        if($status == 0){
            $payment->update(['id' => $id],['status' => 1]);
        }
        // Redirect back to previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function editLowQuantityLevel($barcode){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            (new distributorStocks)->update(['barcode' => $barcode, 'dis_phone' => $_SESSION['distributor']['phone']],['low_quantity_level' => $_POST['lowQuantityLevel']]);
            redirect("Distributor/Stocks/$barcode");
        }
    }
}