<?php 
include_once("../Config.php");
$id = $_POST['patient_id'];
$select = $_POST['type'];
$appointment = new AppointmentController("", "", "", "", "");
$doctorInfo = new DoctorView();



if($select == 'active'){
    $result = $appointment->GetPatientsActiveAppointments($id, 1);
    if(sizeof($result) == 0){
        $message = new Message();
        $message->SetMessage("نوبت فعالی برای شما ثبت نشده است");
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }
    if(sizeof($result) > 0){        
        $counter = 0;
        echo '<div class="history">';
        while(isset($result[$counter]['id'])){ 
            $app_id = $result[$counter]['id'];
            echo '<div class="del">';
                echo '<div class="row">';
                    echo'<div class="col-md-5 drName px-5">';
                        $doctorInfo->FetchName($result[$counter]['doctor_id']);
                    echo'</div>';
                    echo'<div class="col-md-5">';
                        echo EnglishDayToPersion($result[$counter]['day']) .' '. GetPersianDate($result[$counter]['date']);
                    echo'</div>';
                    echo'<div class="col-md-2">';
                        echo"<input type='button' id='$app_id' onClick='CancleReserve(this.id)' class='btn btn-danger delBtn' value='لغو نوبت' />";
                    echo'</div>';
                echo'</div>';

                echo'<div class="row">';
                    echo'<div class="col-md-5 px-5">';
                        $doctorInfo->FetchExpertise($result[$counter]['doctor_id']);
                    echo'</div>';
                    echo'<div class="col-md-5">';
                        echo $result[$counter]['start']. ' - '.$result[$counter]['end'];
                    echo'</div>';
                echo'</div>';
            echo'</div>';
            echo '<hr>';        
            $counter++;
        }
        echo'</div>';        
    }
}

if($select == 'not-active'){
    $result = $appointment->GetPatientsDeActiveAppointments($id, 1);
    if(sizeof($result) == 0){
        $message = new Message();
        $message->SetMessage("نوبت رزرو شده ای برای شما ثبت نشده است");
        ShowNotification($message->GetMessage(), 0, "450px", "50px");
    }  
    if(sizeof($result) > 0){
        
        $counter = 0;
        echo '<div class="history">';
        while(isset($result[$counter]['id'])){ 
            $doctor_id = $result[$counter]['doctor_id'];
            //$doctor_name = $doctorInfo->GetName($doctor_id);
            echo '<div class="del">';
                echo '<div class="row">';
                    echo'<div class="col-md-5 drName px-5">';
                        $doctorInfo->FetchName($doctor_id);
                    echo'</div>';
                    echo'<div class="col-md-5">';
                        echo EnglishDayToPersion($result[$counter]['day']) .' '. GetPersianDate($result[$counter]['date']);
                    echo'</div>';
                    echo'<div class="col-md-2">';
                        echo "<form action='nobat3.php' method='post'>";
                            echo"<input type='hidden' name='doctor_id'  value='$doctor_id'>";
                            echo"<input type='submit' id='$doctor_id' class='btn btn-success subBtn' value='ثبت نظر'>";
                        echo "</form>";
                    echo'</div>';
                echo'</div>';

                echo'<div class="row">';
                    echo'<div class="col-md-5 px-5">';
                        $doctorInfo->FetchExpertise($doctor_id);
                    echo'</div>';
                    echo'<div class="col-md-5">';
                        echo $result[$counter]['start']. ' - '.$result[$counter]['end'];
                    echo'</div>';
                echo'</div>';
            echo'</div>';
            echo '<hr>';        
            $counter++;
        }
        echo'</div>';        
    }
}

