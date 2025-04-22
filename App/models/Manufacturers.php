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

    // public function getManufacturers()
    // {
    //     $sql = "SELECT * FROM $this->readTable";
    //     return $this->query($sql);
    // }
}