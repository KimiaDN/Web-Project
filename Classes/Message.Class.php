<?php 
class Message{

    public $type;
    public $message;

    public function SetMessageType($type){
        $this->type = $type;
    }

    public function SetMessage($message){
        $this->message = $message;
    }
    
    public function GetMessageType(){
        return $this->type;
    }

    public function GetMessage(){
        return $this->message;
    }
}