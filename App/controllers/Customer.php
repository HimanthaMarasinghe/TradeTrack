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
        ['product_name' => 'Samen', 'quantity' => 5, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Rice', 'quantity' => 10, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Sugar', 'quantity' => 15, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Salt', 'quantity' => 20, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Milk', 'quantity' => 25, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Eggs', 'quantity' => 30, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Bread', 'quantity' => 35, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Butter', 'quantity' => 40, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Cheese', 'quantity' => 45, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg'],
        ['product_name' => 'Yogurt', 'quantity' => 50, 'barcode' => 'default', 'price' => 100, 'pic_format' => 'jpeg']
        ];
        $this->view('Customer/Products',$this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
        $this->data['shops'] = [
        ['shop_name' => 'Shop1', 'shop_address' => 'Address1', 'so_phone' => 'default'],
        ['shop_name' => 'Shop2', 'shop_address' => 'Address2', 'so_phone' => 'default'],
        ['shop_name' => 'Shop3', 'shop_address' => 'Address3', 'so_phone' => 'default'],
        ['shop_name' => 'Shop4', 'shop_address' => 'Address4', 'so_phone' => 'default'],
        ['shop_name' => 'Shop5', 'shop_address' => 'Address5', 'so_phone' => 'default'],
        ['shop_name' => 'Shop6', 'shop_address' => 'Address6', 'so_phone' => 'default'],
        ['shop_name' => 'Shop7', 'shop_address' => 'Address7', 'so_phone' => 'default'],
        ['shop_name' => 'Shop8', 'shop_address' => 'Address8', 'so_phone' => 'default'],
        ['shop_name' => 'Shop9', 'shop_address' => 'Address9', 'so_phone' => 'default'],
        ['shop_name' => 'Shop10', 'shop_address' => 'Address10', 'so_phone' => 'default'],
        ];
        $this->view('Customer/shops',$this->data);
    }

    public function loyaltyShops(){
        $this->data['tabs']['active'] = 'Loyalty Shops';
        $this->data['shops'] = [
        ['shop_name' => 'Shop1', 'shop_address' => 'Address1', 'so_phone' => 'default'],
        ['shop_name' => 'Shop2', 'shop_address' => 'Address2', 'so_phone' => 'default'],
        ['shop_name' => 'Shop3', 'shop_address' => 'Address3', 'so_phone' => 'default'],
        ['shop_name' => 'Shop4', 'shop_address' => 'Address4', 'so_phone' => 'default'],
        ['shop_name' => 'Shop5', 'shop_address' => 'Address5', 'so_phone' => 'default'],
        ['shop_name' => 'Shop6', 'shop_address' => 'Address6', 'so_phone' => 'default'],
        ['shop_name' => 'Shop7', 'shop_address' => 'Address7', 'so_phone' => 'default'],
        ['shop_name' => 'Shop8', 'shop_address' => 'Address8', 'so_phone' => 'default'],
        ['shop_name' => 'Shop9', 'shop_address' => 'Address9', 'so_phone' => 'default'],
        ['shop_name' => 'Shop10', 'shop_address' => 'Address10', 'so_phone' => 'default'],
        ];
        $this->view('Customer/loyaltyShops',$this->data);
    }
    //create new methods after this line.

}