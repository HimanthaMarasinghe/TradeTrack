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

    public function getBillsTotal($month, $year) {
        $sql = "SELECT SUM(sold_price * quantity) as total FROM bill_items WHERE bill_id IN (SELECT bill_id FROM bills WHERE MONTH(date) = :month AND YEAR(date) = :year)";
        return $this->query($sql, ['month' => $month, 'year' => $year])[0]['total'];
    }

    public function getLastSixMonthTotal() {
        $sql = "SELECT 
                    SUM(sold_price * quantity) AS total, 
                    MONTH(date) AS month,
                    YEAR(date) AS year
                FROM bill_items 
                WHERE bill_id IN (
                    SELECT bill_id 
                    FROM bills 
                    WHERE date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                ) 
                GROUP BY YEAR(date), MONTH(date)";
        return $this->query($sql);
    }
    
}