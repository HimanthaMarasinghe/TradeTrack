<?php

class Register extends Controller
{
    protected $data = [
        'styleSheet' => ['styleSheet'=>'index']
    ];
    public function index()
    {
        
        // if($_SERVER['REQUEST_METHOD'] == 'POST')
        // {
        //     $user = new User();
        //     if($user->validate($_POST))
        //     {
        //         $user->insert($_POST);
        //         redirect('home');
        //     }
            
        //     $this->data['errors'] = $user->errors;
        // }

        $this->view('register', $this->data);
    }
}