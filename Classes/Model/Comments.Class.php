<?php 

class Comments extends DB{

    protected function AddComment($patient_id, $doctor_id, $message, $rate){

        $sql = "INSERT INTO Comments(doctor_id, patient_id, message, rate) VALUES(?, ?, ?, ?)";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id, $patient_id, $message, $rate])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function GetComments($doctor_id, $limit){

        $sql = "SELECT * FROM Comments WHERE doctor_id=? LIMIT $limit";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id])){
            $stmt = null;
            header("location: ../nobat3.php?error=stmtfaild");
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            return null;
        }
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function CommentsSize($doctor_id, $limit){

        $sql = "SELECT * FROM Comments WHERE doctor_id=? LIMIT $limit";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id])){
            $stmt = null;
            return 0;
        }
        return $stmt->rowCount();
    }
}