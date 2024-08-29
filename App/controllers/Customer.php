<?php

class Customer extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Shops', 'Loyalty Shops'], 'userType' => 'Customer']
    ];

    public function index(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Customer/home',$this->data);
    }

    public function products(){
        $this->data['tabs']['active'] = 'Products';
        $this->data['products'] = [
        ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Salt', 'quantity' => 20, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Milk', 'quantity' => 25, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Eggs', 'quantity' => 30, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Bread', 'quantity' => 35, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Butter', 'quantity' => 40, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Cheese', 'quantity' => 45, 'barcode' => 'default', 'price' => 100],
        ['product_name' => 'Yogurt', 'quantity' => 50, 'barcode' => 'default', 'price' => 100]
        ];
        $this->view('Customer/Products',$this->data);
    }
    //create new methods after this line.

    public function index()
    {
        $this->data['tabs']['active'] = 'Home';
        $this->view('customer/home', $this->data);
    }

}