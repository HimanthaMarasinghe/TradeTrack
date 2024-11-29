<?php

class manufacturerStock extends Model
{

    protected $table = 'manufacturer_stock';
    protected $readTable = 'manufacturer_stock m INNER JOIN products p ON m.barcode = p.barcode';
    protected $fillable = ['barcode', 'quantity'];

}