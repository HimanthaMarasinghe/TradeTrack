<?php

class StockService extends Database
{
    public function updateStockItems($items) {
        $stock = new ShopStock;
        $con = $stock->startTransaction();
        foreach($items as $item) {
            $stock->updateStock($item['barcode'], $_SESSION['shop_owner']['phone'], -1*$item['qty'], $con);
        }
        $stock->commit($con);
    }
}