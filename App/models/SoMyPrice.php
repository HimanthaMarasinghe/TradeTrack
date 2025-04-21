<?php

class SoMyPrice extends Model
{
    protected $table = 'so_my_price';
    protected $fillable = ['so_phone', 'barcode', 'price'];

    public function editMyPrice($newPrice, $so_phone, $barcode) {
        $query = "INSERT INTO $this->table 
                  (`so_phone`, `barcode`, `price`) 
                  VALUES (:so_phone, :barcode, :price)
                  ON DUPLICATE KEY UPDATE
                  price = VALUES(price)";
        return $this->query($query, ['so_phone' => $so_phone, 'barcode' => $barcode, 'price' => $newPrice]);
    }
}