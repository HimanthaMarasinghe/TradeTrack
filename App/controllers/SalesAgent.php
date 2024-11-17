<?php

class SalesAgent extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Loyalty Customers', 'Stocks', 'Accounts'], 'userType' => 'SalesAgent'],
        'styleSheet' => 'index'
    ];

    //create new methods after this line.
    public function shops(){
        $this->view('SalesAgent/shops', $this->data);
    }

}