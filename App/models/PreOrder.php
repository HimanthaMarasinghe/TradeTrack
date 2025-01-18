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
            $sql .= "AND p.status NOT IN ('Picked', 'Rejected') ";
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

        if ($offset)
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
                    u.address 
                FROM 
                    pre_order p INNER JOIN  users u 
                ON 
                    p.cus_phone = u.phone 
                WHERE 
                    p.pre_order_id = :pre_order_id AND p.so_phone = :so_phone";
        return $this->query($sql, [':pre_order_id' => $pre_order_id, ':so_phone' => $_SESSION['shop_owner']['phone']])[0];
    }   
}