<?php

class SoDisPayment extends Model
{

    protected $table = 'so_dis_payment';
    protected $fillable = ['so_phone', 'dis_phone', 'ammount', 'status', 'date', 'time'];


    public function searchPayment($dis_phone, $search = null, $date = null, $offset = null, $so_phone = null){
        $queryParam = ['search' => "%$search%", 'dis_phone' => $dis_phone];
        $sql = "SELECT * FROM 
                so_dis_payment
                WHERE 
                (id LIKE :search
                OR so_phone LIKE :search
                OR ammount LIKE :search)
                AND dis_phone = :dis_phone";
        if($so_phone){
            $sql .= " AND so_phone = :so_phone";
            $queryParam['so_phone'] = $so_phone;
        }
        if($date){
            $sql .= " AND date = :date";
            $queryParam['date'] = $date;
        }
        $sql .= " ORDER BY date DESC, time DESC";
        if($offset) $sql .= " LIMIT 10 OFFSET $offset";
        return $this->query($sql, $queryParam);
    }
}