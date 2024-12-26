<?php

class RegisterService extends Database
{
    function register($newUser){
        $user = new User;

        $con = $this->startTransaction();
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.
        $user->insert($newUser, $con);

        switch ($newUser['role']) {            
            case '1':
                $shop = new Shops;
                $newUser['so_phone'] = $newUser['phone'];
                $shop->insert($newUser, $con);
                break;

            case '2':
                $manufacturer = new Manufacturers;
                $newUser['man_phone'] = $newUser['phone'];
                $manufacturer->insert($newUser, $con);
                break;

            default:
                break;
        }

        $this->commit( $con);
    }
}