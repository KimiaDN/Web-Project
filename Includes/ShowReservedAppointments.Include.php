<?php 
include_once('../Config.php');

$appointmentInfo = new AppointmentController("", "", "", "", "");
$doctorInfo = new DoctorView();
$patientInfo = new PatientView();
$message = new Message();

$counter = 0;
$date = $_POST['reserved_date'];
$id = $_POST['doctor_id'];
$appointments = $appointmentInfo->GetDoctorReserveAppointments($id, $date);
$size = sizeof($appointments);

if($size == 0){
    $message->SetMessageType(false);
    $message->SetMessage('برای این تاریخ نوبتی رزرو نشده است');
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}

else{
    echo '<table class="table table-hover table-sm">';
        echo '<thead class="thead" align="center">';
            echo '<tr>';
                echo '<th scope="col">'.'نام پزشک'.'</th>';
                echo '<th scope="col">'.'زمان نوبت'.'</th>';
                echo '<th scope="col">'.'نام بیمار'.'</th>';
            echo '</tr>';
        echo '</thead>';
        echo '<tbody align="center">';
        while($counter < $size){ 

            $start_time = $appointments[$counter]["start"];
            $end_time = $appointments[$counter]["end"];
            $patient_id = $appointments[$counter]["patient_id"];
            $persian_date = GetPersianDate($date);
    
            echo '<tr>';
                echo'<td><span class="drName">';
                    $doctorInfo->FetchName($id);
                echo ' </span><br />';
                    $doctorInfo->FetchExpertise($id);
                echo '</td>';
                echo '<td>'. $persian_date .  '<br />'. 'ساعت '. $end_time . ' تا '. $start_time . '</td>';
                echo '<td class="bimarName">';
                    $patientInfo->FetchName($patient_id);
                echo '</td>';
            echo '</tr>';
            $counter++;
        }
    }
    
       echo'</tbody>';
    echo'</table>';