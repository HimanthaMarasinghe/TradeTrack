<?php

class login extends Controller
{
    public function index()
    {
        // if($_SERVER['REQUEST_METHOD'] == 'POST')
        // {
        //     $user = new User();
        //     $row = $user->first($_POST);
        //     if($row)
        //     {
        //         $_SESSION = $row;
        //         redirect('ShopOwner/home');
        //     }
            
        //     $data['errors'] = $user->errors;
        // }

        $this->view('login');
    }

    
}