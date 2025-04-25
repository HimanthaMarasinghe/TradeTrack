<?php

class Manufacturer extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Orders', 'Agents'], 'userType' => 'Manufacturer'],
        'styleSheet' => ['styleSheet'=>'manufacturer']
    ];

    public function __construct() {
        if(!isset($_SESSION['manufacturer'])){
            redirect('login');
            exit;
        }
    }

    public function index()
    {
        $order = new distributorOrders;
        $this->data['order'] = $order->readOrders($_SESSION['manufacturer']['phone']);
        // writeToFile($this->data['order']);

        // $processingOrders = $order->where(['status' => 'processing', 'o.man_phone' => $_SESSION['manufacturer']['phone']]);
        // if($processingOrders)
        //     array_push($this->data['order'], ...$processingOrders);
        //  $readyOrders = $order->where(['status' => 'Ready', 'o.man_phone' => $_SESSION['manufacturer']['phone']]);
        //     if($readyOrders)
        //         array_push($this->data['order'], ...$readyOrders);      

        $manufacturers = new Manufacturers;
         $this->data['manufacturers'] = $manufacturers->first(['man_phone' => $_SESSION['manufacturer']['phone']]);
        //$_SESSION['manufacturer']['phone'] = '0112223333'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        $this->view('manufacturer/home', $this->data);
    }

    public function products()
    {
        $this->data['tabs']['active'] = 'Products';
        $this->view('manufacturer/products', $this->data);    
    }

    public function pendingProducts(){
        $pendingProducts = new pendingProductRequests;
        $this->data['pendingProducts'] = $pendingProducts->where(['man_phone' => $_SESSION['manufacturer']['phone']]);
        $this->data['tabs']['active'] = 'Products';
        $this->view('manufacturer/pendingProducts', $this->data);    
    }

    public function product($barcode){
        $product = new manufacturerStock;
        $this->data['product'] = $product->first(['products.barcode' => $barcode]);
        $this->data['tabs']['active'] = 'Products';
        $this->view('manufacturer/product', $this->data);
    }

    public function pendingProductRequestDetails(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['barcodeIn'])){
            $req = new pendingProductRequests;
            echo json_encode($req->first(['barcode' => $_POST['barcodeIn']]));
        }
    }

    public function deleteProductRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id'])){
            $req = new pendingProductRequests;
            $req->delete(['id' => $_POST['id']]);
            echo json_encode(['status' => 'success']);
        }
    }

    public function updateProductRequest($id){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $req = new pendingProductRequests;
            $req->update(['id' => $id], $_POST);
        }
        redirect('Manufacturer/pendingProducts');
    }

    public function orders()//Todo: Should be recoded for beter optimisation with less queries.
    {
        $now = new DateTime();
        $order = new distributorOrders;
        $orderItems = new distributorOrdersItems;
        $newOrders = $order->where(['d.man_phone' => $_SESSION['manufacturer']['phone'], 'status' => 'Pending']);
        foreach ($newOrders as &$newOrder) {
            $newOrder['total'] = $orderItems->getOrderTotal($newOrder['order_id']);
            $dataTimeString = $newOrder['date'].' '.$newOrder['time'];
            $orderDateTime = new DateTime($dataTimeString);
            $newOrder['timeAgo'] = $now->diff($orderDateTime)->format('%hh %im');
        }
        $this->data['newOrders'] = $newOrders;

        $processingOrders = $order->where(['d.man_phone' => $_SESSION['manufacturer']['phone'], 'status' => 'Processing']);
        foreach ($processingOrders as &$processingOrder) {
            $processingOrder['total'] = $orderItems->getOrderTotal($processingOrder['order_id']);
            $dataTimeString = $processingOrder['date'].' '.$processingOrder['time'];
            $orderDateTime = new DateTime($dataTimeString);
            $processingOrder['timeAgo'] = $now->diff($orderDateTime)->format('%hh %im');
        }
        $this->data['processingOrders'] = $processingOrders;

        $this->data['tabs']['active'] = 'Orders';
        $this->view('manufacturer/orders', $this->data);
        // header('Content-Type: application/json');
        // echo json_encode($this->data);
    }

    public function orderDetails($order_id)
    {
        $order = new distributorOrders;
        $orderItems = new distributorOrdersItems;
        $orderDetails = $order->first(['order_id' => $order_id]);
        $orderDetails['total'] = $orderItems->getOrderTotal($order_id);
        $orderDetails['orderItems'] = $orderItems->where(['order_id' => $order_id]);
        foreach ($orderDetails['orderItems'] as &$orderItem) {
            $orderItem['total'] = $orderItem['bulk_price'] * $orderItem['quantity'];
        }
        header('Content-Type: application/json');
        echo json_encode($orderDetails);
    }

    public function updateStatus($order_id, $status)
    {
        $order = new distributorOrders;
        $order->update(['order_id' => $order_id], ['status' => $status]);
        echo json_encode(['success' => 'success']);
    }

    public function agents()
    {
        // $agent = new DistributorM;
        // $this->data['agents'] = $agent->where(['man_phone' => $_SESSION['manufacturer']['phone']]);

        $this->data['tabs']['active'] = 'Agents';
        $this->view('manufacturer/agents', $this->data);    
    }

    

    
    public function AddNewAgents() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['manufacturer']['phone']) && !empty($_POST['phone']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['sa_busines_name']) && !empty($_POST['address']))
        {
            $agent = new DistributorM;
            $user = new User;
            $oldAgent = $agent->first(['dis_phone' => $_POST['phone'], 'man_phone' => $_SESSION['manufacturer']['phone']]);
            $existingUser = $user->first(['phone' => $_POST['phone']]);
            if(!empty($oldAgent))
            {
                echo "Agent with this phone number already exist."; //Todo : change this to a proper error page.
                // header('Location: ' . LINKROOT . '/Manufacturer/Agents');
                return;
            }

            unset($_POST['sa_password']);   //Manufacturer is not alowed to set a password for Sales agent. A default password will be set and sales agent should change it after login.

            // $extension = (isset($_FILES['image']) && $_FILES['image']['error'] === 0) ? $this->saveImage($_FILES['image'], 'images/Profile/SA/', $_POST['dis_phone']) : false;

            $insertData = array_merge($_POST, ['man_phone' => $_SESSION['manufacturer']['phone'], 'dis_phone' => $_POST['phone']]);
            // if ($extension !== false) {
            //     $insertData['sa_pic_format'] = $extension;
            // }

            //todo:Below tarnsaction should be moved in to a service file.
            $con = $agent->startTransaction();
            if(!$existingUser){
                $insertData = array_merge($insertData, ['password' => password_hash('password', PASSWORD_DEFAULT), 'role' => '3']);
                $user->insert($insertData, $con);
            }else{
                $user->update(['phone' => $_POST['phone']], ['role' => '3'], $con);
            }
            $agent->insert($insertData, $con);
            $con->commit();
            header('Location: ' . LINKROOT . '/Manufacturer/Agents');
            return;
        }
        $this->data['tabs']['active'] = 'Agents';
        $this->view('manufacturer/addNewAgents', $this->data);
    }

    public function DistributorProfile($dis_phone){

        
            $dis = new DistributorM;
            $this->data['dis'] = $dis->first(['dis_phone' => $dis_phone]);
            // $this->data['wallet'] = (new WalletSoDis)->first(['so_phone' => $so_phone, 'dis_phone' => $_SESSION['distributor']['phone']]);
            

        $this->data['tabs']['active'] = 'Agents';
        $this->view('manufacturer/distributorProfile', $this->data);


    }

    public function Agent($sap = null) {
        if($sap == null)
        {
            header('Location: ' . LINKROOT . '/Manufacturer/Agents');
            return;
        }

        $agent = new DistributorM;
        $this->data['agent'] = $agent->first(['dis_phone' => $sap, 'man_phone' => $_SESSION['manufacturer']['phone']]);
        if(!$this->data['agent']){
            header('Location: ' . LINKROOT . '/Manufacturer/Agents');
            return;
        }

        $this->data['tabs']['active'] = 'Agents';
        $this->view('manufacturer/agent', $this->data);
    }

    public function UpdateAgent($sap = null) { //todo : after user table, this method did not get updated
        if($sap == null)
        {
            header('Location: ' . LINKROOT . '/Manufacturer/Agents');
            return;
        }

        $agent = new DistributorM;
        $agentData = $agent->first(['dis_phone' => $sap, 'man_phone' => $_SESSION['manufacturer']['phone']]);
        if(empty($agentData))
        {
            // echo $sap." : This agent phone number ether does not exist in the db or not belong to the logged in manufacturer."; //Todo : change this to a proper error page.
            header('Location: ' . LINKROOT . '/Manufacturer/Agents');
            return;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['manufacturer']['phone']) && !empty($_POST['dis_phone']) && !empty($_POST['sa_first_name']) && !empty($_POST['sa_last_name']) && !empty($_POST['sa_busines_name']) && !empty($_POST['sa_address']))
        {
            unset($_POST['sa_password']);   //Manufacturer is not alowed to set a password for Sales agent. A default password will be set and sales agent should change it after login.

            $updData = $_POST;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0)
            {
                //Updating Image
                $this->deleteImage('images/Profile/SA/'.$sap.'.'.$agentData['sa_pic_format']);
                $extension = $this->saveImage($_FILES['image'], 'images/Profile/SA/', $_POST['dis_phone']);
                if ($extension !== false) {
                    $updData['sa_pic_format'] = $extension;
                }
            } else if($_POST['remove_image']){
                //Removing image
                $this->deleteImage('images/Profile/SA/'.$sap.'.'.$agentData['sa_pic_format']);
            }
            else if($updData['dis_phone'] !== $sap){
                //Renaming image if the user change the phone number.
                rename('images/Profile/SA/'.$sap.'.'.$agentData['sa_pic_format'], 'images/Profile/SA/'.$updData['dis_phone'].'.'.$agentData['sa_pic_format']);
            }

            unset($updData['remove_image']);
            
            foreach ($updData as $key => $value) {
                if ($agentData[$key] == $value) {
                    unset($updData[$key]);
                }
            }

            if(!empty($updData)){
                $agent->update(['dis_phone' => $sap, 'man_phone' => $_SESSION['manufacturer']['phone']], $updData);
            }
            header('Location: ' . LINKROOT . '/Manufacturer/Agents');                                 
            return;
        }

        $this->data['agent'] = $agentData;
        $this->data['tabs']['active'] = 'Agents';
        $this->view('manufacturer/updateAgent', $this->data);
    }

    public function deleteAgent() { //todo : deleted agent should be in a anothe table, and baned agents may still log in to his distributoraccount but not be able to do anything in it.
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['dis_phone'])){
            $agnt = new DistributorM;
            $agnt->delete(['dis_phone' => $_POST['dis_phone'], 'man_phone' => $_SESSION['manufacturer']['phone']]);
        }
        header('Location: ' . LINKROOT . '/admin/addNewProducts');       
    }

    public function newProductRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $req = new pendingProductRequests;
            $con = $req->startTransaction();
            $insertArray = array_merge($_POST, ['man_phone' => $_SESSION['manufacturer']['phone']]);
            $req->insert($insertArray, $con);
            $reqId = $con->lastInsertId();
            $pic_format = (new ImageUploader)->upload('image', $reqId, 'NewProducts');
            $proof_format = (new ImageUploader)->upload('barcodeProof', $reqId, 'BarcodeProofs');
            $req->update(['id' => $reqId], ['pic_format' => $pic_format, 'proof_format' => $proof_format], $con);
            $con->commit();
            redirect('Manufacturer/pendingProducts');
        }
    }

    public function announcements(){
        $announcement = new Announcements;
        
        $this->data['announcements'] = $announcement->where(['role' => 2]);
        $this->data['tabs']['active'] = 'Home';
        $this->view('Manufacturer/announcements', $this->data);
    }

    // api

    public function getAnnouncement($id){
        $announcement = new Announcements;
        $announcement = $announcement->first(['id' => $id]);
        echo json_encode($announcement);
    }

    public function getProducts(){ 
        $search = $_GET['search'] ?? null;
        $prdct = new Products;
        
        $products = $prdct->searchProductsMan($search, $_SESSION['manufacturer']['phone']);

        if(!$products)
            $products = [];
        echo json_encode($products);
    }
    
    public function getDistributor(){ 
        $search = $_GET['search'] ?? null;
        $Dis = new DistributorM;
        
        $distributor = $Dis->searchDistributors($search, null, $_SESSION['manufacturer']['phone']);

        if(!$distributor)
            $distributor = [];
        echo json_encode($distributor);
    }

    public function getOrders(){ 
        $search = $_GET['search'] ?? null;
        $filter = $_GET['filter'] ?? null;
        $date = $_GET['date'] ?? null;
        $Ord = new distributorOrders;
        
        $distributorOrders = $Ord->searchOrdersMan($search, $_SESSION['manufacturer']['phone'], $date, $filter);

        if(!$distributorOrders)
            $distributorOrders = [];
        echo json_encode($distributorOrders);
    }
    
    public function getPenProducts(){ 
        $search = $_GET['search'] ?? null;
        $prdct = new pendingProductRequests;
        
        $pendingProductRequests = $prdct->search($search, null,);

        if(!$pendingProductRequests)
            $pendingProductRequests = [];
        echo json_encode($pendingProductRequests);
    }


    public function getStocks($dis_phone){ 
        $search = $_GET['search'] ?? null;
        
        $sto = new DistributorStocks;
        
        $disstock = $sto->searchDisStocks($search, $dis_phone);

        if(!$disstock)
            $disstock = [];
        echo json_encode($disstock);
    }

    













    
    public function new($viewName) {
        $this->view('Manufacturer/'.$viewName, $this->data);
    }

}