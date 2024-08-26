<?php

class ShopOwnerPost
{
    public function addBillItem()
    {
        if(isset($_POST['barcodeIn']))
        {
            $product = new Products;
            $item = $product->first(['barcode' => $_POST['barcodeIn']]);
            if($item)
            {
                echo json_encode($item);
            }
        }
    }
}