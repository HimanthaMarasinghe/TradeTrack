<?php

class SalesAgent extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Shops', 'Stocks', 'Accounts'], 'userType' => 'SalesAgent'],
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

    public function stockProduct(){
        $this->data['tabs']['active'] = 'Stocks';
        $this->view('SalesAgent/stockProduct', $this->data);
    }

    public function shops(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/shops', $this->data);
    }

    public function shopProfile(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/shopProfile', $this->data);
    }

    public function order(){
        $this->data['tabs']['active'] = 'Shops';
        $this->view('SalesAgent/order', $this->data);
    }

    public function accounts(){
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('SalesAgent/accounts', $this->data);
    }

    public function recordTransaction(){
        $this->data['tabs']['active'] = 'Accounts';
        $this->view('SalesAgent/recordTransaction', $this->data);
    }

    public function newRequest(){
        $this->data['tabs']['active'] = 'Home';
        $this->view('SalesAgent/newRequest', $this->data);
    }





    
    public function new($viewName) {
        $this->view('SalesAgent/'.$viewName, $this->data);
    }
}