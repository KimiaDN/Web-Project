<?php 
include_once("C:\wamp64\www\Final Project\Config.php");

class AppointmentController extends Appointment {

    //Properties
    public $doctor_id;
    public $patient_id;
    public $day;
    public $date;
    public $start;
    public $end;
    public $status;

    public function __construct($doctor_id, $day, $date, $start, $end)
    {
        $this->doctor_id = $doctor_id;
        $this->day = $day;
        $this->date = $date;
        $this->start= $start;
        $this->end = $end;
    }

    //Methods
    public function SetEmptyAppoinmet(){

        $message = new Message();
        $message->SetMessageType(true);
        if($this->CheckForSameAppointment($this->doctor_id, $this->date, $this->start)){
            if(CheckReservedAppointmentTime($this->start) == true){
                $result = $this->AddEmptyAppointment($this->doctor_id, $this->day, $this->date, $this->start, $this->end);
                if($result){
                    $message->SetMessageType(true);
                    $notice = "زمان شروع : $this->start : زمان پایان $this->end </br>"." ثبت نوبت با موفقیت انجام شد";
                    $message->SetMessage($notice);
                    return $message;
                }
                else{
                    $message->SetMessageType(false);
                    $notice = "زمان شروع : $this->start : زمان پایان $this->end </br>"." خطایی در ثبت نوبت رخ داده است";
                    $message->SetMessage($notice);
                    return $message;
                }
                
            }else{
                $message->SetMessageType(false);
                $notice = " زمان شروع : $this->start : زمان پایان $this->end </br>" . " از زمان نوبت گدشته است";
                $message->SetMessage($notice);
                return $message;
            }
        }else{
            $message->SetMessageType(false);
            $notice = "زمان شروع : $this->start : زمان پایان $this->end </br>". "نوبتی با این مشخصات موجود می باشد";
            $message->SetMessage($notice);
            return $message;
        }
    }

    // public function RemoveAppointment(){
    //     $this->DeleteAppointment($this->doctor_id, $this->date, $this->start, $this->end);
    //     header("location: ../paneldoctor.php?error=noerror");
    //     exit();
    // }

    public function EditAppointment($appointment_id, $start, $end){
        $message = new Message();
        $appointment = $this->GetAppointmentByID($appointment_id);
        if(CheckReservedAppointmentTime($start)){
            if($this->CheckForSameAppointment($appointment[0]['doctor_id'], $appointment[0]['date'], $start)){
                $result = $this->UpdateAppointment($start, $end, $appointment_id);
                if($result){
                    $message->SetMessageType(true);
                    $message->SetMessage("ویرایش نوبت با موفقیت انجام شد");
                }
                else{
                    $message->SetMessageType(false);
                    $message->SetMessage("خطایی در ویرایش نوبت رخ داده است");
                }                
            }else{
                $message->SetMessageType(false);
                $message->SetMessage("نوبتی در این ساعت ثبت شده است");
            }
            
        }else{
            $message->SetMessageType(false);
            $message->SetMessage("از زمان نوبت گدشته است");
        }
        

        return $message;
        
    }

    public function RemoveAppointment($appointment_id){
        $message = new Message();
        $result = $this->DeleteAppointment($appointment_id);
        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("حذف نوبت با موفقیت انجام شد");
        }
        else{
            $message->SetMessageType(false);
            $message->SetMessage("خطایی در حدف نوبت رخ داده است");
        }            
        return $message;
        
    }

    // public function SetAppointment(){
    //     $this->AddAppointment($this->doctor_id, $this->patient_id, $this->date, $this->start, $this->end);
    //     header("location: ../asli.php?error=noerror");
    //     exit();
    // }

    // public function GetEmptyAppointments(){
    //     $this->AddAppointment($this->doctor_id, $this->patient_id, $this->date, $this->start, $this->end);
    //     header("location: ../asli.php?error=noerror");
    //     exit();
    // }

    // public function GetID(){
    //     return $this->GetEmptyAppointmentId($this->doctor_id, $this->date, $this->start, $this->end);
    // }
    
    //need
    public function GetPatientsActiveAppointments($id, $status){
        $appointments = $this->GetPatientsAppointments($id, $status);
        $size = sizeof($appointments);
        $new_appointments = array();
        $today_date = date("Y-m-d");
        for($i= 0; $i < $size; $i++){
            $app_date = $appointments[$i]['date'];
            $compare_time = CheckReservedAppointmentTime($appointments[$i]['start']);
            if($app_date < $today_date || ($app_date == $today_date && !$compare_time)){
                unset($appointments[$i]);
            }
        }
        foreach($appointments as $appointment){
            array_push($new_appointments, $appointment);
        }
        return $new_appointments;
    }

    public function GetPatientsDeActiveAppointments($id, $status){
        $appointments = $this->GetPatientsAppointments($id, $status);
        $size = sizeof($appointments);
        $new_appointments = array();
        $today_date = date("Y-m-d");
        for($i= 0; $i < $size; $i++){
            $app_date = $appointments[$i]['date'];
            $compare_time = CheckReservedAppointmentTime($appointments[$i]['start']);
            if($app_date > $today_date || ($app_date == $today_date && $compare_time)){
                unset($appointments[$i]);
            }
        }

        foreach($appointments as $appointment){
            array_push($new_appointments, $appointment);
        }

        return $new_appointments;
    }
    //need
    public function GetEmptyAppointmentsList($id, $date){
        $list_id = $this->GetEmptyAppointmentIDList($id, $date);
        $new_list_id = array();
        $size = sizeof($list_id);
        for($i = 0; $i < $size; $i++){
            $appointment = $this->GetAppointmentByID($list_id[$i]["id"]);
            $start = $appointment[0]["start"];
            if(CheckReservedAppointmentTime($start) == false){
                unset($list_id[$i]);
            }
        }
        foreach($list_id as $id){
            array_push($new_list_id, $id);
        }
        return $new_list_id;
    }
    //need
    public function Reserve($id, $patient_id){
        $message = new Message();
        $result = $this->ReserveAppointment($id, $patient_id);
        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("رزرو نوبت با موفقیت انجام شد");
        }
        else{
            $message->SetMessageType(false);
            $message->SetMessage("خطایی در ویرایش نوبت رخ داده است");
        }          
        return $message;
       
    }

    public function Cancle($id){
        $message = new Message();
        $result = $this->CancelAppointment($id);
        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("نوبت با موفقیت لغو شد");
        }
        else{
            $message->SetMessageType(false);
            $message->SetMessage("خطایی در لغو نوبت رخ داده است");
        }          
        return $message;
       
    }

    public function GetDoctorReserveAppointments($doctor_id, $date){
        return $this->ReadDoctorReservedAppointments($doctor_id, $date);
        
    }

    //need
    public function GetAppointment($id){
        return $this->GetAppointmentByID($id);
        
    }

    public function GetAppointmetForAdmin($doctor_id){
        $result = $this->ReadAppointmentByDoctorID($doctor_id);
        $result_list = array();
        $size = sizeof($result);
        $present_date = date("Y-m-d");
        for($i=0; $i<$size ; $i++){
            if($result[$i]['date'] < $present_date){
                unset($result[$i]);
            }
        }
        foreach($result as $item){
            array_push($result_list, $item);
        }
        return $result_list;
    }

    public function GetAppointmetByDate($selected_date){
        $result = $this->ReadAppointmentByDate($selected_date);
        return $result;
    }

    public function GetAppointmetByDoctorIDAndDate($doctor_id, $selected_date){
        $result = $this->ReadAppointmentByDoctorIDAndDate($doctor_id, $selected_date);
        return $result;
    }


}