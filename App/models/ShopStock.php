<?php

class ShopStock extends Model
{

    protected $table = 'so_stocks';
    protected $fillable = ['barcode', 'so_phone', 'quantity', 'pre_orderable_stock', 'non_preorderable_stock'];

    public function readStock($sop, $sort = 'DESC', $offset = null, $search = null){
        $query = "SELECT * FROM products p JOIN so_stocks s ON p.barcode = s.barcode WHERE s.so_phone = :so_phone ";
        $queryParams = ['so_phone' => $sop];
        if($search !== null){
            $query .= "AND (p.barcode LIKE :search OR p.product_name LIKE :search) ";
            $queryParams['search'] = "%$search%";
        }
        
        if($sort === 'low')
            $query .= "AND s.quantity < s.low_stock_level ORDER BY s.quantity ASC";
        else
            $query .= "ORDER BY s.quantity - s.low_stock_level ".$sort;

        if ($offset !== null) 
            $query .= " LIMIT 10 OFFSET $offset";  // Inject the validated offset directly

        return $this->query($query,$queryParams);
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

    public function getStockLevel($barcode, $so_phone){
        $query = "SELECT quantity, non_preorderable_stock FROM so_stocks WHERE barcode = :barcode AND so_phone = :so_phone";
        return $this->query($query, ['barcode' => $barcode, 'so_phone' => $so_phone])[0];
    }
}