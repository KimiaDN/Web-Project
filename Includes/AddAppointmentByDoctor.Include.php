<?php 
include_once("../Config.php");
session_start();
$finish = false;
$error = false;

$doctor_id = $_SESSION['user_id'];
$a_date = $_POST["selected_date"];
$day = date("l", strtotime($a_date));
$time_array = $_POST["time_array"];
$message = new Message();


$size = sizeof($time_array);
for($i = 0; $i<$size ; $i++){
    $start = ConvertNumberToTime($time_array[$i]);
    $end = ConvertNumberToTime($time_array[$i] + 0.5);
    $appointment = new AppointmentController($doctor_id, $day, $a_date, $start, $end);
    $message = $appointment->SetEmptyAppoinmet();
    if($message->GetMessageType() == false){
        ShowNotification($message->GetMessage(), 0, "450px", "80px");
        echo '</br>';
    }else{
        ShowNotification($message->GetMessage(), 1, "450px", "80px");
        echo '</br>';
    }
}
