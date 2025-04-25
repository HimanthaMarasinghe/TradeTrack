<?php

class Chat extends Model
{
    protected $table = 'chat';
    protected $fillable = ['c_from', 'c_to', 'text', 'date', 'time'];

    public function getMessages($firstPerson, $secondPerson) {
        $sql = "SELECT * FROM $this->table WHERE (c_from = :firstPerson AND c_to = :secondPerson) OR (c_from = :secondPerson AND c_to = :firstPerson) ORDER BY date, time";
        $chat = $this->query($sql, ['firstPerson' => $firstPerson, 'secondPerson' => $secondPerson]);
        foreach ($chat as &$c) {
            if ($c['c_from'] == $firstPerson) $c['direction'] = 'outgoing';
            else $c['direction'] = 'incoming';
        }
        return $chat;
    }

    public function sendMessage($from, $to, $message) {
        $sql = "INSERT INTO $this->table (c_from, c_to, text) VALUES (:c_from, :c_to, :text)";
        $this->query($sql, ['c_from' => $from, 'c_to' => $to, 'text' => $message]);
    }
}

