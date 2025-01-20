<?php

class login extends Controller
{
    public function index()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $userPasswordM = new UserPasswords;
            $row = $userPasswordM->first(['phone' => $_POST['phone']]);


            if($row){
                if(password_verify($_POST['password'], $row['password'])){
                    $userM = new User;
                    $user = $userM->first(['phone' => $_POST['phone']]);
                    switch ($user['role']) {
                        case '0':
                            $_SESSION['customer'] = $user;
                            redirect('Customer/home');
                            break;
                        
                        case '1':
                            $shop = new Shops;
                            $shop_row = $shop->first(['phone' => $_POST['phone']]);
                            unset($shop_row['so_phone']);
                            if(!$shop_row){
                                echo 'Shop not found';
                                exit;
                            }
                            $_SESSION['shop_owner'] = $shop_row;
                            redirect('ShopOwner/home');
                            break;
                        
                        case '2':
                            $manufacturer = new Manufacturers;
                            $man_row = $manufacturer->first(['phone' => $_POST['phone']]);
                            if(!$man_row){
                                echo 'Manufacturer not found';
                                exit;
                            }
                            unset($man_row['man_phone']);
                            $_SESSION['manufacturer'] = $man_row;
                            // $_SESSION['man_phone'] = $user['phone'];
                            redirect('Manufacturer/home');
                            break;
                        
                        case '3':
                            $distributor = new DistributorM;
                            $dis_row = $distributor->first(['phone' => $_POST['phone']]);
                            if(!$dis_row){
                                echo 'Distributor not found';
                                exit;
                            }
                            unset($dis_row['dis_phone']);
                            $_SESSION['distributor'] = $dis_row;
                            // $_SESSION['dis_phone'] = $user['phone'];
                            redirect('Distributor/home');
                            break;
                        
                        case '4':
                            $_SESSION['admin'] = $user;
                            // $_SESSION['ad_phone'] = $user['phone'];
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