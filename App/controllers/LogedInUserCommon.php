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
        $products = (new ShopProductsService)->searchProducts($_GET['search'], null, $offset);
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
        if(isset($_GET['search'])) $bills = $bill->search($offset, $_GET['search'], $_GET['date']);
        else if(isset($_GET['cus_phone'])) {
            $data = ['s.so_phone' => $_SESSION['shop_owner']['phone'], 'u.phone' => $_GET['cus_phone']];
            if($_GET['date']) $data['date'] = $_GET['date'];
            $bills = $bill->where($data, [], 10,$offset, ['bill_id', 'date', 'time', 'first_name', 'last_name', 'cus_phone', 'pic_format'], ['bill_id']);
        }
        else if($_GET['so_phone']) {
            $data = ['u.phone' => $_SESSION['customer']['phone'], 's.so_phone' => $_GET['so_phone']];
            if(isset($_GET['date'])) $data['date'] = $_GET['date'];
            $bills = $bill->where($data, [], 10, $offset, ['bill_id', 'date', 'time', 'shop_name', 's.so_phone', 'shop_pic_format'], ['bill_id']);
        }
        foreach($bills as &$bill){
            $bill['total'] = (new BillService)->getBillTotal($bill['bill_id']);
        }
        unset($bill);
        echo json_encode($bills);
    }

    public function sendChat($to) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = $this->forbidIfNotLogedIn(['customer', 'shop_owner', 'distributor', 'manufacturer']);
            $message = jsonPostDecode();
            $chat = new Chat;
            $chat->sendMessage($phone, $to, $message['message']);
            $name = (new User)->first(data: ['phone' => $phone], readFields:['first_name', 'last_name']);
            (new NotificationService)->sendNotification($to, 'chat', $phone, "New Message from {$name['first_name']} {$name['last_name']}", $message['message'], $message['link']);
            echo json_encode(['status' => 'success']);
        }
    }
}