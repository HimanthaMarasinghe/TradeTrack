<?php

class PreOrder extends Model
{
    protected $table = 'pre_order';
    protected $fillable = ['cus_phone', 'so_phone', 'pre_order_id', 'date_time', 'status'];

    public function allPreOrdersForShopOwner($so_phone)
    {
        $sql = "SELECT p.cus_phone, p.pre_order_id, p.date_time, u.first_name, u.last_name, u.pic_format FROM pre_order p INNER JOIN users u ON p.cus_phone = u.phone WHERE p.so_phone = :so_phone AND p.status = 'Pending'";
        return $this->query($sql, [':so_phone' => $so_phone]);
    }

    public function preOrderDetailsForShopOwner($pre_order_id)
    {
        $sql = "SELECT p.cus_phone, p.pre_order_id, p.date_time, p.status, u.first_name, u.last_name, u.pic_format, u.address FROM pre_order p INNER JOIN users u ON p.cus_phone = u.phone WHERE p.pre_order_id = :pre_order_id";
        return $this->query($sql, [':pre_order_id' => $pre_order_id]);
    }   
}