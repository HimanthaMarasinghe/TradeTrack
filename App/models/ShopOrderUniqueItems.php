<?php

class ShopOrderUniqueItems extends Model
{
    protected $table = 'shop_order_unique_items';

    protected $readTable = 'shop_order_unique_items i 
                            INNER JOIN shop_unique_products p 
                            ON i.product_code = p.product_code 
                            INNER JOIN shop_orders o 
                            ON p.so_phone = o.so_phone
                            AND i.order_id = o.order_id';
    protected $fillable = ['order_id', 'product_code', 'quantity', 'sold_bulk_price'];

    public function orderDetails($order_id) {
        $order['items'] = $this->where(data: ['o.order_id' => $order_id], readFields:['i.product_code', 'p.product_name', 'i.quantity', 'i.sold_bulk_price']);
        writeToFile($order['items'], 'orderItems');
        if (!$order['items']) return false;

        $order['items'] = array_map(function($item){
            $item['barcode'] = "x".$item['product_code'];
            $item['total'] += $item['sold_bulk_price'] * $item['quantity'];
            return $item;
        }, $order['items']);

        foreach($order['items'] as $item){
            $order['total'] += $item['total'];
        }
        return $order;
    }
}