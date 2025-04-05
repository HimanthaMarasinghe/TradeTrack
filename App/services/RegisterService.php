<?php

class RegisterService extends Database
{
    public function register($newUser){
        $user = new User;
        $userPassword = new UserPasswords;
        $imgUpl = new ImageUploader;

        $con = $this->startTransaction();
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.
        $userPassword->insert($newUser, $con);

        $newUser['pic_format'] = $imgUpl->upload('user_image', $newUser['phone'], 'Profile');
        $user->insert($newUser, $con);

        switch ($newUser['role']) {            
            case '1':
                $shop = new Shops;
                $newUser['so_phone'] = $newUser['phone'];
                $pic_format = $imgUpl->upload('shop_image', $newUser['phone'], 'Shops');
                if ($pic_format) $newUser['shop_pic_format'] = ".$pic_format";
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