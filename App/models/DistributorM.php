<?php

class DistributorM extends Model
{

    protected $table = 'distributors';
    protected $readTable = 'distributors s INNER JOIN users u ON s.dis_phone = u.phone';
    protected $fillable = ['dis_phone', 'dis_busines_name', 'man_phone'];

    public function searchDistributors($search, $offset)
    {
        $sql = "SELECT * FROM $this->readTable WHERE dis_phone LIKE :search OR dis_busines_name LIKE :search OR CONCAT(u.first_name, ' ', u.last_name) LIKE :search LIMIT 10 OFFSET $offset";
        return $this->query($sql, ['search' => "%$search%"]);
    }
}