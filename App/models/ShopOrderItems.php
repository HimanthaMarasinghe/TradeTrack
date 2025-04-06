<?php

class ShopOrderItems extends Model
{
    protected $table = 'shop_order_items';
    protected $fillable = ['order_id', 'barcode', 'quantity'];

}