<?php

class BillService extends Database
{
    function addBill($cus_phone){
        $bill = new Bills();
        $billItems = new BillItems();        

        $con = $this->startTransaction();
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.

        $bill->insert([
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
        
        $billItems->bulkInsert($itemArray, ['barcode', 'quantity', 'bill_id'], $con);

        $this->commit( $con);
    }
}