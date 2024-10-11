<?php

class Bills extends Model
{

    protected $table = 'bills';
    protected $fillable = ['bill_id', 'cus_phone', 'so_phone'];

    function addBill($cus_phone = '111'){
        // $this->startTransaction();

        $this->insert([
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['so_phone']
        ]);

        $lastId = $this->lastId();

        $itemArray = $_SESSION['bill'];

        foreach ($itemArray as &$item) {
            $item['bill_id'] = $lastId;
        }

        unset($item);

        $_SESSION['itemArray'] = $itemArray;
        
        $billItems = new BillItems();
        $billItems->bulkInsert($itemArray);

        // $this->commit();
    }

}