<?php

class ShopStock extends Model
{

    protected $table = 'so_stocks';
    protected $fillable = ['barcode', 'so_phone', 'quantity'];

    public function readStock($sop, $sort = 'DESC', $offset = null){
        $query = "SELECT * FROM products p JOIN so_stocks s ON p.barcode = s.barcode WHERE s.so_phone = :so_phone ";
        
        if($sort === 'low')
            $query .= "AND s.quantity < s.low_stock_level ORDER BY s.quantity ASC";
        else
            $query .= "ORDER BY s.quantity - s.low_stock_level ".$sort;

        if ($offset !== null) 
            $query .= " LIMIT 10 OFFSET $offset";  // Inject the validated offset directly

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

    public function addStock($barcode, $so_phone, $quantity, $con = null){
        $query =   "INSERT INTO so_stocks (barcode, so_phone, quantity) 
                    VALUES (:barcode, :so_phone, :quantity)
                    ON DUPLICATE KEY UPDATE 
                    quantity = quantity + VALUES(quantity);";
        return $this->query($query, ['barcode' => $barcode, 'so_phone' => $so_phone, 'quantity' => $quantity], $con);
    }

    public function searchStock($search, $offset, $so_phone){
        $query = "SELECT * FROM products p JOIN so_stocks s ON p.barcode = s.barcode WHERE s.so_phone = :so_phone AND (p.barcode LIKE :search OR p.product_name LIKE :search) LIMIT 10 OFFSET $offset";
        return $this->query($query, ['search' => "%$search%", 'so_phone' => $so_phone]);
    }
}