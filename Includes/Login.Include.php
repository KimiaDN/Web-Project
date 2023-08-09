<?php
//session_start();
include_once('../Config.php');


$username = $_POST['username'];
$password = $_POST['password'] ;

$doctor = new DoctorController();
$message = new Message();
$doctor->username = $username;
$doctor->password = $password;
$message = $doctor->UsersLogin();
if($message->GetMessageType() == false){
    $patient = new PatientController();
    $patient->username = $username;
    $patient->password = $password;
    $message = $patient->PatientLogin();
    if($message->GetMessageType() == false){
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }
    else{
        ShowNotification($message->GetMessage(), 1, "450px", "50px");
        sleep(3);
    }
    
}
else{
    ShowNotification($message->GetMessage(), 1, "450px", "50px");
    sleep(3);
}




