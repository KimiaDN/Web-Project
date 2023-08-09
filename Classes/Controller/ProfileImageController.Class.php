<?php 
include_once("C:\wamp64\www\Final Project\Classes\Message.Class.php");
class ProfileImageController extends ProfileImage{

    public $user_id;
    public $path;

    public function __construct($user_id){
        $this->user_id = $user_id;
    }

    public function AddUserProfileImage($photo, $phone, $type){
        $message = new Message();
        $filename = $photo['name'];
        $tempname = $photo['tmp_name'];
        $filesize = $photo['size'];
        $fileerror = $photo['error'];

        $seperate_filename = explode(".", $filename);
        $file_extenssion = strtolower(end($seperate_filename));
        $allowed_extenssion = array('jpg', 'jpeg', 'png');
        if(in_array($file_extenssion, $allowed_extenssion)){
            if($fileerror === 0){
                if($filesize < 10000000){
                    if($type == 'patient'){
                        $uploadsDir = "C:/wamp64/www/Final Project/ProfileUploads/Patients/";
                    }
                    elseif($type == 'doctor'){
                        $uploadsDir = "C:/wamp64/www/Final Project/ProfileUploads/Doctors/";
                    }
                    
                    $new_filename = "profile_".$phone. ".". $file_extenssion;
                    $full_path = $uploadsDir . $new_filename;
                    if(move_uploaded_file($tempname, $full_path)){
                        if($this->CheckProfileImage($this->user_id)){
                            $result = $this->EditProfileImage($this->user_id, $new_filename);
                        }else{
                            $result = $this->AddProfileImage($this->user_id, $new_filename);
                        }
                        
                        if($result){
                            $message->SetMessageType(true);
                            $message->SetMessage("بارگزاری تصویر با موفقیت انجام شد");
                            return $message;
                        }else{
                            $message->SetMessageType(false);
                            $message->SetMessage("در هنگام ذخیره سازی تصویر خطایی رخ داده است");
                            return $message;
                        }
                        
                    }else{
                        $message->SetMessageType(false);
                        $message->SetMessage("در هنگام بارگذاری تصویر خطایی رخ داده است");
                        return $message;
                    }   
                }
                else{
                    $message->SetMessageType(false);
                    $message->SetMessage("اندازه تصویر بزرگ تر از حد مجاز می باشد");
                    return $message;
                }
            }
            else{
                 $message->SetMessageType(false);
                 $message->SetMessage("در هنگام بارگذاری تصویر خطایی رخ داده است");
                 return $message;    
            } 
        } 
        else{
            $message->SetMessageType(false);
            $message->SetMessage("پسوند تصویر غیر مجاز می باشد");
            return $message;
        }   
        return $message;

    }
}