<?php 
include_once("../Config.php");

$selected_date = $_POST["selected_date"];
$doctor_id = $_POST["doctor_id"];    
//$_SESSION['selected_date'] = $selected_date;
$message = new Message();
$appointment = new AppointmentController($doctor_id,"", $selected_date, "", "");
$appointmentInfo = new AppointmentView();
$empty_appointments = $appointment->GetEmptyAppointmentsList($doctor_id, $selected_date);
$size = sizeof($empty_appointments);
if($size > 0){
    $div_in_row = (int) ($size / 3);
    $remaining = $size % 3;
    $counter = 0; 
    while($counter < $size) { 
        //for($i = 0; $i < $div_in_row ; $i++){ 
            echo '<div class="row">';
            for($j=0; $j<3; $j++){ 
                if($counter == $size){
                    break;
                }
                $app_id = $empty_appointments[$counter]["id"];
                $start_time = $appointmentInfo->FetchStartTime($app_id);
                $end_time = $appointmentInfo->FetchEndTime($app_id);
                echo '<div class="col-md-4">'; 
                    echo '<div class="nobat">';
                        echo '<div class="row">';
                            echo '<div class="col-md-5">';
                                echo '<span class="form-control nobatsize">'.$start_time.'</span>';
                            echo '</div>';
                            echo '<div class="col-md-2">';
                                echo   'تا';
                            echo '</div>';
                            echo '<div class="col-md-5">';
                                echo '<span class="form-control nobatsize">'.$end_time.'</span>';
                            echo '</div>';
                        echo '</div>';
                        echo "<input type='submit' class='btn btn-success subBtn' onClick='ReserveBtn(this.id)' id='$app_id' value='رزرو' />";                   
                    echo '</div>';                     
                echo '</div>';                  
                $counter++;
            }                 
            echo '</div>';  
            echo '</br>';
        //}
        // echo '<div class="row">'; 
        // for($j=0; $j<$remaining; $j++){ 
        //     echo "tag2";
        //     $app_id = $empty_appointments[$counter]["id"];
        //     $start_time = $appointmentInfo->FetchStartTime($app_id);
        //     $end_time = $appointmentInfo->FetchEndTime($app_id);
        //     echo '<duv class="col-md-4">';
        //         echo '<div class="nobat">';
        //             echo '<div class="row">';
        //                 echo '<div class="col-md-5">';
        //                     echo '<span class="form-control nobatsize">'.$start_time.'</span>';
        //                 echo '</div>';
        //                 echo '<div class="col-md-2">';
        //                     echo   'تا';
        //                 echo '</div>';
        //                 echo '<div class="col-md-5">';
        //                     echo '<span class="form-control nobatsize">'.$end_time.'</span>';
        //                 echo '</div>';
        //             echo '</div>';
        //             echo "<input type='submit' class='btn btn-success subBtn' onClick='ReserveBtn(this.id)' id='$app_id' value='رزرو' />";
        //         echo '</div>';   
        //     echo '</div> ';                      
        //     $counter++;
        // } 
        // echo '</div>';
    }
}
else{ 
   $message->SetMessage("نوبت خالی در این تاریخ برای این پزشک تعریف نشده است");
   ShowNotification($message->GetMessage(), 0, "450px", "50px");
} 

?>




