<?php 

include_once('../Config.php');
$appointment_id = $_POST['appointment_id'];
$appointment = new AppointmentController("", "", "", "", "");
$message = new Message();
$message = $appointment->Cancle($appointment_id);
if($message->GetMessageType() == false){
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}
