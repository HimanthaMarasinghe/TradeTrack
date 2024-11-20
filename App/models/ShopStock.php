<?php

class ShopStock extends Model
{

    protected $table = 'so_stocks';
    protected $fillable = ['barcode', 'so_phone', 'quantity'];

    public function readStock($sop, $sort = 'DESC'){
        $query = "SELECT * FROM products p JOIN so_stocks s ON p.barcode = s.barcode WHERE s.so_phone = :so_phone ";
        if($sort === 'low')
            $query .= "AND s.quantity < 100 ORDER BY s.quantity ASC";
        else
            $query .= "ORDER BY s.quantity ".$sort;
        return $this->query($query,['so_phone' => $sop]);
    }

    public function shopsThatSellProduct($barcode){
        $query = "SELECT *
                  FROM shops s
                  JOIN so_stocks so
                  ON s.so_phone = so.so_phone
                  WHERE so.barcode = :barcode";
        return $this->query($query,['barcode' => $barcode]);
    }
}