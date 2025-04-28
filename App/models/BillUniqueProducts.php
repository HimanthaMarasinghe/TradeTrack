<?php

class BillUniqueProducts extends Model
{

    protected $table = 'bill_unique_items';

    protected $readTable = 'bill_unique_items bui 
                            INNER JOIN 
                            shop_unique_products sui 
                            ON bui.product_code = sui.product_code 
                            INNER JOIN 
                            bills b 
                            ON b.so_phone = sui.so_phone
                            AND b.bill_id = bui.bill_id';
    protected $fillable = ['bill_id', 'product_code', 'so_phone', 'sold_price', 'quantity'];

}