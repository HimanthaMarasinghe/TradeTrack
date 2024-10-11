<?php

class ShopOwner extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Loyalty Customers', 'Stocks', 'Accounts'], 'userType' => 'ShopOwner']
    ];
    public function index () 
    {

        $_SESSION['so_phone'] = '0112223333'; // to be changed to the logged in user's phone number (tbc)

        $shopOwner = new ShopOwner();
        $p = new Products;
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
            ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Yogurt', 'quantity' => 50, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg']
        ];
        

        $this->view('ShopOwner/home', $this->data);
    }

    public function newPurchase() {
        $_SESSION['bill'] = [];
        $_SESSION['total'] = 0;
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/newPurchase', $this->data);
    }

    public function billSettle() {
        $this->data['total'] = $_SESSION['total'];
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
        $bill = new Bills;
        $bill-> addBill();
        $this->data['total'] = $_SESSION['total'];
        $this->data['tabs']['active'] = 'Home';
        $this->view('shopOwner/purchaseDone', $this->data);
    }

    public function loyaltyCustomers() {
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

        $this->data['newLoyalCusReq'] = [
            ['phone' => 'PhoneNumber', 'name' => 'John Doe'],
            ['phone' => 'PhoneNumber', 'name' => 'Jane Smith'],
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

    public function orderReady() {
        $this->data['cusName'] = 'John Doe';
        $this->data['tabs']['active'] = 'Loyalty Customers';
        $this->view('shopOwner/orderReady', $this->data);
    }
    
    public function stocks() {
        $this->data['lowStocks'] = [
            ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Yogurt', 'quantity' => 50, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg']
        ];
        $product = new Products;
        $this->data['stocks'] = $product->readAll();
        $this->data['staticStocks'] = [
            ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Salt', 'quantity' => 20, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Milk', 'quantity' => 25, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Eggs', 'quantity' => 30, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Bread', 'quantity' => 35, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Butter', 'quantity' => 40, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Cheese', 'quantity' => 45, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg'],
            ['product_name' => 'Yogurt', 'quantity' => 50, 'barcode' => 'samen', 'price' => 100, 'pic_format' => 'jpeg']
        ];
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('shopOwner/stocks', $this->data);
    }
    
    public function accounts() {
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('shopOwner/accounts', $this->data);
    }

    public function recordTransaction($URL) {
        echo $URL;
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('shopOwner/recordTransaction', $this->data);
    }
}