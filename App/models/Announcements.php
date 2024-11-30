<?php

class Announcements extends Model
{

    protected $table = 'announcements';
    protected $fillable = ['role', 'title', 'message', 'date', 'time'];

    public function readAll(){
        $query = "SELECT id, role, title, SUBSTRING(message, 1, 100) AS message, date, time FROM $this->table ORDER BY date DESC, time DESC";
        return $this->query($query);
    }

}