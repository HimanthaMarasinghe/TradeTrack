<?php

class BillService extends Database
{
    function addBill($cus_phone, $wallet_update){
        $bill = new Bills();
        $billItems = new BillItems();
        $loyaltyCustomers = new LoyaltyCustomers();
        $shop = new Shops(); 

        $con = $this->startTransaction();
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.

        $bill->insert([
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['shop_owner']['phone']
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
        $shop->updateCashDrawer($_SESSION['shop_owner']['phone'], $_SESSION['total']+$wallet_update, $con);
        if($wallet_update && $cus_phone)
            $loyaltyCustomers->updateWallet($cus_phone, $wallet_update, $con);

        $this->commit( $con);
    }
}