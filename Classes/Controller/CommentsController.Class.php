<?php 
include_once("C:\wamp64\www\Final Project\Classes\Message.Class.php");
class CommentsController extends Comments{

    public $patient_id;
    public $doctor_id;
    public $message;
    public $rate;

    public function __construct($patient_id, $doctor_id, $message, $rate){
        $this->patient_id = $patient_id;
        $this->doctor_id = $doctor_id;
        $this->message = $message;
        $this->rate = $rate;
    }

    
    public function SubmitComment(){
        $message = new Message();
        if(!empty($this->message)){
            $result = $this->AddComment($this->patient_id, $this->doctor_id, $this->message, $this->rate);
            if($result){
                $message->SetMessageType(true);
                $message->SetMessage("ثبت نظر با موفقیت انجام شد");
            }
            else{
                $message->SetMessageType(false);
                $message->SetMessage("خطایی در ثبت نظر رخ داده است");
            }
        }else{
            $message->SetMessageType(false);
            $message->SetMessage("لطفا نظر خود را ثبت کنید");
        }
        
        return $message;
    }
}