<?php

class PreOrderItems extends Model
{
    protected $table = 'pre_order_items';
    protected $fillable = ['pre_order_id', 'barcode', 'quantity'];
}