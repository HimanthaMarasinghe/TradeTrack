<?php

class PreOrderUniqueItems extends Model
{

    protected $table = 'pre_order_unique_items';

    protected $readTable = 'pre_order_unique_items pui 
                            INNER JOIN 
                            shop_unique_products sui 
                            ON pui.product_code = sui.product_code 
                            INNER JOIN 
                            pre_order p 
                            ON p.so_phone = sui.so_phone
                            AND p.pre_order_id = pui.pre_order_id';
    protected $fillable = ['pre_order_id', 'product_code', 'po_unit_price', 'po_quantity'];

    public function preOrderAmount($preOrderId)
    {
        $query = "SELECT SUM(po_unit_price * po_quantity) as total FROM pre_order_unique_items WHERE pre_order_id = :pre_order_id";
        $total = $this->query($query, ['pre_order_id' => $preOrderId])[0]['total'] ?? 0;
        // return number_format($total, 2);
        return $total; // Return the raw total for further processing
    }

    public function readPreOrderItems($preOrderId)
    {
        $query = "SELECT product_code as barcode, po_unit_price as price, po_quantity as qty FROM $this->table WHERE pre_order_id = :pre_order_id";
        return $this->query($query, ['pre_order_id' => $preOrderId]);
    }
}