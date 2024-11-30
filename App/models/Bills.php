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

}