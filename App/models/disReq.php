<?php

class disReq extends Model
{
    protected $table = 'dis_req';

    protected $readTable = 'dis_req o
                            INNER JOIN distributors d
                            ON o.dis_phone = d.dis_phone
                            INNER JOIN users u
                            ON d.dis_phone = u.phone';

    public function searchReq($search, $man_phone)
    {
        $query = "SELECT * FROM $this->readTable WHERE o.man_phone = :man_phone AND (CONCAT(u.first_name,' ',u.last_name) LIKE :search OR d.dis_busines_name LIKE :search OR d.dis_phone LIKE :search)";
        $queryParm = ['man_phone' => $man_phone, 'search' => "%$search%"];
        
        return $this->query($query, $queryParm);
    }
}