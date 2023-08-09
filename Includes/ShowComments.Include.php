<?php 
include_once('../Classes/Model/DB.Class.php');
include_once('../Classes/Model/Comments.Class.php');
include_once('../Classes/View/CommentsView.Class.php');
include_once('../Classes/Model/Patients.Class.php');
include_once('../Classes/View/PatientsView.Class.php');
$comments = new CommentsView();

$doctor_id = $_POST['doctor_id'];
$limit = $_POST['limit'];

$patient_profile = new PatientView();
$results = $comments->FetchComments($doctor_id, $limit);
$size = $comments->FetchCommentsSize($doctor_id, $limit);
if($size > 0){           
    $counter = 0;
    while($counter < $size){
        $patient_id = $results[$counter]['patient_id'];
        $rate = $results[$counter]['rate'];
        $message = $results[$counter]['message'];
        
        echo "<div class='row px-3' align='start'>";
            echo "<div class='col-md-1 py-2'>";
            if($patient_profile->HasProfilePhoto($patient_id) == true){
                echo "<img src='ProfileUploads/Patients/profile";$patient_profile->FetchPhone($patient_id); echo "'.jpg' class='rounded py-1' width='35' height='35'>";
            }
            else{
                echo "<img src='img/doctorwoman.jpg' class='rounded py-1' width='35' height='35'>";
            }                    
            echo"</div>";
            echo "<div class='col-md-8 px-5'>";
                echo"<div class='row namesize'>";
                $patient_profile->FetchUsername($patient_id);
                echo"</div>";
                echo "<div class='row'>";
                    echo"<div class='col-md-5 px-1'>";
                        $rate_counter = 0;
                        while($rate_counter < $rate){
                            echo "<span class='fa fa-star checked'></span>";
                            $rate_counter++;
                        } 
                    echo "</div>";
                echo"</div>";
            echo"</div>";
            echo"<div>";
                echo $message;
            echo"</div>";
        echo"</div>"; 
        $counter++;
    }
}
    
