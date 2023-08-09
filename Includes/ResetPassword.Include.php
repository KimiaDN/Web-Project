<?php 
include_once('../Config.php');

$password = $_POST['password'];
$repeat_password = $_POST['repeat-password'];
$selector = $_POST['selector'];
$validator = $_POST['validator'];

$reset_password = new ResetPasswordController("", "", "", "");
$reset_pwd_info = new ResetPasswordView();
$message = new Message();
$success = false;

$message = $reset_password->CheckUserAuthentication($selector, $validator);
if($message->GetMessageType()){
    $patient = new PatientController();
    $email = $reset_pwd_info->FetchEmail($selector);
    $message = $patient->ResetPatientPassword($email, $password, $repeat_password);
    if($message->GetMessageType()){
        $reset_password->RemoveResetPassword($email);
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
        header("Location: ../ResetPassword.php?message=success");
        exit();
    }else{
        ShowNotification($message->GetMessage(), 1, "450px", "50px");
    }
}else{
    ShowNotification($message->GetMessage(), 1, "450px", "50px");
}



