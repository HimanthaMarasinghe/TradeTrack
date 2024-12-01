<?php

class Supplier extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Orders', 'Agents'], 'userType' => 'Supplier'],
        'styleSheet' => ['styleSheet'=>'supplier']
    ];

    public function __construct() {
        if(!isset($_SESSION['su_phone'])){
            redirect('login');
            exit;
        }
    }

    public function index()
    {

        //$_SESSION['su_phone'] = '0112223333'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        $this->view('supplier/home', $this->data);
    }

    public function products()
    {
        $manStock = new manufacturerStock;
        $this->data['staticStocks'] = $manStock->where(['man_phone' => $_SESSION['su_phone']]);

        $pendingProducts = new pendingProductRequests;
        $this->data['pendingProducts'] = $pendingProducts->where(['man_phone' => $_SESSION['su_phone']]);
        $this->data['tabs']['active'] = 'Products';
        $this->view('supplier/products', $this->data);    
    }

    public function product($barcode){
        $product = new manufacturerStock;
        $this->data['product'] = $product->first(['products.barcode' => $barcode]);
        $this->data['tabs']['active'] = 'Products';
        $this->view('supplier/product', $this->data);
    }

    public function pendingProductRequestDetails(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['barcodeIn'])){
            $req = new pendingProductRequests;
            echo json_encode($req->first(['barcode' => $_POST['barcodeIn']]));
        }
    }

    public function deleteProductRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['barcode'])){
            $req = new pendingProductRequests;
            $req->delete(['barcode' => $_POST['barcode']]);
            echo json_encode(['status' => 'success']);
        }
    }

    public function updateProductRequest($barcode){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $req = new pendingProductRequests;
            $req->update(['barcode' => $barcode], $_POST);
        }
        redirect('Supplier/products');
    }

    public function orders()
    {

        $this->data['newOrders'] = [
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
        ];

        $this->data['processingOrders'] = [
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
            ['phone' => 'PhoneNumber', 'sa_first_name' => 'Vimal', 'sa_last_name' => 'Jayawardana', 'total' => 100, 'time' => '1h'],
        ];

        $this->data['tabs']['active'] = 'Orders';
        $this->view('supplier/orders', $this->data);    
    }

    public function agents()
    {
        $agent = new SalesAgentM;
        $this->data['agents'] = $agent->where(['su_phone' => $_SESSION['su_phone']]);

        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/agents', $this->data);    
    }

    

    
    public function AddNewAgents() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['su_phone']) && !empty($_POST['phone']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['sa_busines_name']) && !empty($_POST['address']))
        {
            $agent = new SalesAgentM;
            $user = new User;
            $oldAgent = $agent->first(['sa_phone' => $_POST['phone'], 'su_phone' => $_SESSION['su_phone']]);
            $existingUser = $user->first(['phone' => $_POST['phone']]);
            if(!empty($oldAgent))
            {
                echo "Agent with this phone number already exist."; //Todo : change this to a proper error page.
                // header('Location: ' . LINKROOT . '/Supplier/Agents');
                return;
            }

            unset($_POST['sa_password']);   //Supplier is not alowed to set a password for Sales agent. A default password will be set and sales agent should change it after login.

            // $extension = (isset($_FILES['image']) && $_FILES['image']['error'] === 0) ? $this->saveImage($_FILES['image'], 'images/Profile/SA/', $_POST['sa_phone']) : false;

            $insertData = array_merge($_POST, ['su_phone' => $_SESSION['su_phone'], 'sa_phone' => $_POST['phone']]);
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
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }
        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/addNewAgents', $this->data);
    }

    public function Agent($sap = null) {
        if($sap == null)
        {
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }

        $agent = new SalesAgentM;
        $this->data['agent'] = $agent->first(['sa_phone' => $sap, 'su_phone' => $_SESSION['su_phone']]);
        if(!$this->data['agent']){
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }

        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/agent', $this->data);
    }

    public function UpdateAgent($sap = null) { //todo : after user table, this method did not get updated
        if($sap == null)
        {
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }

        $agent = new SalesAgentM;
        $agentData = $agent->first(['sa_phone' => $sap, 'su_phone' => $_SESSION['su_phone']]);
        if(empty($agentData))
        {
            // echo $sap." : This agent phone number ether does not exist in the db or not belong to the logged in supplier."; //Todo : change this to a proper error page.
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['su_phone']) && !empty($_POST['sa_phone']) && !empty($_POST['sa_first_name']) && !empty($_POST['sa_last_name']) && !empty($_POST['sa_busines_name']) && !empty($_POST['sa_address']))
        {
            unset($_POST['sa_password']);   //Supplier is not alowed to set a password for Sales agent. A default password will be set and sales agent should change it after login.

            $updData = $_POST;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0)
            {
                //Updating Image
                $this->deleteImage('images/Profile/SA/'.$sap.'.'.$agentData['sa_pic_format']);
                $extension = $this->saveImage($_FILES['image'], 'images/Profile/SA/', $_POST['sa_phone']);
                if ($extension !== false) {
                    $updData['sa_pic_format'] = $extension;
                }
            } else if($_POST['remove_image']){
                //Removing image
                $this->deleteImage('images/Profile/SA/'.$sap.'.'.$agentData['sa_pic_format']);
            }
            else if($updData['sa_phone'] !== $sap){
                //Renaming image if the user change the phone number.
                rename('images/Profile/SA/'.$sap.'.'.$agentData['sa_pic_format'], 'images/Profile/SA/'.$updData['sa_phone'].'.'.$agentData['sa_pic_format']);
            }

            unset($updData['remove_image']);
            
            foreach ($updData as $key => $value) {
                if ($agentData[$key] == $value) {
                    unset($updData[$key]);
                }
            }

            if(!empty($updData)){
                $agent->update(['sa_phone' => $sap, 'su_phone' => $_SESSION['su_phone']], $updData);
            }
            header('Location: ' . LINKROOT . '/Supplier/Agents');                                 
            return;
        }

        $this->data['agent'] = $agentData;
        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/updateAgent', $this->data);
    }

    public function deleteAgent() { //todo : deleted agent should be in a anothe table, and baned agents may still log in to his distributor account but not be able to do anything in it.
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['sa_phone'])){
            $agnt = new SalesAgentM;
            $agnt->delete(['sa_phone' => $_POST['sa_phone'], 'su_phone' => $_SESSION['su_phone']]);
        }
        header('Location: ' . LINKROOT . '/admin/addNewProducts');       
    }

    public function newProductRequest(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $req = new pendingProductRequests;
            $insertArray = array_merge($_POST, ['man_phone' => $_SESSION['su_phone']]);
            $req->insert( $insertArray);
        }
        redirect('Supplier/products');
    }














    
    public function new($viewName) {
        $this->view('Supplier/'.$viewName, $this->data);
    }

}