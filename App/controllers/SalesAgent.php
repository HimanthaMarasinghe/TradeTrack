<?php

class SalesAgent extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Shops','Loyalty Shops','Orders', 'Stocks', 'Accounts'], 'userType' => 'SalesAgent'],
        'styleSheet' => ['styleSheet'=>'salesAgent']
    ];

    public function __construct() {
        if(!isset($_SESSION['sa_phone'])){
            redirect('login');
            exit;
        }
    }

    //create new methods after this line.

    public function index(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('SalesAgent/home', $this->data);
    }

    public function stocks(){
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/stocks', $this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/shops', $this->data);
    }

    public function loyaltyShops(){
        $this->data['tabs']['active'] = 'Loyalty Shops';
        $this->view('SalesAgent/customerShops', $this->data);
    }

    public function shopProfile(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/shopProfile', $this->data);
    }

    public function orderDetails(){
        $this->data['tabs']['active'] = 'Orders';
        $this->view('SalesAgent/orderDetails', $this->data);
    }

    public function accounts(){

        // $otherExpense = new SaOtherExpenses;
        
        // $this->data['otherExpenses'] = $otherExpense->where(['sa_phone' => $_SESSION['sa_phone']]);

        $this->data['tabs']['active'] = 'Accounts';
        $this->view('SalesAgent/accounts', $this->data);
    }

    public function recordTransaction(){
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('SalesAgent/recordTransaction', $this->data);
    }

    public function newInventryRequest(){
        $product = new Products;
        $distributor = new SalesAgentM;
        $distDetail = $distributor->first(['sa_phone'=> $_SESSION['sa_phone']]);
        $this->data['products'] = $product->where(['man_phone'=> $distDetail['su_phone']]);
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/newInventryRequest', $this->data);
    }

    public function orders(){
        $this->data['tabs']['active'] = 'Orders';
        $this->view('SalesAgent/orders', $this->data);
    }


    public function orderHistory(){
        $this->data['tabs']['active'] = 'Orders';
        $this->view('SalesAgent/orderHistory', $this->data);
    }

    // public function addOrderItemToSession(){
    //     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['barcode']) && isset($_POST['qty'])){
    //         if(!isset($_SESSION['order']))
    //         {
    //             $_SESSION['order'] = [];
    //         }

    //         $_SESSION['order'][] = [
    //             'barcode' => $_POST['barcode'],
    //             'qty' => $_POST['qty']
    //         ];
    //     }
    // }

    public function placeOrder(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $input = file_get_contents('php://input');

            // Decode the JSON data into a PHP array
            $billItems = json_decode($input, true);

            $distributor = new SalesAgentM;
            $man_phone = $distributor->first(['sa_phone'=> $_SESSION['sa_phone']])['su_phone'];
            $orders = new distributorOrders;
            $orderItems = new distributorOrdersItems;
            $con = $orders->startTransaction();
            $orders->insert(['dis_phone' => $_SESSION['sa_phone'], 'man_phone' => $man_phone], $con);
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
        $this->data['pendingOrders'] = $orders->getOrderDetails($_SESSION['sa_phone']);

        foreach ($this->data['pendingOrders'] as &$order) {
            $order['total'] = $orderItems->getOrderTotal($order['order_id']);
        }

        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/requestDetails', $this->data);
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
        $distributor = new SalesAgentM;
        $orderItems = new distributorOrdersItems;
        $order = new distributorOrders;
        $distDetail = $distributor->first(['sa_phone'=> $_SESSION['sa_phone']]);
        $this->data['OrderData']['orderProducts'] = $orderItems->where(['order_id' => $request_id]);
        $this->data['OrderData']['total'] = $orderItems->getOrderTotal($request_id);
        $this->data['OrderData']['order'] = $order->first(['order_id' => $request_id]);
        $this->data['products'] = $product->where(['man_phone'=> $distDetail['su_phone']]);
        // header('Content-Type: application/json');
        // echo json_encode($this->data);
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/editInventryRequest', $this->data);
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
        $this->view('SalesAgent/announcements', $this->data);
    }

    public function getAnnouncement($id){
        $announcement = new Announcements;
        $announcement = $announcement->first(['id' => $id]);
        echo json_encode($announcement);
    }





    
    public function new($viewName) {
        $this->view('SalesAgent/'.$viewName, $this->data);
    }
}