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

    public function getPreOrderItems($order_id, $shouldCheckStock = false){
        $preOrder['total'] = 0;
        $preOrder['items'] = [];
        $preOrder['shouldBeRejected'] = $shouldCheckStock;

        $preOrderItems = (new PreOrderItems)->where(['pre_order_id' => $order_id]);

        foreach($preOrderItems as &$item){
            $rowTotal = $item['po_unit_price'] * $item['quantity'];
            $item['row_total'] = number_format($rowTotal, 2);
            if($shouldCheckStock && $_SESSION['shop_owner']['phone']){
                $item['stock'] = (new ShopStock)->getStockLevel($item['barcode'], $_SESSION['shop_owner']['phone']);
            }
            $preOrder['items'][] = $item;
            $preOrder['total'] += $rowTotal;
        }
        unset($item);

        $preOrderUniqueItems = (new PreOrderUniqueItems)->where(data: ['p.pre_order_id' => $order_id]);
        foreach($preOrderUniqueItems as &$item){
            $item['barcode'] = "x".$item['product_code'];
            $item['stock']['quantity'] = $item['quantity'];
            $item['quantity'] = $item['po_quantity'];
            $rowTotal = $item['po_unit_price'] * $item['quantity'];
            $item['row_total'] = number_format($rowTotal, 2);
            $preOrder['items'][] = $item;
            $preOrder['total'] += $rowTotal;
        }
        unset($item);

        if($shouldCheckStock && $_SESSION['shop_owner']['phone']){
            foreach($preOrder['items'] as &$item){
                if($item['stock']['quantity'] > 0) $preOrder['shouldBeRejected'] = false; // If any item is in stock, set shouldBeRejected to false
                if($item['stock']['quantity'] < $item['quantity']) $preOrder['shouldBeUpdated'] = true; // If any item is out of stock, set shouldBeUpdated to true
            }
            unset($item);
            if($preOrder['shouldBeRejected']) $preOrder['shouldBeUpdated'] = false; // If all items are in stock, set shouldBeUpdated to false
        }

        $preOrder['total'] = number_format($preOrder['total'], 2);
        return $preOrder;
    }
}