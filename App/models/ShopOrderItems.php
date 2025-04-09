<?php

class ShopOrderItems extends Model
{
    protected $table = 'shop_order_items';

    protected $readTable = 'shop_order_items soi INNER JOIN products p ON soi.barcode = p.barcode';
    protected $fillable = ['order_id', 'barcode', 'quantity'];

    public function orderDetails($order_id) {
        $order['items'] = $this->where(['order_id' => $order_id]);
        foreach($order['items'] as &$item){
            $item['total'] += $item['bulk_price'] * $item['quantity'];
        }
        unset($item);
        foreach($order['items'] as $item){
            $order['total'] += $item['total'];
        }
        return $order;
    }
}