<?php

class ShopUniqueProducts extends Model
{

    protected $table = 'shop_unique_products';
    protected $fillable = ['so_phone', 'product_code', 'product_name', 'unit_price', 'pic_format', 'unit_type', 'quantity', 'pre_orderable_stock', 'low_stock_level', 'amount_alowed_per_pre_Order'];


    public function updateStock($product_code, $so_phone, $quantity, $con = null){
        $query =   "UPDATE $this->table SET quantity = quantity + :quantity,
                    pre_orderable_stock = pre_orderable_stock + :quantity
                    WHERE product_code = :product_code AND so_phone = :so_phone";
        return $this->query($query, ['product_code' => $product_code, 'so_phone' => $so_phone, 'quantity' => $quantity], $con);
    }

    public function updateStockItems($items, $con, $so_phone = null) {
        if ($so_phone === null) $so_phone = $_SESSION['shop_owner']['phone'];
        $params = [];
        $query =   "INSERT INTO shop_unique_products (product_code, so_phone, quantity, pre_orderable_stock) 
                    VALUES ";

        foreach ($items as $item) {
            $query .= "(?, ?, ?, ?),";
            array_push($params, $item['barcode'], $so_phone, -1*$item['qty'], -1*$item->qty);
        }
        $query = rtrim($query, ",");
        $query .= " ON DUPLICATE KEY UPDATE 
                    quantity = quantity + VALUES(quantity),
                    pre_orderable_stock = pre_orderable_stock + VALUES(quantity)";
        
         return $this->query($query, $params, $con);
    }
}