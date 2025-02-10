<?php

class UserNotification extends Model
{

    protected $table = 'user_notificatoin';
    protected $fillable = ['phone', 'type', 'ref_id', 'title', 'body', 'link'];

    public function getCount($phone)
    {
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE phone = :phone";
        return $this->query($query, ['phone' => $phone])[0]["count"];
    }
}