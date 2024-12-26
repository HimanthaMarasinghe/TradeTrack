<?php

class pendingProductRequests extends Model
{

    protected $table = 'pending_product_requests';
    // protected $readTable = 'distributors s INNER JOIN users u ON s.dis_phone = u.phone';
    protected $fillable = ['barcode', 'product_name', 'unit_price', 'bulk_price', 'pic_format', 'man_phone'];

}