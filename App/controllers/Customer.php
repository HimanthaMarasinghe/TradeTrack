<?php

class Customer extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Products', 'Shops', 'Loyalty Shops'], 'userType' => 'Customer']
    ];

    //create new methods after this line.

    public function index()
    {
        $this->data['tabs']['active'] = 'Home';
        $this->view('customer/home', $this->data);
    }

}