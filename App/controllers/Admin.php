<?php

class Admin extends Controller 
{
    protected $data = [
        'tabs' => ['tabs' => ['Home', 'Users', 'Products', 'Announcements'], 'userType' => 'Admin']
    ];

    //create new methods after this line.

    public function index()
    {
        $this->view('admin/home', $this->data);
    }

}