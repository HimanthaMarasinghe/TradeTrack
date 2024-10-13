<?php

class Bills extends Model
{

    protected $table = 'bills';
    protected $fillable = ['bill_id', 'cus_phone', 'so_phone'];

    function addBill($cus_phone){
        $con = $this->startTransaction();
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.

        $this->insert([
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['so_phone']
        ], $con);

        $lastId = $this->lastId($con);

        $itemArray = $_SESSION['bill'];

        foreach ($itemArray as &$item) {
            unset($item['name']);
            unset($item['price']);
            $item['bill_id'] = $lastId;
        }

        unset($item);
        
        $billItems = new BillItems();
        $billItems->bulkInsert($itemArray, ['barcode', 'quantity', 'bill_id'], $con);

        $this->commit( $con);
    }
}