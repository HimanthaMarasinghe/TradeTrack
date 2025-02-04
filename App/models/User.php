<?php

class User extends Model
{

    protected $table = 'users';
    protected $fillable = ['phone', 'first_name','last_name', 'address', 'pic_format', 'role'];

    public function searchCustomers($search = null, $offset) {
        $query = "
            SELECT * 
            FROM $this->table
            WHERE phone LIKE :search OR
            CONCAT(first_name, ' ', last_name) LIKE :search 
            LIMIT 10 OFFSET $offset
        ";
        return $this->query($query, ['search' => "%$search%"]);
    }
}