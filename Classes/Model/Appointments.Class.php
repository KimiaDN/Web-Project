<?php 
class Appointment extends DB{

   
    protected function AddEmptyAppointment($doctor_id, $day, $date, $start, $end){
        $sql = "INSERT INTO Appointments(doctor_id, day, date, start, end) VALUES(?, ?, ?, ?, ?)";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $day, $date, $start, $end])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function ReadEmptyAppointments($doctor_id, $date){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND date=? AND status=0";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $date])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function ReadDoctorReservedAppointments($doctor_id, $date){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND date=? AND status=1";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $date])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function ReadAppointment($id){
        $sql = "SELECT * FROM Appointments WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$id])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function ReadAppointmentByDate($selected_date){
        $sql = "SELECT * FROM Appointments WHERE date=? AND status=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$selected_date, 1])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function ReadAppointmentByDoctorID($doctor_id){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND status=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, 1])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function ReadAppointmentByDoctorIDAndDate($doctor_id, $selected_date){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND status=? AND date=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, 1, $selected_date])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    
    protected function GetEmptyAppointmentIDList($doctor_id, $date){
        $sql = "SELECT id FROM Appointments WHERE doctor_id=? AND date=? AND status=? ORDER BY start";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $date, 0])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }
    
    protected function CheckForSameAppointment($doctor_id, $date, $start){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND date=? AND start=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $date, $start])){
            $stmt = null;
            return null;
        }
        $result = $stmt->rowCount();
        $check = true;
        if($result >0){
            $check = false;
        }
        return $check;
    }

    
    protected function ReservedAppointmentsCount($doctor_id, $date){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND date=? AND status=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $date, 1])){
            $stmt = null;
            return null;
        }
        return $stmt->rowCount();
    }

    protected function ReadReservedAppointments($doctor_id, $date){
        $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND date=? AND status=1";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $date])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function DeleteAppointment($appointment_id){
        $sql = "DELETE FROM Appointments WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$appointment_id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function UpdateAppointment($start, $end, $id){
        $sql = "UPDATE Appointments SET start=?, end=? WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$start, $end, $id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    
    protected function GetPatientsAppointments($id, $status){
        $sql = "SELECT * FROM Appointments WHERE patient_id =? AND status=?";
                
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$id, $status])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

    protected function ReserveAppointment($id, $patient_id){
        $sql = "UPDATE Appointments SET status=?, patient_id=? WHERE id=?";       
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([1,$patient_id, $id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function CancelAppointment($id){
        $sql = "UPDATE Appointments SET status=? WHERE id=?";       
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([0, $id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function GetAppointmentByID($id){
        $sql = "SELECT * FROM Appointments WHERE id=?";
                
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$id])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }
}