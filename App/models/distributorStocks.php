<?php

class DistributorStocks extends Model{
    protected $table = 'distributor_stocks';
    protected $readTable = 'distributor_stocks ds 
                            JOIN products p 
                            ON ds.barcode = p.barcode';
    
    protected $fillable = ['dis_phone', 'barcode', 'quantity'];

    public function getStockBarcodes($dis_phone){
        $sql = "SELECT p.barcode, p.pic_format FROM $this->readTable WHERE dis_phone = :dis_phone";
        return $this->query($sql, ['dis_phone' => $dis_phone]);
    }

    public function searchStocks($search = null){
        $sql = "SELECT * FROM 
                distributor_stocks d
                INNER JOIN users u
                ON d.dis_phone = u.phone
                INNER JOIN products p
                ON d.barcode = p.barcode
                WHERE 
                p.product_name LIKE :search 
                AND d.dis_phone = :dis_phone";
        return $this->query($sql, ['search' => "%$search%", 'dis_phone' => $_SESSION['distributor']['phone']]);
    }
  
    public function search($dis_phone, $search, $offset = 0) {
        $sql = "SELECT p.barcode, p.product_name, p.pic_format, p.bulk_price, ds.quantity 
                FROM $this->readTable 
                WHERE ds.dis_phone = :dis_phone AND (p.product_name LIKE :search OR p.barcode LIKE :search)
                LIMIT 10 OFFSET $offset";
        return $this->query($sql, ['dis_phone' => $dis_phone, 'search' => "%$search%"]);

    }
}