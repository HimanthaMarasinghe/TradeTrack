<?php

class ShopOwner extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Loyalty Customers', 'Stocks', 'Accounts'], 'userType' => 'ShopOwner']
    ];
    public function index () 
    {
        // $userAgent = $_SERVER['HTTP_USER_AGENT'];
        // show($userAgent);
        // show(strpos($userAgent, 'Mobile'));
        // show(strpos($userAgent, 'Tablet'));
        $shopOwner = new ShopOwner();
        // show($_SESSION);
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

        $this->data['lowStocks'] = [
            ['prName' => 'Samen', 'quantity' => 5, 'prID' => 'samen'],
            ['prName' => 'Rice', 'quantity' => 10, 'prID' => 'samen'],
            ['prName' => 'Sugar', 'quantity' => 15, 'prID' => 'samen'],
            ['prName' => 'Salt', 'quantity' => 20, 'prID' => 'samen'],
            ['prName' => 'Milk', 'quantity' => 25, 'prID' => 'samen'],
            ['prName' => 'Eggs', 'quantity' => 30, 'prID' => 'samen'],
            ['prName' => 'Bread', 'quantity' => 35, 'prID' => 'samen'],
            ['prName' => 'Butter', 'quantity' => 40, 'prID' => 'samen'],
            ['prName' => 'Cheese', 'quantity' => 45, 'prID' => 'samen'],
            ['prName' => 'Yogurt', 'quantity' => 50, 'prID' => 'samen']
        ];
        

        $this->view('ShopOwner/home', $this->data);
    }

    public function newPurchase() {

        
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/newPurchase', $this->data);
    }

    public function billSettle() {

        
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/billSettle', $this->data);
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

    public function purchaseDone() {
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/purchaseDone', $this->data);
    }

    public function loyaltyCustomers() {
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

        $this->data['newLoyalCusReq'] = [
            ['phone' => 'PhoneNumber', 'name' => 'John Doe'],
            ['phone' => 'PhoneNumber', 'name' => 'Jane Smith'],
            ['phone' => 'PhoneNumber', 'name' => 'Alice Johnson'],
            ['phone' => 'PhoneNumber', 'name' => 'Bob Brown'],
            ['phone' => 'PhoneNumber', 'name' => 'Carol Davis'],
            ['phone' => 'PhoneNumber', 'name' => 'David Wilson'],
            ['phone' => 'PhoneNumber', 'name' => 'Eve Miller'],
            ['phone' => 'PhoneNumber', 'name' => 'Frank Moore'],
            ['phone' => 'PhoneNumber', 'name' => 'Grace Taylor'],
            ['phone' => 'PhoneNumber', 'name' => 'Henry Anderson']
        ];

        $this->data['loyalCus']=[
            ['phone' => 'PhoneNumber', 'name' => 'John Doe', 'amount' => 15000],
            ['phone' => 'PhoneNumber', 'name' => 'Jane Smith', 'amount' => 24000],
            ['phone' => 'PhoneNumber', 'name' => 'Alice Johnson', 'amount' => 32000],
            ['phone' => 'PhoneNumber', 'name' => 'Bob Brown', 'amount' => 27000],
            ['phone' => 'PhoneNumber', 'name' => 'Carol Davis', 'amount' => 16000],
            ['phone' => 'PhoneNumber', 'name' => 'David Wilson', 'amount' => 20000],
            ['phone' => 'PhoneNumber', 'name' => 'Eve Miller', 'amount' => 18000],
            ['phone' => 'PhoneNumber', 'name' => 'Frank Moore', 'amount' => 21000],
            ['phone' => 'PhoneNumber', 'name' => 'Grace Taylor', 'amount' => 30000],
            ['phone' => 'PhoneNumber', 'name' => 'Henry Anderson', 'amount' => 22000]
        ];

        $this->data['tabs']['active'] = 'Loyalty Customers';
        $this->view('shopOwner/loyaltyCustomers', $this->data);
    }

    public function addLoyalCus() {
        $this->data['newLoyalCusReq'] = [
            'name' => 'John Doe',
            'phone' => '0112224690',
            'address' => 'No 123, Main Street, Colombo 07'
        ];
        $this->data['tabs']['active'] = 'Loyalty Customers';
        $this->view('shopOwner/addLoyalCus', $this->data);
    }

    public function loyaltyCustomer() {
        $this->data['loyalCus'] = [
            'name' => 'John Doe',
            'phone' => '0112224690',
            'address' => 'No 123, Main Street, Colombo 07'
        ];
        $this->data['tabs']['active'] = 'Loyalty Customers';
        $this->view('shopOwner/loyaltyCustomer', $this->data);
    }
    
    public function stocks() {
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/stocks', $this->data);
    }
    
    public function accounts() {
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('shopOwner/accounts', $this->data);
    }
}