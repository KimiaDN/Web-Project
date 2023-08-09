<?php  
class PatientView extends Patients{

    public function FetchName($id){
        $patient = $this->GetPatientInfo([$id]);
        echo $patient[0]['name'];
    }
    
    public function FetchEmail($id){
        $patient = $this->GetPatientInfo([$id]);
        echo $patient[0]['email'];
    }

    public function FetchPhone($id){
        $patient = $this->GetPatientInfo([$id]);
        echo $patient[0]['phone'];
    }

    public function FetchUsername($id){
        $patient = $this->GetPatientInfo([$id]);
        echo $patient[0]['username'];
    }

    public function FetchAddress($id){
        $patient = $this->GetPatientInfo([$id]);
        echo $patient[0]['address'];
    }

    public function FetchProfilePhoto($id){
        $patient = $this->GetPatientInfo([$id]);
        return "ProfileUploads/Patients/profile".$patient[0]['phone'].".jpg";
    }

    public function HasProfilePhoto($id){
        $patient = $this->GetPatientInfo([$id]);
        if($patient[0]['photo'] == '1'){
            return true;
        }
        return false;
    }

    public function GetPhone($id){
        $patient = $this->GetPatientInfo([$id]);
        return $patient[0]['phone'];
    }
    
}