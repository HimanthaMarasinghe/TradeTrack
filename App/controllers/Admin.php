<?php

class Admin extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Customers', 'Shops', 'Distributors', 'Manufacturers', 'Products'], 'userType' => 'Admin'],
        'styleSheet' => ['styleSheet'=>'admin']
    ];

    public function __construct() {
        if(!isset($_SESSION['admin'])){
            redirect('login');
            exit;
        }
    }
    //create new methods after this line.
    public function index(){
        $this->data['tabs']['active'] = 'Home';
        // Fetch dashboard statistics from database
        $userModel = new User();
        $this->data['totalCustomers'] = count($userModel->where(['role' => '0']));

        $userLoyaltyModel = new LoyaltyCustomers();
        $this->data['totalLoyalCustomers'] = count($userLoyaltyModel->readAll());

        $shopModel = new Shops();
        $this->data['shopOwners'] = count($shopModel->readAll());
    
        $distributorModel = new DistributorM();
        $this->data['distributors'] = count($distributorModel->readAll());
        
        $manufacturerModel = new Manufacturers();
        $this->data['manufacturers'] = count($manufacturerModel->readAll());
        
        $productModel = new Products();
        $this->data['products'] = count($productModel->readAll());
        
        
        $this->view('Admin/home',$this->data);
    }

    public function removeUserDetails() {
        $this->data['loyalCus'] = [
            'name' => 'John Doe',
            'phone' => '0112224690',
            'address' => 'No 123, Main Street, Colombo 07'
        ];
        $this->view('Admin/removeUserDetails', $this->data);
    }

 /*-----------------------Adding new product to database-------------------------*/   
   

    public function addNewProducts() {

        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['barcode']) && !empty($_POST['product_name']) && !empty($_POST['unit_price'])) {
            $product = new Products;
            $insertData = $_POST;
            $oldProduct = $product->first(['barcode' => $_POST['barcode']]);
            if(!empty($oldProduct)) {
                echo "Product already exists";
                return;
            }
            $extension = (new ImageUploader)->upload('image', $_POST['barcode'], 'Products');
            if ($extension !== false) {
                $insertData['pic_format'] = $extension;
            }
            $product->insert($insertData);
        }

        redirect('Admin/Products');
    }

    public function updateProducts($oldBarcode = null) {
        
        if($oldBarcode == null) {
            header('Location: ' . LINKROOT . '/admin/addNewProducts');
            return;
        }

        $prdct = new Products;
        $oldProduct = $prdct->first(['barcode' => $oldBarcode]);

        if(empty($oldProduct)) {
            echo "Product not found"; // Todo: change this to a proper error page.
            // header('Location: ' . LINKROOT . '/admin/addNewProducts');
            return;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['barcode']) && !empty($_POST['product_name']) && !empty($_POST['unit_price']))
        {
            if(isset($_FILES['productImage']) && $_FILES['productImage']['error'] === 0)
            {
                $this->deleteImage('images/Products/'.$oldBarcode.'.'.$oldProduct['pic_format']);
                $extension = $this->saveImage($_FILES['productImage'], 'images/Products/', $_POST['barcode']);
                if($extension !== false)
                {
                    $_POST['pic_format'] = $extension;
                }
            } else if($_POST['remove_image']) {
                $this->deleteImage('images/Products/'.$oldBarcode.'.'.$oldProduct['pic_format']);
            } else if($_POST['barcode'] != $oldBarcode) {
                rename('images/Products/'.$oldBarcode.'.'.$oldProduct['pic_format'], 'images/Products/'.$_POST['barcode'].'.'.$oldProduct['pic_format']);
            }
            unset($_POST['remove_image']);

            foreach($_POST as $key => $value)
            {
                if ($oldProduct[$key] == $value){
                    unset($_POST[$key]);
                }
            }

            if(!empty($_POST))
            {
                $prdct->update(['barcode' => $oldBarcode], $_POST);
            }
            header('Location: ' . LINKROOT . '/admin/addNewProducts'); //Todo: Change this to a product page.
            return;
        }

        $this->data['product'] = $oldProduct;
        $this->view('Admin/updateProducts', $this->data);
    }

    public function product($barcodeIn = null){
        if ($barcodeIn == null){
            redirect('Admin/products');
        }
        $prd = new Products;

        $this->data['product'] = $prd->first(['barcode' => $barcodeIn]);
        if($this->data['product']['man_phone'])
            $this->data['manufactuerer'] = (new Manufacturers)->first(['man_phone' => $this->data['product']['man_phone']]);
        writeToFile($this->data['manufactuerer']);
        if(!$this->data['product']){
            redirect('Admin/products');
        }
        $this->view('Admin/product', $this->data);
    }

    public function deleteProduct(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['barcode'])){
            $prdct = new Products;
            $prdct->delete(['barcode' => $_POST['barcode']]);
        }
        header('Location: ' . LINKROOT . '/admin/addNewProducts'); //Todo: Change this to a product page.
    }

    public function products(){
        $this->data['tabs']['active'] = 'Products';
        $this->view('Admin/products', $this->data);
    }


    public function Customers(){
        $this->data['tabs']['active'] = 'Customers';
        $this->view('Admin/customers', $this->data);
    }

    public function getCustomers($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 

        $search = $_GET['search'];
        $userM = new User;
        $customers = $userM->searchCustomers($search, $offset);
        echo json_encode($customers);
    }
    public function customer($phoneNumber = NULL){
        $this->data['tabs']['active'] = 'Customers';
        if ($phoneNumber == null){
            redirect('Admin/customers');
        }
        $cus = new User;

        $this->data['customer'] = $cus->first(['phone' => $phoneNumber]);
        if(!$this->data['customer']){
            redirect('Admin/Customers');
        }

        $this->data['bills'] = (new Bills)->where(['b.cus_phone' => $phoneNumber]);
        $this->view('Admin/customer', $this->data);
    }

    public function Distributors(){
        $this->data['tabs']['active'] = 'Distributors';
        $this->view('Admin/distributors', $this->data);
    }

    public function getDistributors($offset){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 

        $search = $_GET['search'];
        $distributorsM = new DistributorM;
        $distributors = $distributorsM->searchDistributors($search, $offset);
        echo json_encode($distributors);
    }
    public function distributor($distributor = NULL){
        $this->data['tabs']['active'] = 'Distributors';
        if ($distributor == null){
            redirect('Admin/Distributors');
        }
        $dis = new DistributorM;
        $this->data['distributor'] = $dis->first(['dis_phone' => $distributor]);
        if(!$this->data['distributor']){
            redirect('Admin/Distributors');
        }

        $this->data['bills'] = (new Bills)->getBillsByDistributor($distributor);

        $this->view('Admin/distributor', $this->data);
    }

        

    public function Shops(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('Admin/shops', $this->data);
    }

    public function getShops($offset = 0){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 

        $search = $_GET['search'];
        $shopsM = new Shops;
        $shops = $shopsM->allShops($search, null, $offset);
        echo json_encode($shops);
    }

    public function shop($shopOwnerPhoneNumber = NULL){
        $this->data['tabs']['active'] = 'Shops';
        if ($shopOwnerPhoneNumber == null){
            redirect('Admin/shops');
        }
        $shp = new Shops;
        $this->data['shop'] = $shp->first(['so_phone' => $shopOwnerPhoneNumber]);
        if(!$this->data['shop']){
            redirect('Admin/shops');
        }
        $this->data['bills'] = (new Bills)->where(['b.so_phone' => $shopOwnerPhoneNumber]);
        
        $this->view('Admin/shop', $this->data);
    }

    public function Manufacturers(){
        $this->data['tabs']['active'] = 'Manufacturers';
        $this->view('Admin/manufacturers', $this->data);
    }

    public function getManufacturers($offset){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 

        $search = $_GET['search'];
        $manufacturerM = new Manufacturers;
        $manufacturers = $manufacturerM->search($search, $offset);
        echo json_encode($manufacturers);
    }

    public function manufacturer($manufacturerPhoneNumber = NULL){
        $this->data['tabs']['active'] = 'Manufacturers';
        if ($manufacturerPhoneNumber == null){
            redirect('Admin/Manufacturers');
        }
        $manu = new Manufacturers;
        $this->data['manufacturer'] = $manu->first(['man_phone' => $manufacturerPhoneNumber]);
        if(!$this->data['manufacturer']){
            redirect('Admin/Manufacturers');
        }
        $this->view('Admin/manufacturer', $this->data);
    }

    public function announcements(){
        $announcement = new Announcements;
        
        $this->data['announcements'] = $announcement->readAll();
        $this->data['tabs']['active'] = 'Home';
        $this->view('Admin/announcements', $this->data);
    }

    public function newAnnouncement(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title']) && !empty($_POST['message']) && isset($_POST['role'])) {
            $announcement = new Announcements;
            $announcement->insert(['title' => $_POST['title'], 'message' => $_POST['message'], 'role' => $_POST['role'], 'date' => date('Y-m-d'), 'time' => date('H:i:s')]);
        }
        redirect('Admin/announcements');
    }

    public function getAnnouncement($id){
        $announcement = new Announcements;
        $announcement = $announcement->first(['id' => $id]);
        echo json_encode($announcement);
    }

    public function updateAnnouncement($id){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title']) && !empty($_POST['message']) && isset($_POST['role'])) {
            $announcement = new Announcements;
            $announcement->update(['id' => $id], ['title' => $_POST['title'], 'message' => $_POST['message'], 'role' => $_POST['role'], 'date' => date('Y-m-d'), 'time' => date('H:i:s')]);
        }
        redirect('Admin/announcements');
    }

    public function deleteAnnouncement($id){
        if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $announcement = new Announcements;
            $announcement->delete(['id' => $id]);
            echo json_encode(['status' => 'success']);
        }
    }

    public function newProductRequests(){
        $this->data['tabs']['active'] = 'Products';
        $this->view('Admin/productsRequests', $this->data);
    }

    public function getProductsRequests($offset){
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0; 

        $search = $_GET['search'];
        $req = new pendingProductRequests;
        $requests = $req->search($search, $offset);
        foreach($requests as &$req){
            if(!empty($req['barcode'])){
                $product = (new Products)->first(['barcode' => $req['barcode']]);
                $req['alreadyExist'] = is_array($product);
            }
        }
        echo json_encode($requests);
    }

    public function acceptRequest($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $pending = new pendingProductRequests;
            $products = new Products;
            $newProduct = $pending->first(['id' => $id]);
            writeToFile($newProduct);
            if(!$newProduct['barcode']){
                $lastBarcode = (int)$products->getLastGenaratedBarcode() ?: 0;
                $incrementedValue = $lastBarcode + 1;
                writeToFile($incrementedValue);
                $newProduct['barcode'] = str_pad($incrementedValue, 8, "0", STR_PAD_LEFT);;
            }
            $con = $pending->startTransaction();
            $products->insert($newProduct, $con);
            $pending->delete(['id' => $id], $con);
            $con->commit();
        }
    }
    

    public function new($viewName) {
        $this->view('Admin/'.$viewName, $this->data);
    }

    public function deleteRequest($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            (new pendingProductRequests)->delete(['id' => $id]);
            echo json_encode(['success' => true]);
        }
    }
}