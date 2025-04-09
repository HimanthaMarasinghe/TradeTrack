<?php

class ShopOrder extends Model
{
    protected $table = 'shop_orders';
    protected $fillable = ['date', 'time', 'so_phone', 'dis_phone'];

    public function search($search, $status, $offset) {
        $queryPara = [
            'so_phone' => $_SESSION['shop_owner']['phone'],
            'search' => "%$search%"
        ];
        $query = "SELECT 
                    so.order_id,
                    so.dis_phone,
                    so.date,
                    so.time,
                    so.status,
                    d.dis_busines_name,
                    u.pic_format,
                    CONCAT(u.first_name, ' ', u.last_name) as full_name
                  FROM shop_orders so INNER JOIN distributors d ON so.dis_phone = d.dis_phone
                  INNER JOIN users u ON so.dis_phone = u.phone
                  WHERE so.so_phone = :so_phone AND (so.order_id LIKE :search OR d.dis_busines_name LIKE :search OR CONCAT(u.first_name, u.last_name) LIKE :search)";

        if ($status != "all") {
            $query .= " AND so.status = :status";
            $queryPara['status'] = $status;
        }

        $query .= " ORDER BY so.date DESC, so.time DESC LIMIT 10 OFFSET $offset";

        return $this->query($query, $queryPara);
    }
}