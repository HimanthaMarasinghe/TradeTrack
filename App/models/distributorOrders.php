<?php

class distributorOrders extends Model
{
    protected $table = 'distributer_orders';

    protected $readTable = 'distributer_orders o
                            INNER JOIN distributors d
                            ON o.dis_phone = d.dis_phone
                            INNER JOIN users u
                            ON d.dis_phone = u.phone';
    // protected $fillable = ['order_id', 'date', 'time', 'dis_phone', 'man_phone'];

    public function getOrderDetails($phone)
    {
        $sql = "SELECT * 
                FROM distributer_orders o
                INNER JOIN distributors d
                ON o.dis_phone = d.dis_phone
                WHERE o.dis_phone = :phone

                ORDER BY 
                CASE status
                    WHEN 'Processing' THEN 1
                    WHEN 'Pending' THEN 2
                    WHEN 'Delivering' THEN 3
                    WHEN 'Recieved' THEN 4
                    ELSE 5
                END,
                date DESC, time DESC
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

    // public function searchRequestDetails($search = null, $date = null, $status = null) {
    //     $sql = "SELECT * FROM distributer_orders WHERE dis_phone = :dis_phone";
    //     $params = ['dis_phone' => $_SESSION['distributor']['phone']];
    
    //     if ($search) {
    //         $sql .= " AND order_id = :order_id";
    //         $params['order_id'] = $search;
    //     }
    
    //     if ($date) {
    //         $sql .= " AND date = :date";
    //         $params['date'] = $date;
    //     }
    
    //     if ($status) {
    //         $sql .= " AND status = :status";
    //         $params['status'] = $status;
    //     }
    
    //     $sql .= " ORDER BY 
    //         CASE status
    //             WHEN 'Processing' THEN 1
    //             WHEN 'Pending' THEN 2
    //             WHEN 'Ready' THEN 3
    //             WHEN 'Done' THEN 4
    //             ELSE 5
    //         END,
    //         date DESC, time DESC";
    
    //     return $this->query($sql, $params);
    // }    
    
}