<?php
include_once("C:\wamp64\www\Final Project\Functions\ErrorHandlers.php");
include_once("C:\wamp64\www\Final Project\Classes\Message.Class.php");

class DoctorController extends Doctor{

    //Properties
    public $name;
    public $username;
    public $password;
    public $password_repeat;
    public $expertise;
    public $gender;
    public $code;
    public $email;
    public $phone;
    public $address;
    public $description;
    public $photo = 0;

    //Methods
    public function DoctoeRegister(){
        $message = new Message();
        if(EmptyInputForDoctor($this->name, $this->code, $this->expertise, $this->phone, 
            $this->email, $this->gender, $this->username, $this->password, 
            $this->address) == false){
                $message->SetMessageType(false);
                $message->SetMessage("لطفا تمام ورودی ها را پر کنید");
                return $message;
            
        }
        if(InvalidPhone($this->phone) == false){
            $message->SetMessageType(false);
            $message->SetMessage("شماره تماس نا معتبر می باشد");
            return $message;
        }
        if(InvalidEmailAddress($this->email) == false){
            $message->SetMessageType(false);
            $message->SetMessage("آدرس ایمیل نا معتبر می باشد");
            return $message;
        }

        if(CheckPassword($this->password, $this->password_repeat)== false){
            $message->SetMessageType(false);
            $message->SetMessage("رمز علور و تکرار آن یکسان نمی باشند");
            return $message;
        }
        if($this->CheckForSameUser($this->username, $this->code, $this->email) == false){
            $message->SetMessageType(false);
            $message->SetMessage("کاربری با این مشخصات در سامانه وجود دارد");
            return $message;
        }
        
        
        //add doctor to database
        $this->AddDoctor($this->name, $this->username, $this->password, $this->code,
        $this->expertise,$this->phone, $this->email, $this->gender, $this->address, 
        $this->description, $this->photo);
        $message->SetMessageType(true);
        $message->SetMessage("ثبت پزشک با موفقت انجام شد");

        return $message;
    }

    public function DoctorEditProfile($id){
        $message = new Message();

        if(EmptyInputForDoctor($this->name, $this->code, $this->expertise, $this->phone, 
            $this->email, $this->gender, $this->username, $this->password, 
            $this->address) == false){
            $message->SetMessageType(false);
            $message->SetMessage("لطفا تمام ورودی ها را پر کنید");
            return $message;
        }
        if(InvalidPhone($this->phone) == false){
            $message->SetMessageType(false);
            $message->SetMessage("شماره تماس نا معتبر می باشد");
            return $message;
        }
        if(InvalidEmailAddress($this->email) == false){
            $message->SetMessageType(false);
            $message->SetMessage("آدرس ایمیل نا معتبر می باشد");
            return $message;
        }
        if(CheckPassword($this->password, $this->password_repeat) == false){
            $message->SetMessageType(false);
            $message->SetMessage("رمز عبور و تکرار آن یکسان نمی باشند");
            return $message;
        }
        if($this->CheckChangedInfo($this->username, $this->code, $this->email, $id) == false){
            $message->SetMessageType(false);
            $message->SetMessage("مشخصات وارد شده تکراری می باشد");
            return $message;
        }

        //Get expertise code
        //$this->expertise = $this->ConvertExpertiseName($this->expertise);
        
        //Edit doctor information
        $result = $this->EditDoctor($id, $this->name, $this->username, $this->password, $this->code, 
        $this->expertise, $this->phone, $this->email, $this->address, $this->description);

        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("ویرایش مشخصات با موفقیت انجام شد");
        }
        else{
            $message->SetMessageType(false);
            $message->SetMessage("خطایی در ویرایش اطلاعات رخ داده است");
        }
        

        return $message;
    }

    public function DeleteDoctor($doctor_id){
        $message = new Message();
        $resukt = $this->RemoveDoctor($doctor_id);
        if($resukt){
            $message->SetMessageType("true");
            $message->SetMessage("حذف پزشک با موفقیت انجام شد");
        }
        else{
            $message->SetMessageType("false");
            $message->SetMessage("خطایی در حدف پزشک رخ داده است");
        }
        return $message;
    }
    public function UsersLogin(){
        $message = new Message();
        if(empty($this->username) || empty($this->password)){
            $message->SetMessageType(false);
            $message->SetMessage("نام کاربری و کلمه عبور را وارد کنید");
            return $message;
        }
        //Check Doctor Login
        $result = $this->GetDoctor($this->username, $this->password);
        if($result){
            $message->SetMessageType(true);
            $message->SetMessage("ورود با موفقیت انجام شد");
        }
        else{
            //Check Admin Login
            $result = $this->GetAdmin($this->username, $this->password);
            if($result){
                $message->SetMessageType(true);
                $message->SetMessage("ورود با موفقیت انجام شد");
            }
            else{
                //Check SupportTeam Login
                $result = $this->GetSupportTeam($this->username, $this->password);
                if($result){
                    $message->SetMessageType(true);
                    $message->SetMessage("ورود با موفقیت انجام شد");
                }
                else{
                    $message->SetMessageType(false);
                    $message->SetMessage("نام کاربری یا کلمه عبور اشتباه می باشد");
                }
            }
            
        }
        return $message;
    }

    public function ReadDoctorIDByName($doctor_name){
        $result = $this->GetDoctorIDByName($doctor_name);
        if(empty($result)){
            return null;
        }
        return $result[0]['id'];
    }

    
    public function ConvertExpertiseName($name){

        if($name == "اطفال"){
            return '1';
        }
        if($name == "تغذیه"){
            return '2';
        }
        if($name == "جراح عمومی"){
            return '3';
        }
        if($name == "داخلی"){
            return '4';
        }
        if($name == "روان شناس"){
            return '5';
        }
        if($name == "عمومی"){
            return '6';
        }
        if($name == "کلیه"){
            return '7';
        }
        if($name == "مغز و اعصاب"){
            return '8';
        }
        if($name == "ارتوپد"){
            return '9';
        }
        if($name == "پوست و مو"){
            return '10';
        }
        if($name == "زیبایی"){
            return '11';
        }
        if($name == "چشم پزشکی"){
            return '12';
        }
        if($name == "دندان پزشکی"){
            return '13';
        }
        if($name == "زنان و زایمان"){
            return '14';
        }
        if($name == "قلب و عروق"){
            return '15';
        }
        if($name == "گوش و حلق و بینی"){
            return '16';
        }
    }

    public function GetAllExpertise(){
        $results = $this->GetAllDoctorsExpertise();
        $exps = array();
        for($i = 0; $i < sizeof($results); $i++){
            array_push($exps, $results[$i]['expertise']);
        }
        return array_unique($exps);
    }

    public function GetDoctorsList(){
        $results =  $this->GetAllDoctors();
        return $results;
    }

    public function SuggestDoctorByName($name){
        $results =  $this->GetDoctorsListByName($name);
        return $results;
    }
    
}