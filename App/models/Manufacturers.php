<?php

class Manufacturers extends Model
{

    protected $table = 'manufacturers';
    protected $readTable = 'manufacturers s INNER JOIN users u ON s.man_phone = u.phone';
    protected $fillable = ['man_phone', 'company_name', 'company_address'];

    public function search($search, $offset)
    {
        $sql = "SELECT * FROM $this->readTable WHERE man_phone LIKE :search OR company_name LIKE :search OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search LIMIT 10 OFFSET $offset";
        return $this->query($sql, ['search' => "%$search%"]);
    }

    public function searchManufacturers($search, $dis_phone){

        $sql = "SELECT * FROM $this->readTable WHERE (s.man_phone LIKE :search 
                    OR s.company_name LIKE :search 
                    OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search)
                    AND man_phone NOT IN (SELECT man_phone FROM dis_req WHERE dis_phone = :dis_phone)";


        return $this->query($sql, ['search' => "%$search%", 'dis_phone' => $dis_phone]);
    }

    public function searchRequestedManufacturers($search,$dis_phone){
        $sql = "SELECT * 
                FROM $this->readTable 
                INNER JOIN dis_req dr ON s.man_phone = dr.man_phone
                WHERE (s.man_phone LIKE :search 
                    OR s.company_name LIKE :search 
                    OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search)
                    AND dr.dis_phone = :dis_phone";


        return $this->query($sql, ['search' => "%$search%",'dis_phone' => $dis_phone]);
    }
}