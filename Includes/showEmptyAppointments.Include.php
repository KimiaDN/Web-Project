<?php 
$date = $_POST['empty_date'];
$doctor_id = $_POST['doctor_id'];

include_once('../Config.php');

$appointmentInfo = new AppointmentView();
$appointment = new AppointmentController($doctor_id, '', $date,'', '');

$list = $appointment->GetEmptyAppointmentsList($doctor_id, $date);
$size = sizeof($list);
$empty_appointments = [];   

$counter = 0; 
if($size == 0){
    ShowNotification('برای این روز نوبت خالی تعریف نشده است', 0, "450px", "50px");
}
while($counter < $size) { 

    $start = $appointmentInfo->FetchStartTime($list[$counter]['id']);
    $end = $appointmentInfo->FetchEndTime($list[$counter]['id']);
    $app_id = $list[$counter]['id'];
    echo "<div class='row'>";
        echo "<div class='col-md-2'></div>";
        echo "<div class='col-md-6 py-3'>";
            echo "<div class='row'>";
                echo "<div class='col-md-5'>";
                    echo "<input type='text' id='$app_id' class='form-control formColor start' value='$start'>";
                echo "</div>";
                echo "-";
                echo "<div class='col-md-5'>";
                    echo "<input type='text' id='$app_id' class='form-control formColor end' value='$end'>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        echo "<div class='col-md-4' align='start'>";
            echo "<button type='submit' id='$app_id' onClick='EditBtn(this.id)' class='btn' title='ویرایش'>";
                echo "<img class='editBtn' src='img/edit.png'>";
            echo "</button>";
            echo "<button type='submit' id='$app_id' onClick='DeleteBtn(this.id)' class='btn' title='حذف'>";
                echo "<img class='delBtn' src='img/del.svg.png'>";
            echo "</button>";
        echo "</div>";
    echo "</div>";
    $counter++;
}

