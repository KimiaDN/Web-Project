<?php 
class DoctorView extends Doctor{

    public function FetchName($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['name'];
    }

    public function GetName($id){
        $doctor = $this->GetDoctorInfo([$id]);
        return $doctor[0]['name'];
    }

    public function FetchExpertise($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $this->ConvertExpertiseNumber($doctor[0]['expertise']);
    }

    public function GetExpertiseCode($id){
        $doctor = $this->GetDoctorInfo([$id]);
        return  $doctor[0]['expertise'];
    }

    public function FetchCode($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['code'];
    }

    public function GetchCode($id){
        $doctor = $this->GetDoctorInfo([$id]);
        return $doctor[0]['code'];
    }

    public function FetchEmail($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['email'];
    }

    public function FetchPhone($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['phone'];
    }

    public function FetchUsername($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['username'];
    }

    public function FetchAddress($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['address'];
    }

    public function FetchDescription($id){
        $doctor = $this->GetDoctorInfo([$id]);
        echo $doctor[0]['description'];
    }

    public function FetchProfilePhoto($id){
        $doctor = $this->GetDoctorInfo([$id]);
        return "ProfileUploads/Doctors/profile".$doctor[0]['code'].".jpg";
    }

    public function HasProfilePhoto($id){
        $doctor = $this->GetDoctorInfo([$id]);
        if($doctor[0]['photo'] == '1'){
            return true;
        }
        return false;
    }

    public function FetchDoctorsIDByExpertise($exp, $id){
        $doctors = $this->GetDoctorByExpertise($exp);
        return $doctors[$id]['id'];
    }

    public function FetchDoctorsIDByName($name){
        $doctors = $this->GetDoctorIDByName($name);
        return $doctors[0]['id'];
    }

    public function FetchDoctorsNumberByExpertise($exp){
        return $this->GetDoctorCountByExpertise($exp);
    }
    
    public function ConvertExpertiseNumber($number){

        if($number == '1'){
            return "اطفال";
        }
        if($number == '2'){
            return "تغذیه";
        }
        if($number == '3'){
            return "جراح عمومی";
        }
        if($number == '4'){
            return "داخلی";
        }
        if($number == '5'){
            return "روان شناس";
        }
        if($number == '6'){
            return "عمومی";
        }
        if($number == '7'){
            return "کلیه";
        }
        if($number == '8'){
            return "مغز و اعصاب";
        }
        if($number == '9'){
            return "ارتوپد";
        }
        if($number == '10'){
            return "پوست و مو";
        }
        if($number == '11'){
            return "زیبایی";
        }
        if($number == '12'){
            return "چشم پزشکی";
        }
        if($number == '13'){
            return "دندان پزشکی";
        }
        if($number == '14'){
            return "زنان و زایمان";
        }
        if($number == '15'){
            return "قلب و عروق";
        }
        if($number == '16'){
            return "گوش و حلق و بینی";
        }
    }

    
}