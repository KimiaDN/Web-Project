<?php 
include_once('../Config.php');

$doctor_name = $_POST['doctor_name'];

$appointment = new AppointmentController("", "", "", "", "");
$doctor = new DoctorController();
$doctorInfo = new DoctorView();
$patientInfo = new PatientView();
$message = new Message();

if(empty($doctor_name)){
    $message->SetMessageType(false);
    $message->SetMessage("لطفا نام پزشک را وارد کنید");
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}else{
    $doctor_id = $doctor->ReadDoctorIDByName($doctor_name);
    if($doctor_id == null){
        $message->SetMessageType(false);
        $message->SetMessage("پزشکی با این مشخصات یافت نشد");
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }else{
        $result = $appointment->GetAppointmetForAdmin($doctor_id);
        $size = sizeof($result);
        if($size == 0){
            $message->SetMessageType(false);
            $message->SetMessage("نوبتی با این مشخصات یافت نشد");
            ShowNotification($message->GetMessage(), 0, "450px", "50px");
        }else{
            echo '<table class="table table-hover table-sm history">';
                echo '<thead class="thead" align="center">';
                    echo '<tr>';
                        echo '<th scope="col">نام پزشک</th>';
                        echo '<th scope="col">زمان نوبت</th>';
                        echo '<th scope="col">نام بیمار</th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody align="center">';
                foreach($result as $app){
                    $doctor_id = $app['doctor_id'];
                    $patient_id = $app['patient_id'];
                    $appointment_id = $app['id'];
                    echo '<tr>';
                        echo '<td><span class="drName">'.$doctorInfo->GetName($doctor_id).'</span><br />';
                            $doctorInfo->FetchExpertise($doctor_id);
                        echo '</td>';
                        echo '<td>'.GetPersianDate($app['date']).' '.EnglishDayToPersion($app['day']).'<br />'.' ساعت '.$app['end'].'-'.$app['start'].'</td>';
                        echo '<td class="bimarName">';
                            $patientInfo->FetchName($patient_id);
                        echo '</td>';
                        echo "<td id='$appointment_id' onClick='DeleteAppointment(this.id)'><a class='btn' href='#' title='حذف'><img class='delBtn' src='img/del.svg.png'></a></td>";
                    echo '</tr>';  
                }
                echo "</tbody>";
            echo '</table>';
        }
    }
    
}


