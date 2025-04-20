<?php

class DistributorM extends Model
{

    protected $table = 'distributors';
    protected $readTable = 'distributors s INNER JOIN users u ON s.dis_phone = u.phone';
    protected $fillable = ['dis_phone', 'dis_busines_name', 'man_phone'];

    public function searchDistributors($search, $offset = null, $man_phone = null)
    {
        $sql = "SELECT * FROM $this->readTable WHERE (dis_phone LIKE :search OR dis_busines_name LIKE :search OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search)"; 
        $para['search'] = "%$search%";
        if($man_phone) {
            $sql .= " AND man_phone = :man_phone";
            $para['man_phone'] = $man_phone;
        }
        
        if ($offset)
            $sql .= " LIMIT 10 OFFSET $offset";

        return $this->query($sql, $para);
    }

    public function distributorsForProduct($offset, $search, $barcode) {
        $sql = "SELECT 
                    d.dis_busines_name,
                    d.dis_phone,
                    u.first_name,
                    u.last_name,
                    u.pic_format
                FROM distributors d 
                INNER JOIN distributor_stocks ds ON d.dis_phone = ds.dis_phone
                INNER JOIN users u ON d.dis_phone = u.phone
                WHERE ds.barcode = :barcode
                AND (d.dis_phone LIKE :search 
                    OR d.dis_busines_name LIKE :search OR 
                    CONCAT(u.first_name, ' ', u.last_name) LIKE :search)
                LIMIT 10 OFFSET $offset";
        return $this->query($sql, ['barcode' => $barcode, 'search' => "%$search%"]);
    }
}