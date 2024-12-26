<?php

class login extends Controller
{
    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $user = new User;
            $row = $user->first(['phone' => $_POST['phone']]);
            if($row){
                if(password_verify($_POST['password'], $row['password'])){
                    switch ($row['role']) {
                        case '0':
                            $_SESSION['cus_phone'] = $row['phone'];
                            redirect('Customer/home');
                            break;
                        
                        case '1':
                            $_SESSION['so_phone'] = $row['phone'];
                            $shop = new Shops;
                            $shop_row = $shop->first(['phone' => $row['phone']]);
                            if($shop_row){
                                $_SESSION['shop'] = $shop_row;
                            }
                            redirect('ShopOwner/home');
                            break;
                        
                        case '2':
                            $_SESSION['man_phone'] = $row['phone'];
                            redirect('Manufacturer/home');
                            break;
                        
                        case '3':
                            $_SESSION['dis_phone'] = $row['phone'];
                            redirect('Distributor/home');
                            break;
                        
                        case '4':
                            $_SESSION['ad_phone'] = $row['phone'];
                            redirect('admin/home');
                            break;
                    }

                }else{
                    echo 'Wrong password';
                }
            }
            else{
                echo 'wrong username';
            }
        }

        $this->view('login');
    }

    public function logout(){
        session_unset(); // Clear all session variables
        session_destroy(); // Destroy the session
        redirect('home');
    }

    
}