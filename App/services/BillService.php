<?php

class BillService extends Database
{
    public function addBill($cus_phone, $wallet_update, $preOrderItems = null, $con1 = null){
        $bill = new Bills();
        $billItems = new BillItems();
        $loyaltyCustomers = new LoyaltyCustomers();
        $shop = new Shops(); 

        $con = $con1 ?? $this->startTransaction(); //If null assing new conection
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.

        $bill->insert([
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['shop_owner']['phone']
        ], $con);

        $lastId = $this->lastId($con);

        $itemArray = $preOrderItems ?? $_SESSION['bill'];

        foreach ($itemArray as &$item) {
            $item['bill_id'] = $lastId;
        }

        unset($item);
        
        $billItems->bulkInsert($itemArray, ['barcode', 'sold_price', 'quantity', 'bill_id'], $con);
        $shop->updateCashDrawer($_SESSION['shop_owner']['phone'], $_SESSION['total']+$wallet_update, $con);
        if($wallet_update && $cus_phone)
            $loyaltyCustomers->updateWallet($cus_phone, $wallet_update, $con);

        if($con1) return;

        $this->commit( $con);
        return $lastId;
    }

    public function readBill($billId){
        $billItem = new BillItems;
        $Billdata['billItems'] = $billItem->where(['bill_id' => $billId]);
        $Billdata['total'] = 0;
        foreach($Billdata['billItems'] as &$item){
            $item['total'] += $item['sold_price'] * $item['quantity'];
        }
        unset($item);
        foreach($Billdata['billItems'] as $item){
            $Billdata['total'] += $item['total'];
        }
        return $Billdata;
    }
}