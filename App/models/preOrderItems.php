<?php

class PreOrderItems extends Model
{
    protected $table = 'pre_order_items';
    protected $readTable = 'pre_order_items p JOIN products pr ON p.barcode = pr.barcode';
    protected $fillable = ['pre_order_id', 'barcode', 'po_unit_price', 'quantity'];

    public function preOrderAmount($preOrderId)
    {
        $query = "SELECT SUM(po_unit_price * quantity) as total FROM pre_order_items WHERE pre_order_id = :pre_order_id";
        $total = $this->query($query, ['pre_order_id' => $preOrderId])[0]['total'] ?? 0;
        // return number_format($total, 2);
        return $total; // Return the raw total for further processing
    }

    // Used to create a bill for the pre-order
    public function readPreOrderItems($preOrderId)
    {
        $query = "SELECT barcode, po_unit_price as price, quantity as qty FROM pre_order_items WHERE pre_order_id = :pre_order_id";
        return $this->query($query, ['pre_order_id' => $preOrderId]);
    }
}