<?php

class ProductModel extends Model
{
    // Function to add a new product to the database
    public function addProduct($barcode, $productName, $unitPrice, $picFormat)
    {
        $sql = "INSERT INTO products (barcode, product_name, unit_price, pic_format) 
                VALUES (:barcode, :product_name, :unit_price, :pic_format)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':barcode', $barcode);
        $stmt->bindParam(':product_name', $productName);
        $stmt->bindParam(':unit_price', $unitPrice);
        $stmt->bindParam(':pic_format', $picFormat);
        return $stmt->execute();
    }
}
