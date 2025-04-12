<?php

class Chat extends Controller
{

    private $manPhone = '0771111111';
    private $disPhone = '0372222690';

    public function getMessages() {

        $chatModel = new Chat_dis_man();
        $messages = $chatModel->getMessages($this->manPhone, $this->disPhone);
        
        echo json_encode($messages); 
    }
}