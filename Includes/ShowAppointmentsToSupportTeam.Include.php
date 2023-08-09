<?php 
include_once('../Config.php');

$doctor_name = $_POST['doctor_name'];
$selected_date = $_POST['selected_date'];

$appointment = new AppointmentController("", "", "", "", "");
$doctor = new DoctorController();
$doctorInfo = new DoctorView();
$patientInfo = new PatientView();
$message = new Message();
$result = array();

if(empty($doctor_name) && empty($selected_date)){
    $message->SetMessageType(false);
    $message->SetMessage("لطفا یکی از فیلد ها را پر کنید");
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}
elseif(empty($selected_date) && !empty($doctor_name)){
    $doctor_id = $doctor->ReadDoctorIDByName($doctor_name);
    if($doctor_id != null){
        $result = $appointment->GetAppointmetForAdmin($doctor_id);   
        $message->SetMessageType(true); 
    }else{
        $message->SetMessageType(false);
        $message->SetMessage("نام پزشک معتبر نمی باشد");
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }
}
elseif(empty($doctor_name) && !empty($selected_date)){
    $result = $appointment->GetAppointmetByDate($selected_date);
    $message->SetMessageType(true); 
}
elseif(!empty($doctor_name) && !empty($selected_date)){
    $doctor_id = $doctor->ReadDoctorIDByName($doctor_name);
    if($doctor_id != null){
        $result = $appointment->GetAppointmetByDoctorIDAndDate($doctor_id, $selected_date);
        $message->SetMessageType(true); 
    }else{
        $message->SetMessageType(false);
        $message->SetMessage("نام پزشک معتبر نمی باشد");
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }
}

if(sizeof($result) == 0 && $message->GetMessageType()){
    $message->SetMessage("نوبتی با این مشخصات یافت نشد");
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}
elseif(sizeof($result) > 0 && $message->GetMessageType()){
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
    




