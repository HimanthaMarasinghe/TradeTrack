<?php

class BillItems extends Model
{

    protected $table = 'bill_items';
    protected $fillable = ['bill_id', 'barcode', 'quantity'];

}