<?php

class PreOrder extends Model
{
    protected $table = 'pre_order';
    protected $fillable = ['cus_phone', 'so_phone', 'pre_order_id', 'date_time', 'status'];

    public function allPreOrdersForShopOwner($so_phone, $status = null, $search = null, $offset = null)
    {
        $queryParam = [':so_phone' => $so_phone];
        $sql = "SELECT 
                    p.cus_phone, 
                    p.pre_order_id, 
                    p.date_time, 
                    p.status, 
                    u.first_name, 
                    u.last_name, 
                    u.pic_format
                FROM 
                    pre_order p
                INNER JOIN 
                    users u 
                ON 
                    p.cus_phone = u.phone
                WHERE 
                    p.so_phone = :so_phone ";

        if (!$status) 
            $sql .= "AND p.status NOT IN ('Picked', 'Rejected', 'Canceled') ";
        else if ($status !== 'all') {
            $sql .= "AND p.status = :status ";
            $queryParam[':status'] = $status;
        }

        if ($search) {
            $sql .= "AND (CONCAT(u.first_name, ' ', u.last_name) LIKE :search OR p.pre_order_id LIKE :search) ";
            $queryParam[':search'] = "%$search%";
        }

        $sql.= "ORDER BY 
                CASE p.status
                    WHEN 'Processing' THEN 1
                    WHEN 'Pending' THEN 2
                    WHEN 'Updated' THEN 3
                    WHEN 'Ready' THEN 4
                    WHEN 'Picked' THEN 5
                    ELSE 6
                END, 
                p.date_time DESC ";

        if ($offset !== null)
            $sql .= "LIMIT 10 OFFSET $offset";

        return $this->query($sql, $queryParam);
    }

    public function preOrderDetailsForShopOwner($pre_order_id)
    {
        $sql = "SELECT 
                    p.cus_phone, 
                    p.pre_order_id, 
                    p.date_time, 
                    p.status, 
                    u.first_name, 
                    u.last_name, 
                    u.pic_format, 
                    u.address,
                    lc.wallet
                FROM 
                    pre_order p INNER JOIN  users u 
                ON 
                    p.cus_phone = u.phone 
                INNER JOIN 
                    loyalty_customers lc 
                ON 
                    p.cus_phone = lc.cus_phone AND p.so_phone = lc.so_phone
                WHERE 
                    p.pre_order_id = :pre_order_id AND p.so_phone = :so_phone
                LIMIT 1";
        return $this->query($sql, [':pre_order_id' => $pre_order_id, ':so_phone' => $_SESSION['shop_owner']['phone']])[0];
    }

    public function allPreOrdersForCusotmers($cus_phone, $status = null, $search = null, $offset = null)
    {
        $queryParam = [':cus_phone' => $cus_phone];
        $sql = "SELECT 
                    p.so_phone, 
                    p.pre_order_id, 
                    p.date_time, 
                    p.status,
                    s.shop_name,
                    s.shop_pic_format
                FROM 
                    pre_order p
                INNER JOIN 
                    shops s
                ON 
                    p.so_phone = s.so_phone
                WHERE 
                    p.cus_phone = :cus_phone ";

        if (!$status) 
            $sql .= "AND p.status NOT IN ('Picked', 'Rejected', 'Canceled') ";
        else if ($status !== 'all') {
            $sql .= "AND p.status = :status ";
            $queryParam[':status'] = $status;
        }

        if ($search) {
            $sql .= "AND (s.shop_name LIKE :search OR p.pre_order_id LIKE :search) ";
            $queryParam[':search'] = "%$search%";
        }

        $sql.= "ORDER BY 
                CASE p.status
                    WHEN 'Updated' THEN 1
                    WHEN 'Ready' THEN 2
                    WHEN 'Processing' THEN 3
                    WHEN 'Pending' THEN 4
                    WHEN 'Picked' THEN 5
                    ELSE 6
                END, 
                p.date_time DESC ";

        if ($offset !== null)
            $sql .= "LIMIT 10 OFFSET $offset";

        return $this->query($sql, $queryParam);
    }

    public function preOrderDetailsForCustomer($pre_order_id)
    {
        $sql = "SELECT 
                    p.so_phone, 
                    p.pre_order_id, 
                    p.date_time, 
                    p.status, 
                    s.shop_name,
                    s.shop_address,
                    s.shop_pic_format,
                    u.first_name,
                    u.last_name
                FROM 
                    pre_order p INNER JOIN  shops s ON p.so_phone = s.so_phone 
                    INNER JOIN users u ON p.so_phone = u.phone
                WHERE 
                    p.pre_order_id = :pre_order_id AND p.cus_phone = :cus_phone
                LIMIT 1";
        return $this->query($sql, [':pre_order_id' => $pre_order_id, ':cus_phone' => $_SESSION['customer']['phone']])[0];
    }
}