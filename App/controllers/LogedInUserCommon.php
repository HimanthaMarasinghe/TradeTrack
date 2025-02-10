<?php

class LogedInUserCommon extends Controller 
{
    private function forbidIfNotLogedIn($userTypes = ['admin', 'manufacturer', 'distributor', 'shop_owner', 'customer']){
        $alowed = false;
        foreach($userTypes as $type){
            if(isset($_SESSION[$type])){
                $alowed = true;
                $phone = $_SESSION[$type]['phone'];
                break;
            }
        }
        if(!$alowed) {
            echo json_encode(['error' => 'You are not loged in']);
            die;
        }
        else return $phone;
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

    public function getNotifications() {
        $phone = $this->forbidIfNotLogedIn();
        if (!$phone) return;
        $notificationM = new UserNotification;
        $notifications = $notificationM->where(['phone' => $phone], [], null, null, ['title', 'link', 'body']);
        echo json_encode($notifications);
    }

    public function getNotificationsCount() {
        $phone = $this->forbidIfNotLogedIn();
        if (!$phone) return;
        $notificationM = new UserNotification;
        $count = $notificationM->getCount($phone);
        echo json_encode($count);
    }
}