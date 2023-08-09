<?php

include_once('../Config.php');


 
//Get information from Post method
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_repeat = $_POST['password_repeat'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
//$rules = $_POST['rules'];

$message = new Message();
$done = false;

//Create an object of Patient
$patient = new PatientController();
$patient->name = $name; 
$patient->username = $username;
$patient->password = $password;
$patient->repeat_password = $password_repeat;
$patient->gender = $gender;
$patient->email = $email;
$patient->phone = $phone;
$patient->photo = 0;

$message = $patient->PatientRegister();
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
            $("#name, #username, #password, #phone, #gender, #email").val("");
        }
        
    });
</script>

