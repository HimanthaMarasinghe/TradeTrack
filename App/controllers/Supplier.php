<?php

class Supplier extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Orders', 'Agents'], 'userType' => 'Supplier']
    ];

    public function index()
    {
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

        $this->data['agents'] = [
            ['sa_first_name' => 'John', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'Jane', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'John', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'Jane', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'John', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'Jane', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'John', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
            ['sa_first_name' => 'Jane', 'sa_last_name' => 'Doe', 'business_name' => 'Doe Inc.', 'sa_phone' => 'PhoneNumber', 'sa_address' => '1234 Doe St.'],
        ];

        $this->data['tabs']['active'] = 'Agents';
        $this->view('supplier/agents', $this->data);    
    }

    //create new methods after this line.

}