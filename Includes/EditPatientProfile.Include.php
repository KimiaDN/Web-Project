<?php 
session_start();
include_once('../Config.php');


//Get information from Post method
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_repeat = $_POST['repeat_password'];
$email = $_POST['email'];
$phone = $_POST['phone'];

//Create an object of Doctor
$patient = new PatientController();
$patient_info = new PatientView();
$message = new Message();
$done = false;
$patient->name = $name; 
$patient->username = $username;
$patient->password = $password;
$patient->repeat_password = $password_repeat;
$patient->gender = "مرد";
$patient->email = $email;
$patient->phone = $phone;

$message = $patient->PatientEditProfile($_SESSION['user_id']);
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
            var name = "<?php $patient_info->FetchName($_SESSION['user_id']); ?>";
            var username = "<?php $patient_info->FetchUsername($_SESSION['user_id']); ?>";
            var phone = "<?php $patient_info->FetchPhone($_SESSION['user_id']); ?>";
            var email = "<?php $patient_info->FetchEmail($_SESSION['user_id']); ?>";
            $("#name").val(name);
            $("#username").val(username);
            $("#phone").val(phone);
            $("#email").val(email);
        }
        
    });
</script>

