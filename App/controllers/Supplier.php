<?php

class Supplier extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Orders', 'Agents'], 'userType' => 'Supplier']
    ];

    public function index()
    {

        $_SESSION['su_phone'] = '0112223333'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        $this->view('supplier/home', $this->data);
    }

    public function products()
    {
        $this->data['lowStocks'] = [
            ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Yogurt', 'quantity' => 50, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg']
        ];
        $this->data['staticStocks'] = [
            ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Salt', 'quantity' => 20, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
        ];
        $this->data['tabs']['active'] = 'Products';
        $this->view('supplier/products', $this->data);    
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
        $agent = new SalesAgent;
        $this->data['agents'] = $agent->where(['su_phone' => $_SESSION['su_phone']]);

        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/agents', $this->data);    
    }

    
    public function AddNewAgents() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['su_phone']) && !empty($_POST['sa_phone']) && !empty($_POST['sa_first_name']) && !empty($_POST['sa_last_name']) && !empty($_POST['sa_busines_name']) && !empty($_POST['sa_address']))
        {
            // echo "POSTED";
            $agent = new SalesAgent;
            $oldAgent = $agent->first(['sa_phone' => $_POST['sa_phone'], 'su_phone' => $_SESSION['su_phone']]);
            if(!empty($oldAgent))
            {
                echo "Agent with this phone number already exist."; //Todo : change this to a proper error page.
                // header('Location: ' . LINKROOT . '/Supplier/Agents');
                return;
            }

            unset($_POST['sa_password']);   //Supplier is not alowed to set a password for Sales agent. A default password will be set and sales agent should change it after login.

            $extension = (isset($_FILES['image']) && $_FILES['image']['error'] === 0) ? $this->saveImage($_FILES['image'], 'images/Profile/SA/', $_POST['sa_phone']) : false;

            $insertData = array_merge($_POST, ['su_phone' => $_SESSION['su_phone']]);
            if ($extension !== false) {
                $insertData['sa_pic_format'] = $extension;
            }
            
            $agent->insert($insertData);
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

        $agent = new SalesAgent;
        $this->data['agent'] = $agent->first(['sa_phone' => $sap, 'su_phone' => $_SESSION['su_phone']]);
        if(!$this->data['agent']){
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }

        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/agent', $this->data);
    }

    public function UpdateAgent($sap = null) {
        if($sap == null)
        {
            header('Location: ' . LINKROOT . '/Supplier/Agents');
            return;
        }

        $agent = new SalesAgent;
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

    public function deleteAgent() {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['sa_phone'])){
            $agnt = new SalesAgent;
            $agnt->delete(['sa_phone' => $_POST['sa_phone'], 'su_phone' => $_SESSION['su_phone']]);
        }
        header('Location: ' . LINKROOT . '/admin/addNewProducts');       
    }

    //create new methods after this line.

}