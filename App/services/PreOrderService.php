<?php

class PreOrderService extends Database
{
    public function addPreOrder($cus_phone, $itemArray){
        $preOrder = new PreOrder();
        $preOrderItems = new PreOrderItems();
        $con = $this->startTransaction();
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.

        $preOrder->insert([
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['shop_owner']['phone'],
            'date_time' => date('Y-m-d H:i:s')
        ], $con);

        $lastId = $this->lastId($con);

        // $itemArray = $_SESSION['preOrder'];

        foreach ($itemArray as &$item) {
            unset($item['name']);
            unset($item['price']);
            $item['pre_order_id'] = $lastId;
        }

        unset($item);
        
        $preOrderItems->bulkInsert($itemArray, ['barcode', 'quantity', 'pre_order_id'], $con);

        $this->commit( $con);
    }
}