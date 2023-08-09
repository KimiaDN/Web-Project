<?php 
include_once("../Config.php");
session_start();
$done = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_id = $_SESSION['user_id'];
    $type = $_SESSION['type'];
    $profile_image = $_FILES['profile_image'];

    $profileImage = new ProfileImageController($user_id);
    $patientInfo = new PatientView();
    $doctorInfo = new DoctorView();
    $message = new Message();

    if($type == 'doctor'){
        $code = $doctorInfo->GetchCode($user_id);
        $message = $mesaage = $profileImage->AddUserProfileImage($profile_image, $code, 'doctor');
        header("location: ../paneldoctor.php");
        exit();
    }
    elseif($type == 'patient'){
        $phone = $patientInfo->GetPhone($user_id);
        $message = $mesaage = $profileImage->AddUserProfileImage($profile_image, $phone, 'patient');
        header("location: ../panelbimar.php");
        exit();
    }
    
    

}

?>
<script>
    $(document).ready(function(){
        var done = "<?php echo $done; ?>";
        if(done){
            alert("h");
            window.open("../panelbimar.php");
        }
        
    });
</script>


