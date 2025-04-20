<?php

class shopOrders extends Model
{
    
    protected $table ='shop_orders';
    // protected $fillable = ['so_phone', 'barcode', 'quantity'];

    

    public function searchOrders($search = null) {
        $sql = "SELECT * FROM 
                shop_orders o
                INNER JOIN users u
                ON o.so_phone = u.phone
                INNER JOIN shops s
                ON o.so_phone = s.so_phone
                WHERE 
                (o.so_phone = :search OR CONCAT(u.first_name,' ',u.last_name) LIKE :search 
                OR s.shop_name LIKE :search
                OR o.order_id = :search) 
                AND o.dis_phone = :dis_phone";
        return $this->query($sql, ['search' => "%$search%", 'dis_phone' => $_SESSION['distributor']['phone']]);
    }
}