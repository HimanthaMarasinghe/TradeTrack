<?php

class SoDisPayment extends Model
{

    protected $table = 'so_dis_payment';

    protected $readTable = '';
    protected $fillable = ['id', 'so_phone', 'dis_phone', 'ammount', 'status', 'date', 'time'];


    public function searchPayment($search = null, $date = null){
        $queryParam = ['search' => "%$search%", 'dis_phone' => $_SESSION['distributor']['phone']];
        $sql = "SELECT * FROM 
                so_dis_payment
                WHERE 
                (id LIKE :search
                OR so_phone LIKE :search
                OR ammount LIKE :search)
                AND dis_phone = :dis_phone";
        if($date){
            $sql .= " AND date = :date";
            $queryParam['date'] = $date;
        }
        return $this->query($sql, $queryParam);
    }

}