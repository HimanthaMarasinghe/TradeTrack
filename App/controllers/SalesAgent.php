<?php

class SalesAgent extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Shops','Loyalty Shops','Orders', 'Stocks', 'Accounts'], 'userType' => 'SalesAgent'],
        'styleSheet' => ['styleSheet'=>'salesAgent']
    ];

    //create new methods after this line.

    public function index(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('SalesAgent/home', $this->data);
    }

    public function stocks(){
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/stocks', $this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/shops', $this->data);
    }

    public function loyaltyShops(){
        $this->data['tabs']['active'] = 'Loyalty Shops';
        $this->view('SalesAgent/customerShops', $this->data);
    }

    public function shopProfile(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/shopProfile', $this->data);
    }

    public function orderDetails(){
        $this->data['tabs']['active'] = 'Orders';
        $this->view('SalesAgent/orderDetails', $this->data);
    }

    public function accounts(){
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('SalesAgent/accounts', $this->data);
    }

    public function recordTransaction(){
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('SalesAgent/recordTransaction', $this->data);
    }

    public function newInventryRequest(){
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/newInventryRequest', $this->data);
    }

    public function orders(){
        $this->data['tabs']['active'] = 'Orders';
        $this->view('SalesAgent/orders', $this->data);
    }





    
    public function new($viewName) {
        $this->view('SalesAgent/'.$viewName, $this->data);
    }
}