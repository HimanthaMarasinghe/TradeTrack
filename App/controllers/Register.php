<?php

class Register extends Controller
{
    protected $data = [
        'styleSheet' => ['styleSheet'=>'index']
    ];
    public function index()
    {
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $user = new User();
            if($user->first(['phone' => $_POST['phone']])){
                $this->data['error'] = 'User already exists';
            }
            else{
                $toBeSaved = $_POST;
                $toBeSaved['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $user->insert($toBeSaved);
               redirect('login');
            }
        }

        $this->view('register', $this->data);
    }
}