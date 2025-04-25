<?php

class ShopOrder extends Model
{
    protected $table = 'shop_orders';

    protected $readTable = 'shop_orders o INNER JOIN Shops s ON o.so_phone = s.so_phone';
    protected $fillable = ['date', 'time', 'so_phone', 'dis_phone', 'status'];

    public function search($search, $status, $offset, $dis_phone = null, $date = null) {
        $queryPara['so_phone'] = $_SESSION['shop_owner']['phone'];
        $query = "SELECT 
                    so.order_id,
                    so.dis_phone,
                    so.date,
                    so.time,
                    so.status,
                    d.dis_busines_name,
                    CONCAT(u.first_name, ' ', u.last_name) as full_name,
                    (SELECT SUM(soi.quantity * soi.sold_bulk_price) FROM (SELECT order_id, quantity, sold_bulk_price FROM shop_order_items UNION SELECT order_id, quantity, sold_bulk_price FROM shop_order_unique_items) AS soi WHERE soi.order_id = so.order_id) as total
                  FROM shop_orders so LEFT JOIN distributors d ON so.dis_phone = d.dis_phone
                  LEFT JOIN users u ON so.dis_phone = u.phone";
        
        if(!$dis_phone) {
            $query .= " WHERE so.so_phone = :so_phone AND (so.order_id LIKE :search OR d.dis_busines_name LIKE :search OR CONCAT(u.first_name, u.last_name) LIKE :search)";
            $queryPara['search'] = "%$search%";
        }
        else {
            $query .= " WHERE so.so_phone = :so_phone AND so.dis_phone = :dis_phone";
            $queryPara['dis_phone'] = $dis_phone;
        }
        
        if ($status != "all") {
            $query .= " AND so.status = :status";
            $queryPara['status'] = $status;
        }

        if($date) {
            $query .= " AND so.date = :date";
            $queryPara['date'] = $date;
        }
        $query .= " ORDER BY so.date DESC, so.time DESC LIMIT 10 OFFSET $offset";

        return $this->query($query, $queryPara);
    }

    public function monthlyTotla($month, $year) {
        $query = "  SELECT SUM(soi.quantity * p.bulk_price) as total
                    FROM shop_orders so 
                    INNER JOIN shop_order_items soi ON so.order_id = soi.order_id
                    INNER JOIN products p ON soi.barcode = p.barcode
                    WHERE MONTH(so.date) = :month AND YEAR(so.date) = :year
                    AND so.so_phone = :so_phone AND so.status = 'Delivered'";
        return $this->query($query, ['month' => $month, 'year' => $year, 'so_phone' => $_SESSION['shop_owner']['phone']])[0]['total'];
    }

    public function searchOrders($search = null, $so_phone = null, $date = null, $status = null) {
        $sql = "SELECT 
                *,
                (SELECT SUM(soi.quantity * soi.sold_bulk_price) FROM (SELECT order_id, quantity, sold_bulk_price FROM shop_order_items) AS soi WHERE soi.order_id = o.order_id) as total 
                FROM 
                shop_orders o
                INNER JOIN users u
                ON o.so_phone = u.phone
                INNER JOIN shops s
                ON o.so_phone = s.so_phone
                WHERE o.dis_phone = :dis_phone AND";

        $queryParam = ['dis_phone' => $_SESSION['distributor']['phone'], 'order_id' => $search];

        if($so_phone) {
            $sql .= " (o.order_id LIKE :order_id) AND o.so_phone = :so_phone";

            $queryParam['so_phone'] = $so_phone;
            $queryParam['order_id'] = "%$search%";
        }
        else{
            $sql .= " (o.so_phone LIKE :so_phone OR CONCAT(u.first_name,' ',u.last_name) LIKE :search 
                    OR s.shop_name LIKE :search
                    OR o.order_id = :order_id) 
                    AND o.dis_phone = :dis_phone";
            $queryParam['so_phone'] = $search;
            $queryParam['search'] = "%$search%";
        }

        if($date){
            $sql .= " AND o.date = :date";
            $queryParam['date'] = $date;
           }
       if($status) {
           $sql .= " AND o.status = :status";
           $queryParam['status'] = $status;
       }

        $sql.= " ORDER BY 
        CASE o.status
            WHEN 'Processing' THEN 1
            WHEN 'Pending' THEN 2
            WHEN 'Delivering' THEN 3
            WHEN 'Delivered' THEN 4
            ELSE 5
        END, 
        o.date DESC, o.time DESC";

        writeToFile($sql);
        return $this->query($sql, $queryParam);
    }

    
}