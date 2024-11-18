<?php

class Admin extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Remove User', 'Stocks', 'Accounts', 'Add New products'], 'userType' => 'Admin'],
        'styleSheet' => ['styleSheet'=>'admin']
    ];

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











    
    public function new($viewName) {
        $this->view('Admin/'.$viewName, $this->data);
    }
}