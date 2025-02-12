<?php

class UserNotification extends Model
{

    protected $table = 'user_notificatoin';
    protected $fillable = ['phone', 'type', 'ref_id', 'title', 'body', 'link'];

    public function insertNotification($data)
    {
        $query = "INSERT INTO $this->table 
                  (phone, type, ref_id, title, body, link) 
                  VALUES (:phone, :type, :ref_id, :title, :body, :link)
                  ON DUPLICATE KEY UPDATE 
                  title = :title, body = :body, link = :link";
        return $this->query($query, $data);
    }
}