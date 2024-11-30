<?php

class BillItems extends Model
{

    protected $table = 'bill_items';
    protected $readTable = 'bill_items JOIN products ON bill_items.barcode = products.barcode';
    protected $fillable = ['bill_id', 'barcode', 'quantity'];

    public function getBillTotal($bill_id) {
        $sql = "SELECT SUM(products.unit_price * bill_items.quantity) as total
                FROM bill_items JOIN products ON bill_items.barcode = products.barcode
                WHERE bill_items.bill_id = :bill_id";
        return $this->query($sql, ['bill_id' => $bill_id])[0]['total'];        
    }
}