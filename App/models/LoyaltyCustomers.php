<?php

class LoyaltyCustomers extends Model
{

    protected $table = 'loyalty_customers';
    protected $fillable = ['so_phone', 'cus_phone', 'wallet'];

    public function updateWallet($cus_phone, $wallet_update, $con)
    {
        $query = "UPDATE $this->table SET wallet = wallet + :wallet_update WHERE cus_phone = :cus_phone && so_phone = :so_phone";
        $data = [
            'wallet_update' => $wallet_update,
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['so_phone']
        ];
        $this->query($query, $data, $con);
    }

    public function allLoyaltyCustomers($so_phone)
    {
        $query = "SELECT * 
                  FROM customers c 
                  JOIN loyalty_customers lc ON c.cus_phone = lc.cus_phone
                  WHERE lc.so_phone = :so_phone";
        $data = ['so_phone' => $so_phone];
        return $this->query($query, $data);
    }

    public function allLoyaltyShops($cus_phone)
    {
        $query = "SELECT s.so_phone, s.shop_name, s.shop_address, u.first_name, u.last_name, u.address, s.shop_pic_format, u.pic_format
                  FROM shops s 
                  JOIN loyalty_customers lc ON s.so_phone = lc.so_phone
                  JOIN users u ON u.phone = s.so_phone
                  WHERE lc.cus_phone = :cus_phone";
        $data = ['cus_phone' => $cus_phone];
        return $this->query($query, $data);
    }

    public function notLoyaltyShops($cus_phone)
    {
        $query = "SELECT s.so_phone, s.shop_name, s.shop_address, u.first_name, u.last_name, u.address, s.shop_pic_format, u.pic_format
                  FROM shops s
                  LEFT JOIN loyalty_customers lc ON s.so_phone = lc.so_phone AND lc.cus_phone = :cus_phone
                  JOIN users u ON u.phone = s.so_phone
                  WHERE lc.so_phone IS NULL";

        $data = ['cus_phone' => $cus_phone];
        return $this->query($query, $data);
    }

}