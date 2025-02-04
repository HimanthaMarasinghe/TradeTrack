<?php

class LogedInUserCommon extends Controller 
{

    private function forbidIfNotLogedIn($userTypes = ['admin', 'manufacturer', 'distributor', 'shop_owner', 'customer']){
        $alowed = false;
        foreach($userTypes as $type){
            if(isset($_SESSION[$type])){
                $alowed = true;
                break;
            }
        }
        if(!$alowed) redirect('login');
    }

    public function getUserDetails(){
        //Only admins and manufacturers can use this API
        $this->forbidIfNotLogedIn(['admin', 'manufacturer']);
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone'])){
            $user = new User;
            $userDetails = $user->first(['phone' => $_POST['phone']]);
            unset($userDetails['password']);
            echo json_encode($userDetails);
        }
    }

    public function getProducts($offset = 0){
        $this->forbidIfNotLogedIn();
        if (!filter_var($offset, FILTER_VALIDATE_INT)) 
            $offset = 0;
        if(isset($_GET['search'])){
            $prdct = new Products;
            $products = $prdct->searchProducts($_GET['search'], null, $offset);
        }else{
            $prdct = new Products;
            $products = $prdct->readAll(10, $offset);
        }
        echo json_encode($products);
    }
}