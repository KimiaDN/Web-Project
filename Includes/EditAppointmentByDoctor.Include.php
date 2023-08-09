<?php 

$appointment_id = $_POST['appointment_id'];
$new_start = $_POST['start'];
$new_end = $_POST['end'];

include_once("../Config.php");
$appointment = new AppointmentController('', '', '', '', '');
$appointmentInfo = new AppointmentView();
$message = new Message();
$error = false;
$message = $appointment->EditAppointment($appointment_id, $new_start, $new_end);
if($message->GetMessageType() == false){
    $error = true;
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}
else{
    ShowNotification($message->GetMessage(), 1, "450px", "50px");
}
?>

<script src="jquery-3.6.4.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" 
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
    crossorigin="anonymous">
</script>

 <script>
        var error = "<?php echo $error; ?>";
        if(error == true){

            var start_time = "<?php echo $appointmentInfo->FetchStartTime($appointment_id) ?>";
            var end_time = "<?php echo $appointmentInfo->FetchEndTime($appointment_id) ?>";

            var starts = document.getElementsByClassName("start");
            var ends = document.getElementsByClassName("end");
            var clicked_id = "<?php echo $appointment_id; ?>";
            
            for(var i = 0; i < starts.length; i++) {
                
                if(starts[i].id == clicked_id){
                    starts[i].value = start_time;
                    break;
                }                       
            }
            for(var i = 0; i < ends.length; i++) {
                
                if(ends[i].id == clicked_id){
                    ends[i].value = end_time;
                    break;
                }                       
            }
            
        }
    
</script>



