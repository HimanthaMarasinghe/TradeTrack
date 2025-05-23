<?php

class ShopProductsService extends Database
{
    public function searchProducts($search, $type, $offset, $so_phone = null)
    {

        $query = "SELECT * FROM
                    (SELECT 
                        `barcode`, 
                        `product_name`, 
                        `unit_price`, 
                        `pic_format`, 
                        null as 'so_phone',
                        null as 'shop_name', 
                        0 as 'unique' 
                    FROM products
                    UNION
                    SELECT 
                        `product_code`, 
                        `product_name`, 
                        `unit_price`, 
                        `pic_format`,
                        sup.so_phone,
                        `shop_name`, 
                        1 as 'unique' 
                    FROM shop_unique_products sup INNER JOIN shops s ON sup.so_phone = s.so_phone ";
        
        if($so_phone != null){
            $query .= "WHERE sup.so_phone = :so_phone";
            $queryParam = ["so_phone" => $so_phone];
        }

        $query .= ") AS shopProducts ";

        
        if($search != null){
            $query .= "WHERE (product_name LIKE :search OR barcode LIKE :search) ";
            $queryParam['search'] = "%$search%";
        }

        if($type != null){
            if($search != null){
                $query .= "AND ";
            }else{
                $query .= "WHERE ";
            }
            $query .= "type = :type ";
            $queryParam['type'] = $type;
        }

        $query .= "LIMIT 10 OFFSET $offset";

        return $this->query($query, $queryParam);
    }

    public function readStock($sop, $sort = 'DESC', $offset = null, $search = null, $preOrderable = 0){
        $query = "SELECT * FROM (
                    SELECT
                        s.so_phone,
                        p.barcode,
                        p.product_name,
                        COALESCE(m.price, p.unit_price) AS unit_price,
                        p.pic_format,
                        p.unit_type,
                        s.quantity,
                        s.low_stock_level,
                        s.pre_orderable_stock,
                        s.amount_alowed_per_pre_Order,
                        0 as 'unique' 
                    FROM products p RIGHT JOIN so_stocks s ON p.barcode = s.barcode
                    LEFT JOIN so_my_price m ON s.so_phone = m.so_phone AND p.barcode = m.barcode
                    UNION
                    SELECT
                        so_phone,
                        product_code,
                        product_name,
                        unit_price,
                        pic_format,
                        unit_type,
                        quantity,
                        low_stock_level,
                        pre_orderable_stock,
                        amount_alowed_per_pre_Order,
                        1 as 'unique' 
                    FROM shop_unique_products
                    ) AS shopStock WHERE so_phone = :so_phone ";


        $queryParams = ['so_phone' => $sop];
        if($search !== null){
            $query .= "AND (barcode LIKE :search OR product_name LIKE :search) ";
            $queryParams['search'] = "%$search%";
        }

        if($preOrderable == 1)
            $query .= "AND pre_orderable_stock > 0 AND amount_alowed_per_pre_Order > 0 ";

        if($sort === 'low')
            $query .= "AND quantity < low_stock_level ORDER BY quantity ASC ";
        else
            $query .= "ORDER BY quantity - low_stock_level ".$sort;

        if ($offset !== null) 
            $query .= " LIMIT 10 OFFSET $offset";  // Inject the validated offset directly
        return $this->query($query,$queryParams);
    }

    public function newProducts($so_phone, $offset = null, $search = null){
        $query = "SELECT p.*
                  FROM products p
                  LEFT JOIN so_stocks s ON p.barcode = s.barcode AND s.so_phone = :so_phone
                  WHERE s.so_phone IS NULL
                  AND (p.barcode LIKE :search OR p.product_name LIKE :search)
                  LIMIT 10 OFFSET $offset";
        return $this->query($query, ['so_phone' => $so_phone, 'search' => "%$search%"]);
    }

    public function getProduct($barcode, $so_phone){
        $query = "SELECT p.*, COALESCE(m.price, p.unit_price) AS unit_price FROM products p LEFT JOIN so_my_price m ON p.barcode = m.barcode AND m.so_phone = :so_phone WHERE p.barcode = :barcode";
        return $this->query($query, ['barcode' => $barcode, 'so_phone' => $so_phone])[0];
    }
}