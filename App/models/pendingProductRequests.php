<?php

class pendingProductRequests extends Model
{

    protected $table = 'pending_product_requests';
    // protected $readTable = 'distributors s INNER JOIN users u ON s.dis_phone = u.phone';
    protected $fillable = ['barcode', 'product_name', 'unit_price', 'bulk_price', 'pic_format', 'man_phone', 'proof_format'];

    public function search($search, $offset = null)
    {
        $sql = "SELECT 
                    p.*,
                    m.company_name
                FROM 
                    $this->table p INNER JOIN manufacturers m
                WHERE 
                    p.barcode LIKE :search OR 
                    p.product_name LIKE :search OR 
                    m.company_name LIKE :search";
        if($offset) $sql .= " LIMIT 10 OFFSET $offset";
        return $this->query($sql, ['search' => "%$search%"]);
    }

}