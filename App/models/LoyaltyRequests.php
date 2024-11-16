<?php

class LoyaltyRequests extends Model
{
    protected $table = 'loyalty_requests';
    protected $fillable = ['so_phone', 'cus_phone'];

    public function allRequests($so_phone)
    {
        $query = "SELECT * FROM loyalty_requests INNER JOIN customers ON loyalty_requests.cus_phone = customers.cus_phone WHERE so_phone = :so_phone";
        return $this->query($query, ['so_phone' => $so_phone]);
    }

    public function readNewLoyReq($so_phone, $cus_phone) {
        $query = "SELECT * FROM loyalty_requests INNER JOIN customers ON loyalty_requests.cus_phone = customers.cus_phone WHERE so_phone = :so_phone AND loyalty_requests.cus_phone = :cus_phone LIMIT 1";
        $result = $this->query($query, ['so_phone' => $so_phone, 'cus_phone' => $cus_phone]);
        if($result)
            return $result[0];

        return false;
    }

    
}