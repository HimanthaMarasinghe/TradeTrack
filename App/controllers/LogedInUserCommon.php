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
        $notifications = $notificationM->where(['phone' => $phone], [], null, null, ['type', 'ref_id', 'title', 'link', 'body']) ?: [];
        // Todo : when chat feature is build, read messages that have false for the read status and genareate notifications for each chat (Not the message) and apend them to the $notifications variable.
        echo json_encode($notifications);
    }

    public function deleteNotification() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = $this->forbidIfNotLogedIn();
            if (!$phone) return;
            $notification = jsonPostDecode();
            $notificationM = new UserNotification;
            $notificationM->delete(['phone' => $phone, 'type' => $notification['type'], 'ref_id' => $notification['ref_id']]);
        }
    }

    public function searchBills($offset = 0) {
        $this->forbidIfNotLogedIn(['shop_owner', 'customer']);
        if (!filter_var($offset, FILTER_VALIDATE_INT)) $offset = 0;
        $bill = new Bills;
        $billItems = new BillItems;
        if(isset($_GET['search'])) $bills = $bill->search($offset, $_GET['search'], $_GET['date']);
        else if(isset($_GET['cus_phone'])) {
            $data = ['s.so_phone' => $_SESSION['shop_owner']['phone'], 'u.phone' => $_GET['cus_phone']];
            if($_GET['date']) $data['date'] = $_GET['date'];
            $bills = $bill->where($data, [], 10,$offset, ['bill_id', 'date', 'time', 'first_name', 'last_name', 'cus_phone', 'pic_format']);
        }
        else if($_GET['so_phone']) {
            $data = ['u.phone' => $_SESSION['customer']['phone'], 's.so_phone' => $_GET['so_phone']];
            if(isset($_GET['date'])) $data['date'] = $_GET['date'];
            $bills = $bill->where($data, [], 10, $offset, ['bill_id', 'date', 'time', 'shop_name', 's.so_phone', 'shop_pic_format']);
        }
        foreach($bills as &$bill){
            $bill['total'] = $billItems->getBillTotal($bill['bill_id']);
        }
        unset($bill);
        echo json_encode($bills);
    }
}