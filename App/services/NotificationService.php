<?php

class NotificationService 
{
    public function sendNotification($phone, $type, $ref_id, $tite, $body, $link = null, $image = null)
    {
        if ($type !== 'chat') {
            $notification = new UserNotification;
            $notification->insertNotification(['phone' => $phone, 'type' => $type, 'ref_id' => $ref_id, 'title' => $tite, 'body' => $body, 'link' => $link]);
        }
        
        $socket = stream_socket_client("tcp://localhost:9000", $errno, $errstr, 2);
        if (!$socket) return;

        $data = ['type' => $type, 'ref_id' => $ref_id, 'title' => $tite, 'body' => $body, 'link' => $link, 'image' => $image];

        $notification = json_encode(["type" => "notification", "id" => $phone, "data" => json_encode($data)]);
        fwrite($socket, $notification);
        fread($socket, 1024);
        fclose($socket);
    }
}