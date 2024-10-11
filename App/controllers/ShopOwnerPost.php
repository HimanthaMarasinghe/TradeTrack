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
                $_SESSION['LastBillItemBarcode'] = $_POST['barcodeIn'];
                $_SESSION['lastBillItemPrice'] = $item['unit_price'];
                echo json_encode($item);
            }
        }
    }

    public function addBillItemToSession()
    {
        if(isset($_POST['qty']))
        {
            if(!isset($_SESSION['bill']))
            {
                $_SESSION['bill'] = [];
            }

            $_SESSION['bill'][] = [
                'barcode' => $_SESSION['LastBillItemBarcode'],
                'qty' => $_POST['qty'],
            ];

            $_SESSION['total'] += $_SESSION['lastBillItemPrice'] * $_POST['qty'];
        }
    }
}