<?php

class LoyaltyRequests extends Model
{
    protected $table = 'loyalty_requests';
    protected $readTable = 'loyalty_requests INNER JOIN users ON loyalty_requests.cus_phone = users.phone';
    protected $fillable = ['so_phone', 'cus_phone'];

    public function newLoyReqFromCustomer($offset = 0) {
        $query = "SELECT * 
                  FROM loyalty_requests l
                  INNER JOIN shops s
                  ON l.so_phone = s.so_phone
                  WHERE l.cus_phone = :cus_phone
                  LIMIT 10 OFFSET $offset";
        return $this->query($query, ['cus_phone' => $_SESSION['customer']['phone']]);
    }
}