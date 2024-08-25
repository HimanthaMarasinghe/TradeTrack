<?php

class Admin extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Remove User', 'Stocks', 'Accounts'], 'userType' => 'Admin']
    ];

    //create new methods after this line.
    public function index(){
        $this->view('Admin/home',$this->data);
    }
/*
    public function removeUser(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('Admin/removeUser', $this->data);
    } 
*/
    public function removeUser() {
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
        $this->view('Admin/removeUser', $this->data);
    }

    public function removeUserDetails() {
        $this->data['loyalCus'] = [
            'name' => 'John Doe',
            'phone' => '0112224690',
            'address' => 'No 123, Main Street, Colombo 07'
        ];
        $this->data['tabs']['active'] = 'Loyalty Customers';
        $this->view('Admin/removeUserDetails', $this->data);
    }
}