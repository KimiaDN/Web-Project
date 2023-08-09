<?php 
include_once('../Config.php');
session_start();

$message = new Message();
if(isset($_SESSION["user_id"])){
    $patient_id = $_SESSION['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $message = $_POST['message'];
    $rate = $_POST['rate'];

    $comment = new CommentsController($patient_id, $doctor_id, $message, $rate);
    $message = $comment->SubmitComment();
    if($message->GetMessageType()){
        ShowNotification($message->GetMessage(), 1, "450px", "50px");
    }else{
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }
}
else{
    $message->SetMessage("لطفا اول وارد حساب کاربری خود شوید");
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}

        
    
     




