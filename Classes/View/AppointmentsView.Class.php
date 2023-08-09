<?php 
include_once('C:\wamp64\www\Final Project\Classes\Model\DB.Class.php');
include_once('C:\wamp64\www\Final Project\Classes\Model\Doctors.Class.php');
include_once('C:\wamp64\www\Final Project\Classes\Model\Patients.Class.php');
include_once('DoctorsView.Class.php');
include_once('PatientsView.Class.php');

class AppointmentView extends Appointment{

    //Empty Appointments Information
    
    public function FetchStartTime($id){
        $result = $this->ReadAppointment($id);
        return $result[0]['start'];
    }

    public function FetchEndTime($id){
        $result = $this->ReadAppointment($id);
        return $result[0]['end'];
    }

    public function FetchDate($id){
        $result = $this->ReadAppointment($id);
        return $result[0]['date'];
    }

    public function FetchDay($id){
        $result = $this->ReadAppointment($id);
        return $result[0]['day'];
    }


    //Reserved Appointments Information
    public function ReservedAppointmentsNumber($doctor_id, $date){
        return $this->ReservedAppointmentsCount($doctor_id, $date);
    }

    public function FetchReservedDoctorName($doctor_id, $date){
        $doctor = new DoctorView();
        return $doctor->FetchName($doctor_id);
    }

    public function FetchReservedPatientName($i, $doctor_id, $date){
        $result = $this->ReadReservedAppointments($doctor_id, $date);
        $patient_id = $result[$i]['patient_id'];
        $patient = new PatientView();
        return $patient->FetchName($patient_id);
    }

    public function FetchReservedStartTime($i, $doctor_id, $date){
        $result = $this->ReadReservedAppointments($doctor_id, $date);
        return $result[$i]['start'];
    }

    public function FetchReservedEndtTime($i, $doctor_id, $date){
        $result = $this->ReadReservedAppointments($doctor_id, $date);
        return $result[$i]['end'];
    }
}