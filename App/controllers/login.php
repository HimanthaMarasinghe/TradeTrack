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
                    unset($row['password']);
                    switch ($row['role']) {
                        case '0':
                            $_SESSION['customer'] = $row;
                            // $_SESSION['cus_phone'] = $row['phone'];
                            redirect('Customer/home');
                            break;
                        
                        case '1':
                            // $_SESSION['so_phone'] = $row['phone'];
                            $shop = new Shops;
                            $shop_row = $shop->first(['phone' => $_POST['phone']]);
                            unset($shop_row['password']);
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
                            unset($man_row['password']);
                            unset($man_row['man_phone']);
                            $_SESSION['manufacturer'] = $man_row;
                            // $_SESSION['man_phone'] = $row['phone'];
                            redirect('Manufacturer/home');
                            break;
                        
                        case '3':
                            $distributor = new DistributorM;
                            $dis_row = $distributor->first(['phone' => $_POST['phone']]);
                            if(!$dis_row){
                                echo 'Distributor not found';
                                exit;
                            }
                            unset($dis_row['password']);
                            unset($dis_row['dis_phone']);
                            $_SESSION['distributor'] = $dis_row;
                            // $_SESSION['dis_phone'] = $row['phone'];
                            redirect('Distributor/home');
                            break;
                        
                        case '4':
                            $_SESSION['admin'] = $row;
                            // $_SESSION['ad_phone'] = $row['phone'];
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