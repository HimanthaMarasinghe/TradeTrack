<?php

class distributorOrders extends Model
{
    protected $table = 'distributer_orders';

    protected $readTable = 'distributer_orders o
                            INNER JOIN distributors d
                            ON o.dis_phone = d.dis_phone
                            INNER JOIN users u
                            ON d.dis_phone = u.phone';
    // protected $fillable = ['cus_phone', 'so_phone', 'barcode', 'quantity'];

    public function getOrderDetails($phone)
    {
        $sql = "SELECT * 
                FROM distributer_orders o
                INNER JOIN distributors d
                ON o.dis_phone = d.dis_phone
                WHERE o.dis_phone = :phone
                ";
        return $this->query($sql, ['phone' => $phone]);
    }

    public function searchOrdersMan($search, $man_phone, $date = null, $status = null)
    {
        $query = "SELECT * FROM
                  $this->readTable
                  WHERE o.man_phone = :man_phone AND (o.order_id LIKE :search)";
        $queryParm =  ['man_phone' => $man_phone, 'search' => "%$search%"];
        if($date){
             $query .= " AND o.date = :date";
             $queryParm['date'] = $date;
            }
        if($status) {
            $query .= " AND o.status = :status";
            $queryParm['status'] = $status;
        }
        return $this->query($query, $queryParm);
    }

    public function readOrders($man_phone) {
        $sql = "SELECT * FROM $this->readTable
                WHERE o.status IN ('pending', 'processing')
                AND o.man_phone = :man_phone
                ORDER BY o.date DESC, o.time DESC"; 
        return $this->query($sql, ['man_phone' => $man_phone]);
    }
    
}