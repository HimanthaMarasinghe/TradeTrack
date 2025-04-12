<?php

class Chat_dis_man extends Model
{
    protected $table = 'chat_dis_man';
    protected $fillable = ['message_id', 'dis_phone', 'man_phone', 'text', 'direction'];

    public function getMessages($man_phone, $dis_phone) {
        $sql = "SELECT * FROM $this->table WHERE man_phone = :man_phone AND dis_phone = :dis_phone";
        return $this->query($sql, ['man_phone' => $man_phone, 'dis_phone' => $dis_phone]);
    }

    public function sendMessage($man_phone, $dis_phone) {
        $sql = "INSERT INTO $this->table (`message_id`, `dis_phone`, `man_phone`, `text`, `direction`, `date`, `time`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
    }
}

