<?php

class manufacturerStock extends Model
{

    protected $table = 'manufacturer_stock';
    protected $readTable = 'manufacturer_stock INNER JOIN products ON manufacturer_stock.barcode = products.barcode';
    protected $fillable = ['barcode', 'quantity'];

}