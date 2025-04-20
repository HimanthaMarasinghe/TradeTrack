<?php

class BillService extends Database
{
    public function addBill($cus_phone, $wallet_update, $preOrderItems = null, $con1 = null){
        $bill = new Bills();
        $loyaltyCustomers = new LoyaltyCustomers();
        $shop = new Shops(); 

        $con = $con1 ?? $this->startTransaction(); //If null assing new conection
        //Transactions should be done using the same connection. Therefore, we pass the connection to the functions that need it.

        $bill->insert([
            'cus_phone' => $cus_phone,
            'so_phone' => $_SESSION['shop_owner']['phone']
        ], $con);

        $lastId = $con->lastInsertId();

        $itemArray = $preOrderItems ?? $_SESSION['bill'];

        $uniqueItems = array_values(array_filter($itemArray, function($item) {
            return $item['unique'] == 1;
        }));
        
        $itemArray = array_values(array_filter($itemArray, function($item) {
            return $item['unique'] == 0;
        }));

        // Remove 'unique' key
        $itemArray = array_map(function($item) use ($lastId) {
            $item['bill_id'] = $lastId;
            unset($item['unique']);
            unset($item['name']);
            return $item;
        }, $itemArray);

        $uniqueItems = array_map(function($item) use ($lastId) {
            $item['bill_id'] = $lastId;
            unset($item['unique']);
            unset($item['name']);
            return $item;
        }, $uniqueItems);

        writeToFile($itemArray, 'itemArray');
        writeToFile($uniqueItems, 'uniqueItems');

        if(count($itemArray) > 0) 
            (new BillItems)->bulkInsert($itemArray, ['barcode', 'sold_price', 'quantity', 'bill_id'], $con);

        if (count($uniqueItems) > 0) 
            (new BillUniqueProducts)->bulkInsert($uniqueItems, ['product_code', 'sold_price', 'quantity', 'bill_id'], $con);

        $shop->updateCashDrawer($_SESSION['shop_owner']['phone'], $_SESSION['total']+$wallet_update, $con);
        if($wallet_update && $cus_phone)
            $loyaltyCustomers->updateWallet($cus_phone, $wallet_update, $con);

        if($con1) return;

        if(!$preOrderItems){
            if(count($itemArray) > 0) (new ShopStock)->updateStockItems($itemArray, $con);
            if (count($uniqueItems) > 0) (new ShopUniqueProducts)->updateStockItems($uniqueItems, $con);
        }
        
        $con->commit();
        return $lastId;
    }

    public function readBill($billId){
        $Billdata['billItems'] = (new BillItems)->where(['bill_id' => $billId]) ?: [];
        $uniqueItems = (new BillUniqueProducts)->where(data: ['b.bill_id' => $billId], readFields:['bui.product_code', 'sui.product_name', 'bui.quantity', 'bui.sold_price'] );
        writeToFile($uniqueItems);
        if($uniqueItems[0]['product_code'] != null){
            $uniqueItems = array_map(function($item) {
                $item['barcode'] = 'x'.$item['product_code'];
                unset($item['product_code']);
                return $item;
            }, $uniqueItems);
            array_push($Billdata['billItems'], ...$uniqueItems);
        }
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

    public function getBillTotal($bill_id) {
        $sql = "SELECT SUM(sold_price * quantity) AS total
                FROM (
                    SELECT sold_price, quantity FROM bill_items WHERE bill_id = :bill_id
                    UNION ALL
                    SELECT sold_price, quantity FROM bill_unique_items WHERE bill_id = :bill_id
                ) AS combined";
        return $this->query($sql, ['bill_id' => $bill_id])[0]['total'];        
    }
}