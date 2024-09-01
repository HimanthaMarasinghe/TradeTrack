<?php

class PreOrders extends Model
{
    protected $table = 'pre_order';
    protected $fillable = ['cus_phone', 'so_phone', 'barcode', 'quantity'];
}