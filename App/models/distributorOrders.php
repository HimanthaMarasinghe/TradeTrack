<?php

class distributorOrders extends Model
{
    protected $table = 'distributer_orders';

    protected $readTable = 'distributer_orders o
                            INNER JOIN sales_agents s
                            ON o.dis_phone = s.sa_phone
                            INNER JOIN users u
                            ON s.sa_phone = u.phone';
    // protected $fillable = ['cus_phone', 'so_phone', 'barcode', 'quantity'];

    public function getOrderDetails($phone)
    {
        $sql = "SELECT * 
                FROM distributer_orders o
                INNER JOIN sales_agents s
                ON o.dis_phone = s.sa_phone
                WHERE o.dis_phone = :phone
                ";
        return $this->query($sql, ['phone' => $phone]);
    }
}