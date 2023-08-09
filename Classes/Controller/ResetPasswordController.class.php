<?php 
include_once("C:\wamp64\www\Final Project\Classes\Message.Class.php");
class ResetPasswordController extends ResetPassword{
    
    public $user_email;
    public $selector;
    public $token;
    public $expire_time;

    public function __construct($email, $selector, $token, $expire_time){
        $this->user_email = $email;
        $this->selector = $selector;
        $this->token = $token;
        $this->expire_time = $expire_time;
    }

    public function SetResetPassword(){
        $message = new Message();

        if(empty($this->user_email)){
            $message->SetMessageType(false);
            $message->SetMessage("لطفا آدرس ایمیل خود را وارد کنید");
            return $message;
        }
        
        $result = $this->RemoveResetPassword($this->user_email);
        if($result){
            $result = $this->AddResetPassword($this->user_email, $this->selector, $this->token, $this->expire_time);
            if($result == false){
                $message->SetMessageType(false);
                $message->SetMessage("خطایی در ارسال ایمیل رخ داده است");
                return $message;
            }
            $message->SetMessageType(true);
            $message->SetMessage("ایمیل بازیابی رمز با موفقیت برای شما ارسال شد");
            return $message;
        }else{
            $message->SetMessageType(false);
            $message->SetMessage("خطایی در ارسال ایمیل رخ داده است");
            return $message;
        }
        
    }

    public function RemoveResetPassword($email){

        return $this->DeleteResetPassword($email);
    }

    public function CheckOtherResetPassword($email){

        return $this->CheckForExsitedResetPassword($email);
    }

    public function CheckUserAuthentication($selector, $validator){
        $message = new Message();
        $result = $this->GetResetPassword($selector);
        if(empty($result)){
            $message->SetMessageType(false);
            $message->SetMessage("خطایی در احراز هویت کاربر رخ داده است");
            return $message;
        }
        $date_now = date("U");
        if($date_now <= $result[0]["expire_time"]){
            $tokenBin = hex2bin($validator);
            if(password_verify($tokenBin, $result[0]['token']) === true){
                $message->SetMessageType(true);
                $message->SetMessage("");
                return $message;
            }else{
                $message->SetMessageType(false);
                $message->SetMessage("خطایی در احراز هویت کاربر رخ داده است");
                return $message;
            }
        }else{
            $message->SetMessageType(false);
            $message->SetMessage("مهلت بازیابی رمز عبور به پایان رسیده است");
            return $message;
        }
    }
}