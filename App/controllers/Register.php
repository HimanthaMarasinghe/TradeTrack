<?php

class Register extends Controller
{
    protected $data = [
        'styleSheet' => ['styleSheet'=>'register']
    ];
    public function index()
    {
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $row = new UserPasswords;
            
            if($row->first(['phone' => $_POST['phone']])){
                $this->data['error'] = 'User already exists';
            }
            else{
                $regService = new RegisterService;
                $toBeSaved = $_POST;
                $toBeSaved['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $regService->register($toBeSaved);
                redirect('login');
            }
        }

        $this->view('register', $this->data);
    }
}