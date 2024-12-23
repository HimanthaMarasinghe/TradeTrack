<?php

class LogedInUserCommon extends Controller 
{

    public function getUserDetails(){
        //Only admins and manufacturers can use this API
        // if(!(isset($_SESSION['su_phone']) || isset($_SESSION['ad_phone']))){
        //     redirect('login');
        //     exit;
        // }
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone'])){
            $user = new User;
            $userDetails = $user->first(['phone' => $_POST['phone']]);
            unset($userDetails['password']);
            echo json_encode($userDetails);
        }
    }

}