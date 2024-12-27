<?php

class Products extends Model
{

    protected $table = 'products';
    protected $fillable = ['barcode', 'product_name', 'unit_price', 'pic_format','man_phone'];

    public function searchProducts($search, $type, $offset)
    {
        $queryParam = [];
        $query = "SELECT * FROM $this->table ";
        
        if($search != null){
            $query .= "WHERE product_name LIKE :search OR barcode LIKE :search ";
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

}