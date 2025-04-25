<?php

class DisManPayments extends Model
{

    protected $table = 'dis_man_payment';

    protected $readTable = '';
    protected $fillable = ['payment_id', 'man_phone', 'dis_phone', 'ammount', 'status', 'date', 'time'];


    public function searchPayment($search = null, $date = null){
        $queryParam = ['search' => "%$search%", 'dis_phone' => $_SESSION['distributor']['phone']];
        $sql = "SELECT * FROM 
                dis_man_payment
                WHERE 
                (payment_id LIKE :search
                OR ammount LIKE :search)
                AND dis_phone = :dis_phone";
        if($date){
            $sql .= " AND date = :date";
            $queryParam['date'] = $date;
        }
        return $this->query($sql, $queryParam);
    }


}