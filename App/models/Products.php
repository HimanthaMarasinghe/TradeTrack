<?php

class Products extends Model
{

    protected $table = 'products';
    protected $fillable = ['barcode', 'product_name', 'unit_price', 'pic_format'];

}