<?php

class ShopOrder extends Model
{
    protected $table = 'shop_orders';
    protected $fillable = ['date', 'time', 'so_phone', 'dis_phone'];

}