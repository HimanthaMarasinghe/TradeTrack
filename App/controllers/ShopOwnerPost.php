<?php

class ShopOwnerPost extends Controller
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
                $_SESSION['LastBillItemName'] = $item['product_name'];
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

            $alreadyInBill = false;
            foreach ($_SESSION['bill'] as &$item) {
                if($item['barcode'] == $_SESSION['LastBillItemBarcode'])
                {
                    $alreadyInBill = true;
                    $item['qty'] += $_POST['qty'];
                }
            }

            if(!$alreadyInBill){
                $_SESSION['bill'][] = [
                    'barcode' => $_SESSION['LastBillItemBarcode'],
                    'name' => $_SESSION['LastBillItemName'],
                    'price' => $_SESSION['lastBillItemPrice'],
                    'qty' => $_POST['qty'],
                ];
            }

            $_SESSION['total'] += $_SESSION['lastBillItemPrice'] * $_POST['qty'];

            echo json_encode(['bill' => $_SESSION['bill'], 'total' => $_SESSION['total']]);
        }
    }
}