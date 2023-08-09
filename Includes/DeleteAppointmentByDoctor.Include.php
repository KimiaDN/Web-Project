<?php 
include_once("../Config.php");
$appointment_id = $_POST['appointment_id'];
$selected_date = $_POST['selected_date'];
$doctor_id = $_POST['doctor_id'];
$refresh = false;
$appointment = new AppointmentController('', '', '', '', '');
$message = new Message();
$message = $appointment->RemoveAppointment($appointment_id);
if($message->GetMessageType()){
    ShowNotification($message->GetMessage(), 1, "450px", "50px");
     $refresh = true;
}else{
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
            $("#empty-form").load("Includes/ShowEmptyAppointments.Include.php",
            {empty_date: selected_date, doctor_id: doctor_id});
        }                   
    });
</script>
