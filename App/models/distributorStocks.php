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
}