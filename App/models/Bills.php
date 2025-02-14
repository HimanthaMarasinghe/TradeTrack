<?php

class Bills extends Model
{

    protected $table = 'bills';
    protected $readTable = 'bills b 
                            INNER JOIN shops s 
                            ON b.so_phone = s.so_phone 
                            LEFT JOIN users u
                            ON b.cus_phone = u.phone ';
    protected $fillable = ['bill_id', 'cus_phone', 'so_phone'];

    public function getRecentBillDetails($phone)
    {
        $sql = "SELECT * 
                FROM bills b 
                INNER JOIN shops s 
                ON b.so_phone = s.so_phone 
                LEFT JOIN users u
                ON b.cus_phone = u.phone 
                WHERE b.so_phone = :phone 
                ORDER BY b.date DESC, b.time DESC 
                LIMIT 15;
                ";
        return $this->query($sql, ['phone' => $phone]);
    }

    public function search($offset = 0, $search = null, $date = null) {
        $sql = "SELECT *
                FROM $this->readTable";

        $queryPara = ['search' => "%$search%"];

        if (isset($_SESSION['customer'])) {
            $sql .= " WHERE b.cus_phone = :cus_phone AND (s.shop_name LIKE :search OR b.bill_id LIKE :search)";
            $queryPara['cus_phone'] = $_SESSION['customer']['phone'];
        }
        else {
            $sql .= " WHERE b.so_phone = :so_phone AND (CONCAT(u.first_name,' ',u.last_name) LIKE :search OR b.bill_id LIKE :search)";
            $queryPara['so_phone'] = $_SESSION['shop']['so_phone'];
        }

        if($date) {
            $sql .= " AND b.date = :date";
            $queryPara['date'] = $date;
        }

        $sql .= " LIMIT 10 OFFSET $offset";

        return $this->query($sql, $queryPara);
    }

}