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
}