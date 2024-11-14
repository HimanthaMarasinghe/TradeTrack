<?php

class Admin extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Remove User', 'Stocks', 'Accounts', 'Add New products'], 'userType' => 'Admin']
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
        $this->data['tabs']['active'] = 'Add New Products';

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $barcode = trim($_POST['barcode']);
            $productName = trim($_POST['product_name']);
            $unitPrice = trim($_POST['unit_price']);
            $picFormat = '';

            // Handle the image upload
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
                $targetDir = "uploads/";
                $picFormat = basename($_FILES["product_image"]["name"]);
                $targetFilePath = $targetDir . $picFormat;
                $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                // Check if the file is an actual image
                $check = getimagesize($_FILES["product_image"]["tmp_name"]);
                if ($check === false) {
                    $this->data['error'] = "File is not an image.";
                } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    $this->data['error'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                } elseif (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
                    // Successfully uploaded
                    $this->data['success'] = "Image uploaded successfully.";
                } else {
                    $this->data['error'] = "Error uploading image.";
                }
            }

            // Validate other input fields and add product
            if (empty($this->data['error']) && !empty($barcode) && !empty($productName) && !empty($unitPrice)) {
                if ($this->productModel->addProduct($barcode, $productName, $unitPrice, $picFormat)) {
                    $this->data['success'] = "Product added successfully!";
                } else {
                    $this->data['error'] = "Failed to add product.";
                }
            }
        }

        // Load the view
        $this->view('Admin/addNewProducts', $this->data);
    }
}