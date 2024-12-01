<?php

class distributorOrdersItems extends Model
{
    protected $table = 'distributer_order_items';
    protected $readTable = 'distributer_order_items doi 
                            JOIN products p 
                            ON doi.barcode = p.barcode';
    // protected $fillable = ['cus_phone', 'so_phone', 'barcode', 'quantity'];

    public function getOrderTotal($order_id) {
        $sql = "SELECT SUM(products.unit_price * distributer_order_items.quantity) as total
                FROM distributer_order_items JOIN products ON distributer_order_items.barcode = products.barcode
                WHERE distributer_order_items.order_id = :order_id";
        return $this->query($sql, ['order_id' => $order_id])[0]['total'];        
    }
}