<?php

class PreOrders extends Model
{
    protected $table = 'preOrders';
    protected $fillable = ['shopID', 'cusID', 'shopList'];
}