<?php

class BillItems extends Model
{

    protected $table = 'bill_items';
    protected $readTable = 'bill_items JOIN products ON bill_items.barcode = products.barcode';
    protected $fillable = ['bill_id', 'sold_price', 'barcode', 'quantity'];

    public function getBillTotal($bill_id) {
        $sql = "SELECT SUM(sold_price * quantity) as total
                FROM bill_items WHERE bill_id = :bill_id";
        return $this->query($sql, ['bill_id' => $bill_id])[0]['total'];        
    }
}