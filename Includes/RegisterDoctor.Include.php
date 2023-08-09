<?php
session_start();
include_once('../Config.php');

$doctor = new DoctorController();
$message = new Message();
$done = false;
//Get information from Post method
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];
$expertise = $_POST['expertise'];
$gender = $_POST['gender'];
$code = $_POST['code'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

//Create an object of Doctor
$doctor->name = $name; 
$doctor->username = $username;
$doctor->password = $password;
$doctor->password_repeat = $password_repeat;
$doctor->expertise = $expertise;
$doctor->gender = $gender;
$doctor->code = $code;
$doctor->email = $email;
$doctor->phone = $phone;
$doctor->address = $address;

$message = $doctor->DoctoeRegister();
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
            $("#name, #username, #password, #repeat_password, #phone, #gender, #email, #address, #code, #expertise").val("");
        }
        
    });
</script>


