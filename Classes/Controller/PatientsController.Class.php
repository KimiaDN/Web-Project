<?php
include_once("C:\wamp64\www\Final Project\Functions\ErrorHandlers.php");
include_once("C:\wamp64\www\Final Project\Classes\Message.Class.php");
class PatientController extends Patients{

    //Properties
    public $name;
    public $username;
    public $password;
    public $repeat_password;
    public $phone;
    public $email;
    public $gender;
    public $photo;

    //Methods
    public function PatientRegister(){

        $message = new Message();
        if(EmptyInputForPatient($this->name, $this->username, $this->password, $this->repeat_password, $this->phone, $this->email, $this->gender) == false){
            $message->SetMessageType(false);
            $message->SetMessage("تمام فیلد هارا پر کنید");
            return $message;
        }
        if(InvalidPhone($this->phone) == false){
            $message->SetMessageType(false);
            $message->SetMessage("شماره همراه نامعتبر می باشد");
            return $message;
        }
        if(InvalidUsername($this->username) == false){
            $message->SetMessageType(false);
            $message->SetMessage("نام کاربری نا معتبر می باشد");
            return $message;
        }
        if(InvalidEmailAddress($this->email) == false){
            $message->SetMessageType(false);
            $message->SetMessage("آدرس ایمیل نا معتبر می باشد");
            return $message;
        }
        if(CheckPassword($this->password, $this->repeat_password) == false){
            $message->SetMessageType(false);
            $message->SetMessage("کلمه عبور و تکرار آن بکسان نمی باشند");
            return $message;
        }
        if($this->CheckForSamePatient($this->username, $this->email) == false){
            $message->SetMessageType(false);
            $message->SetMessage("کاربری با این مشخصات در سیستم وجود دارد");
            return $message;
        }
        
        
        $result = $this->AddPatient($this->name, $this->username, $this->password, $this->phone,
            $this->email, $this->gender, $this->photo);
        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("ثبت بیمار با موفقیت انجام شد");
        }else{
            $message->SetMessageType(false);
            $message->SetMessage("حطایی در ثبت بیمار رخ داده است");
        }
        return $message;
            
    }

    public function PatientLogin(){
        $message = new Message();
        if(empty($this->username) || empty($this->password)){
            $message->SetMessageType(false);
            $message->SetMessage("نام کاربری و کلمه عبور را وارد کنید");
            return $message;
        }
        $result = $this->GetPatient($this->username, $this->password);
        if($result == false){
            $message->SetMessageType(false);
            $message->SetMessage("نام کاربری یا کلمه عبور اشتباه می باشد");
        }
        else{
            $message->SetMessageType(true);
            $message->SetMessage("ورود با موفقیت انجام شد");
        }
        return $message;
    }

    public function PatientEditProfile($id){
        $message = new Message();
        if(EmptyInputForPatient($this->name, $this->username, $this->password, $this->repeat_password, $this->phone, $this->email, $this->gender) == false){
            $message->SetMessageType(false);
            $message->SetMessage("تمام فیلد هارا پر کنید");
            return $message;
        }
        if(InvalidPhone($this->phone) == false){
            $message->SetMessageType(false);
            $message->SetMessage("شماره همراه نامعتبر می باشد");
            return $message;
        }
        if(InvalidEmailAddress($this->email) == false){
            $message->SetMessageType(false);
            $message->SetMessage("آدرس ایمیل نا معتبر می باشد");
            return $message;
        }
        if(CheckPassword($this->password, $this->repeat_password) == false){
            $message->SetMessageType(false);
            $message->SetMessage("رمز عبور و تکرار آه یکسان نمی باشند");
            return $message;
        }

        //Edit Patient information
        $result = $this->EditPatient($id, $this->name, $this->username, $this->password , $this->phone, $this->email);
        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("ویرایش اطلاعات با موفقیت انجام شد");
        }else{
            $message->SetMessageType(false);
            $message->SetMessage("حطایی در ویرایش اطلاعات رخ داده است");
        }
        return $message;
    }
    
    public static function IsPatientLogenIn(){
        if(isset($_SESSION['user_id']) && isset($_SESSION['username']) && 
            isset($_SESSION['last_access']) && isset($_SESSION['type'])){

                if($_SESSION['type'] == 'patient'){
                    return true;
                }
        }
        return false;
    }

    public function FindPatient($id){
        return $this->GetPatientInfo($id);
    }

    public function ResetPatientPassword($email, $password, $repeat_password){
        $message = new Message();
        if(CheckPassword($password, $repeat_password)){
            $result = $this->ResetPassword($email, $password);
            if($result){
                $message->SetMessageType(true);
                $message->SetMessage("رمز عبور با موفقیت بازیابی شد");
                return $message;
            }else{
                $message->SetMessageType(false);
                $message->SetMessage("خطایی در ثبت رمز عبور جدید رخ داده است");
                return $message;
            }
        }
        else{
            $message->SetMessageType(false);
            $message->SetMessage("رمز عبور و تکرار آن یمسان نمی باشند");
            return $message;
        }
    }
}