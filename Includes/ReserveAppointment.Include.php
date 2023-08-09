<?php 
session_start();
include_once("../Config.php");
$refresh = false;
$message = new Message();
if(isset($_SESSION['username']) == 1 && isset($_SESSION['user_id']) == 1){
    $patient_id = $_SESSION['user_id'];
    $appointment_id = $_POST['appointment_id'];
    $selected_date = $_POST['selected_date'];
    $appointment = new AppointmentController(0, '', '', '', '');
    $message = $appointment->Reserve((int)$appointment_id, $patient_id);
    if($message->GetMessageType()){
        ShowNotification($message->GetMessage(), 1, "450px", "50px");
        $selected_appointment = $appointment->GetAppointment($appointment_id);
        $doctor_id = $selected_appointment[0]["doctor_id"];
        $refresh = true;
    }
    else{
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }    
}
else{
    $message->SetMessage("لطفا اول وارد حساب کاربری خود شوید");
    ShowNotification($message->GetMessage(), 0, "450px", "50px");    
}

?>
<script src="jquery-3.6.4.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
</script>

<script>
    $(document).ready(function(){
        var refresh = <?php echo $refresh; ?>;
        if(refresh){
            var selected_date = "<?php echo $selected_date; ?>";
            var doctor_id =  "<?php echo $doctor_id; ?>";
            $("#show_nobat").load("Includes/ShowEmptyAppointmentForPatient.Include.php",
            {selected_date: selected_date, doctor_id: doctor_id});
        }                   
    });
</script>
 


    



