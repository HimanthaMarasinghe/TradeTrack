<?php

class PreOrder extends Model
{
    protected $table = 'pre_order';
    protected $fillable = ['cus_phone', 'so_phone', 'pre_order_id', 'date_time', 'status'];
}