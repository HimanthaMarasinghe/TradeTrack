<?php

class Customer extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Shops', 'Loyalty Shops'], 'userType' => 'Customer'],
        'styleSheet' => ['styleSheet'=>'customer']
    ];

    public function __construct() {
        if(!isset($_SESSION['customer'])){
            redirect('login');
            exit;
        }
    }

    public function index(){

        //$_SESSION['customer']['phone'] = '0123456789'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/home',$this->data);
    }

    public function placePreOrder(){

        //$_SESSION['customer']['phone'] = '0123456789'; //ToDo : to be changed to the logged in user's phone number (tbc)

        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/placePreOrder',$this->data);
    }

    public function products(){
        $this->data['tabs']['active'] = 'Products';
        $prdct = new Products;
        $this->data['products'] = $prdct->readAll();
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
        $this->data['shop'] = $shops->first(['so_phone' => $sop]);
        $this->data['loyalty'] = $loyShops->first(['cus_phone' => $_SESSION['customer']['phone'], 'so_phone' => $sop]);        
        $this->data['tabs']['active'] = $this->data['loyalty'] ? 'Loyalty Shops' : 'Shops';
        $this->view('Customer/shop',$this->data);
    }

    public function loyaltyShops(){
        $loyShops = new LoyaltyCustomers;
        $this->data['tabs']['active'] = 'Loyalty Shops';
        $this->data['shops'] = $loyShops->allLoyaltyShops($_SESSION['customer']['phone']);
        $this->view('Customer/loyaltyShops',$this->data);
    }

    public function preOrder($so_phone){
        $ss = new ShopStock;
        $this->data['stock'] = $ss->readStock($so_phone);
        //Todo: finish after creating a proper preOrder page.
    }
    //create new methods after this line.

    public function announcements(){
        $announcement = new Announcements;
        
        $this->data['announcements'] = $announcement->where(['role' => 0]);
        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/announcements', $this->data);
    }

    
    // API endpoints

    public function getAnnouncement($id){
        $announcement = new Announcements;
        $announcement = $announcement->first(['id' => $id]);
        echo json_encode($announcement);
    }

    public function getShops($offset = 0){
        $shopsM = new Shops;
        $shops = $shopsM->readAll(10, $offset);
        echo json_encode($shops);
    }






    public function new($viewName) {
        $this->view('Customer/'.$viewName, $this->data);
    }

}