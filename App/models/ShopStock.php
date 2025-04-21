<?php

class ShopStock extends Model
{

    protected $table = 'so_stocks';
    protected $fillable = ['barcode', 'so_phone', 'quantity', 'low_stock_level', 'pre_orderable_stock', 'amount_alowed_per_pre_Order'];

    public function readStock($sop, $sort = 'DESC', $offset = null, $search = null, $preOrderable = 0){
        $query = "SELECT * FROM products p JOIN so_stocks s ON p.barcode = s.barcode WHERE s.so_phone = :so_phone ";
        $queryParams = ['so_phone' => $sop];
        if($search !== null){
            $query .= "AND (p.barcode LIKE :search OR p.product_name LIKE :search) ";
            $queryParams['search'] = "%$search%";
        }

        if($preOrderable == 1)
            $query .= "AND s.pre_orderable_stock > 0 ";

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

    public function updateStock($barcode, $so_phone, $quantity, $con = null){
        $query =   "INSERT INTO so_stocks (barcode, so_phone, quantity, pre_orderable_stock) 
                    VALUES (:barcode, :so_phone, :quantity, :quantity)
                    ON DUPLICATE KEY UPDATE 
                    quantity = quantity + VALUES(quantity),
                    pre_orderable_stock = pre_orderable_stock + VALUES(quantity)";
        return $this->query($query, ['barcode' => $barcode, 'so_phone' => $so_phone, 'quantity' => $quantity], $con);
    }

    public function updatePreOrderableStock($barcode, $so_phone, $quantity, $con = null){
        $query =   "UPDATE so_stocks 
                    SET pre_orderable_stock = pre_orderable_stock + :quantity
                    WHERE barcode = :barcode AND so_phone = :so_phone";
        return $this->query($query, ['barcode' => $barcode, 'so_phone' => $so_phone, 'quantity' => $quantity], $con);
    }

    public function updateStockItems($items, $con, $so_phone = null) {
        if ($so_phone === null) $so_phone = $_SESSION['shop_owner']['phone'];
        $params = [];
        $query =   "INSERT INTO so_stocks (barcode, so_phone, quantity, pre_orderable_stock) 
                    VALUES ";
        foreach($items as &$item) {
            $query .= "(?, ?, ?, ?),";
            array_push($params, $item['barcode'], $so_phone, -1*$item['qty'], -1*$item->qty);
        }
        $query = rtrim($query, ",");
        $query .=  " ON DUPLICATE KEY UPDATE 
                    quantity = quantity + VALUES(quantity),
                    pre_orderable_stock = pre_orderable_stock + VALUES(quantity)";

        return $this->query($query, $params, $con);
    }

    public function updatePreOrderableStockItems($items, $so_phone = null, $con = null) {
        if ($so_phone === null) $so_phone = $_SESSION['so_phone'];
        foreach($items as $item) {
            $this->updatePreOrderableStock($item['barcode'], $so_phone, -1*$item['quantity'], $con);
        }
    }

    public function updatePreOrderableStockByOrder($order_id, $con = null, $increase = false){
        $query = "UPDATE so_stocks s SET s.pre_orderable_stock =";
        if($increase) $query .= " s.pre_orderable_stock + (SELECT quantity FROM pre_order_items WHERE pre_order_id = :order_id AND barcode = s.barcode)";
        else $query .= " s.pre_orderable_stock - (SELECT quantity FROM pre_order_items WHERE pre_order_id = :order_id AND barcode = s.barcode)";
        $query .= " WHERE s.barcode IN (SELECT barcode FROM pre_order_items WHERE pre_order_id = :order_id)";
        return $this->query($query, ['order_id' => $order_id], $con);
    }

    public function updateStockOnPreOrder($order_id, $con = null, $increase = false){
        $query = "UPDATE so_stocks s SET s.quantity =";
        if($increase) $query .= " s.quantity + (SELECT quantity FROM pre_order_items WHERE pre_order_id = :order_id AND barcode = s.barcode)";
        else $query .= " s.quantity - (SELECT quantity FROM pre_order_items WHERE pre_order_id = :order_id AND barcode = s.barcode)";
        $query .= " WHERE s.barcode IN (SELECT barcode FROM pre_order_items WHERE pre_order_id = :order_id)";
        return $this->query($query, ['order_id' => $order_id], $con);
    }

    public function getStockLevel($barcode, $so_phone){
        $query = "SELECT quantity FROM so_stocks WHERE barcode = :barcode AND so_phone = :so_phone";
        return $this->query($query, ['barcode' => $barcode, 'so_phone' => $so_phone])[0];
    }

    public function updateStockDetail($so_phone, $barcode, $low_stock_level, $aapp) {
        $query = "INSERT INTO $this->table 
                  (`so_phone`, `barcode`, `quantity`, `low_stock_level`, `pre_orderable_stock`, `amount_alowed_per_pre_Order`) 
                  VALUES
                  (:so_phone, :barcode, 0, :low_stock_level, 0, :aapp)
                  ON DUPLICATE KEY UPDATE
                  low_stock_level = VALUES(low_stock_level),
                  amount_alowed_per_pre_Order = VALUES(amount_alowed_per_pre_Order)";
        return $this->query($query, [
            'so_phone' => $so_phone,
            'barcode' => $barcode,
            'low_stock_level' => $low_stock_level,
            'aapp' => $aapp
        ]);
    }
}