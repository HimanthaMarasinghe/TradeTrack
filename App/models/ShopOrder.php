<?php

class ShopOrder extends Model
{
    protected $table = 'shop_orders';
    protected $fillable = ['date', 'time', 'so_phone', 'dis_phone'];

    public function search($search, $status, $offset, $dis_phone = null, $date = null) {
        $queryPara['so_phone'] = $_SESSION['shop_owner']['phone'];
        $query = "SELECT 
                    so.order_id,
                    so.dis_phone,
                    so.date,
                    so.time,
                    so.status,
                    d.dis_busines_name,
                    u.pic_format,
                    CONCAT(u.first_name, ' ', u.last_name) as full_name,
                    (SELECT SUM(soi.quantity * p.bulk_price) FROM shop_order_items soi INNER JOIN products p ON soi.barcode = p.barcode WHERE soi.order_id = so.order_id) as total
                  FROM shop_orders so INNER JOIN distributors d ON so.dis_phone = d.dis_phone
                  INNER JOIN users u ON so.dis_phone = u.phone";
        
        if(!$dis_phone) {
            $query .= " WHERE so.so_phone = :so_phone AND (so.order_id LIKE :search OR d.dis_busines_name LIKE :search OR CONCAT(u.first_name, u.last_name) LIKE :search)";
            $queryPara['search'] = "%$search%";
            if ($status != "all") {
                $query .= " AND so.status = :status";
                $queryPara['status'] = $status;
            }
        }
        else {
            $query .= " WHERE so.so_phone = :so_phone AND so.dis_phone = :dis_phone";
            $queryPara['dis_phone'] = $dis_phone;
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
}