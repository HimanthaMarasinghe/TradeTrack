<?php

class SalesAgent extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Loyalty Customers', 'Stocks', 'Accounts'], 'userType' => 'SalesAgent'],
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
        $this->view('SalesAgent/shops', $this->data);
    }






    
    public function new($viewName) {
        $this->view('SalesAgent/'.$viewName, $this->data);
    }
}