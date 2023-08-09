<?php 
session_start();
include_once('../Config.php');


//Get information from Post method
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_repeat = $_POST['repeat_password'];
$expertise = $_POST['expertise'];
$code = $_POST['code'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$description = $_POST['description'];
$doctor_id = $_POST['doctor_id'];

//Create an object of Doctor
$doctor = new DoctorController();
$doctor_info = new DoctorView();
$message = new Message();
$done = false;
$doctor->name = $name; 
$doctor->username = $username;
$doctor->password = $password;
$doctor->password_repeat = $password_repeat;
$doctor->expertise = $expertise;
$doctor->gender = "مرد";
$doctor->code = $code;
$doctor->email = $email;
$doctor->phone = $phone;
$doctor->address = $address;
$doctor->description = $description;

$message = $doctor->DoctorEditProfile($doctor_id);
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
            var name = "<?php $doctor_info->FetchName($_SESSION['user_id']); ?>";
            var username = "<?php $doctor_info->FetchUsername($_SESSION['user_id']); ?>";
            var code = "<?php $doctor_info->FetchCode($_SESSION['user_id']); ?>";
            var expertise = "<?php $doctor_info->FetchExpertise($_SESSION['user_id']); ?>";
            var phone = "<?php $doctor_info->FetchPhone($_SESSION['user_id']); ?>";
            var email = "<?php $doctor_info->FetchEmail($_SESSION['user_id']); ?>";
            var address = "<?php $doctor_info->FetchAddress($_SESSION['user_id']); ?>";
            var description = "<?php $doctor_info->FetchDescription($_SESSION['user_id']); ?>";
            $("#name").val(name);
            $("#username").val(username);
            $("#phone").val(phone);
            $("#email").val(email);
            $("#code").val(code);
            $("#expertise").val(expertise);
            $("#address").val(address);
            $("#description").val(description);
        }
        
    });
</script>

