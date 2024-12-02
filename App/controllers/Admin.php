<?php

class Admin extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Customers', 'ShopOwners', 'Distributors', 'Manufacturers', 'Products'], 'userType' => 'Admin'],
        'styleSheet' => ['styleSheet'=>'admin']
    ];

    public function __construct() {
        if(!isset($_SESSION['ad_phone'])){
            redirect('login');
            exit;
        }
    }
    //create new methods after this line.
    public function index(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Admin/home',$this->data);
    }
/*
    public function removeUser(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Admin/removeUser', $this->data);
    } 
*/
    public function removeUser() {
        $this->data['tabs']['active'] = 'Remove User';
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
        $this->view('Admin/removeUser', $this->data);
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
            $extension = (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === 0) ? $this->saveImage($_FILES['productImage'], 'images/Products/', $_POST['barcode']) : false;
            if ($extension !== false) {
                $insertData['pic_format'] = $extension;
            }
            $product->insert($insertData);
        }



        $this->data['tabs']['active'] = 'Add New Products';

        // Check if the form is submitted
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //     $barcode = trim($_POST['barcode']);
        //     $productName = trim($_POST['product_name']);
        //     $unitPrice = trim($_POST['unit_price']);
        //     $picFormat = '';

        //     // Handle the image upload
        //     if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        //         $targetDir = "uploads/";
        //         $picFormat = basename($_FILES["product_image"]["name"]);
        //         $targetFilePath = $targetDir . $picFormat;
        //         $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        //         // Check if the file is an actual image
        //         $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        //         if ($check === false) {
        //             $this->data['error'] = "File is not an image.";
        //         } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        //             $this->data['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
        //         } elseif (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
        //             // Successfully uploaded
        //             $this->data['success'] = "Image uploaded successfully.";
        //         } else {
        //             $this->data['error'] = "Error uploading image.";
        //         }
        //     }

        //     // Validate other input fields and add product
        //     if (empty($this->data['error']) && !empty($barcode) && !empty($productName) && !empty($unitPrice)) {
        //         if ($this->productModel->addProduct($barcode, $productName, $unitPrice, $picFormat)) {
        //             $this->data['success'] = "Product added successfully!";
        //         } else {
        //             $this->data['error'] = "Failed to add product.";
        //         }
        //     }
        // }



        // Load the view
        $this->view('Admin/addNewProducts', $this->data);
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
            header('Location: ' . LINKROOT . '/ShopOwner/stocks');
            return;
        }
        $prd = new Products;
        $this->data['product'] = $prd->first(['barcode' => $barcodeIn]);
        if(!$this->data['product']){
            header('Location: ' . LINKROOT . '/admin/addNewProducts'); //Todo: Change this to a product page.
            return;
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
        $prdct = new Products;
        $this->data['products'] = $prdct->readAll();
        $this->view('Admin/products', $this->data);
    }


    public function Customers(){
        $this->data['tabs']['active'] = 'Customers';
        $this->view('Admin/customers', $this->data);
    }

    public function Distributors(){
        $this->data['tabs']['active'] = 'Distributors';
        $this->view('Admin/salesAgents', $this->data);
    }

    public function customer(){
        $this->data['tabs']['active'] = 'Customers';
        $this->view('Admin/customer', $this->data);
    }

    public function salesAgent(){
        $this->data['tabs']['active'] = 'Distributors';
        $this->view('Admin/salesAgent', $this->data);
    }

    public function ShopOwners(){
        $this->data['tabs']['active'] = 'ShopOwners';
        $this->view('Admin/shopOwners', $this->data);
    }

    public function shopOwner(){
        $this->data['tabs']['active'] = 'ShopOwners';
        $this->view('Admin/shopOwner', $this->data);
    }

    public function Manufacturers(){
        $this->data['tabs']['active'] = 'Manufacturers';
        $this->view('Admin/suppliers', $this->data);
    }

    public function supplier(){
        $this->data['tabs']['active'] = 'Manufacturers';
        $this->view('Admin/supplier', $this->data);
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
        // else {
        //     echo "Error: Invalid data";
        //     echo "<br>";
        //     print_r($_POST);
        //     echo "<br>";
        //     echo $_SERVER['REQUEST_METHOD'];
        //     echo "<br> method check";
        //     echo $_SERVER['REQUEST_METHOD'] === 'POST';
        //     echo "<br> title check";
        //     echo !empty($_POST['title']);
        //     echo "<br> message check";
        //     echo !empty($_POST['message']);
        //     echo "<br> role check";
        //     echo !empty($_POST['role']);

        // }
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
        $pendingProducts = new pendingProductRequests;
        $this->data['pendingProducts'] = $pendingProducts->readAll();
        $this->data['tabs']['active'] = 'Products';
        $this->view('Admin/productsRequests', $this->data);
    }

    public function pendingProductRequestDetails(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['barcodeIn'])){
            $req = new pendingProductRequests;
            echo json_encode($req->first(['barcode' => $_POST['barcodeIn']]));
        }
    }
    

    public function new($viewName) {
        $this->view('Admin/'.$viewName, $this->data);
    }
}