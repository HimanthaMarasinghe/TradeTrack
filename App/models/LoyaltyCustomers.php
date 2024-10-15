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

}