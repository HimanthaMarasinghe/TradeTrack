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
            'so_phone' => $_SESSION['shop_owner']['phone']
        ];
        $this->query($query, $data, $con);
    }

    public function allLoyaltyCustomers($so_phone, $search = null, $offset = 0)
    {
        $query = "SELECT * 
                  FROM users u 
                  JOIN loyalty_customers lc ON u.phone = lc.cus_phone
                  WHERE lc.so_phone = :so_phone
                  AND (CONCAT(u.first_name, ' ', u.last_name) LIKE :search OR u.phone LIKE :search)
                  ORDER BY lc.wallet DESC
                  LIMIT 10 OFFSET $offset";
        $data = ['so_phone' => $so_phone, 'search' => "%$search%"];
        return $this->query($query, $data);
    }

    public function allLoyaltyShops($cus_phone, $search = null, $offset = null)
    {
        $data = ['cus_phone' => $cus_phone];
        $query = "SELECT s.so_phone, s.shop_name, s.shop_address, u.first_name, u.last_name, u.address, s.shop_pic_format, u.pic_format
                  FROM shops s 
                  JOIN loyalty_customers lc ON s.so_phone = lc.so_phone
                  JOIN users u ON u.phone = s.so_phone
                  WHERE lc.cus_phone = :cus_phone";
        if($search !== null){
            $query .= " AND (s.shop_name LIKE :search OR s.shop_address LIKE :search)";
            $data['search'] = "%$search%";
        }
        if($offset !== null)
            $query .= " LIMIT 10 OFFSET $offset";
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