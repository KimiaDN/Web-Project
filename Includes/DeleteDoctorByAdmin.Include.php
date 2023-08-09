<?php 
include_once('../Config.php');


//Get information from Post method
$doctor_id = $_POST['doctor_id'];
$name = $_POST['doctor_name'];


//Create an object of Doctor
$doctor = new DoctorController();
$doctor_info = new DoctorView();
$message = new Message();
$done = false;

$message = $doctor->DeleteDoctor($doctor_id);
if($message->GetMessageType()){
    ShowNotification($message->GetMessage(), 1, "450px", "50px");
    $done = true;
}
else{
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}

?>

<script>
    $(document).ready(function(){
        var done = "<?php echo $done; ?>";
        if(done){
            var name = "<?php echo $name; ?>";
            $("#show-doctor-list").load("Includes/SuggestDoctorForAdmin.Include.php",
            {doctor_name: name});	
        }        
    });
</script>

