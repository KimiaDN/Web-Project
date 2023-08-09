<?php

class Patients extends DB{

    protected function AddPatient($name, $username, $password, $phone, $email, 
        $gender, $photo){

        $sql = "INSERT INTO Patients(name, username, password, phone, email, gender, 
                photo) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->Connect()->prepare($sql);
        $hased_password = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$name, $username, $hased_password, $phone, $email,
            $gender, $photo])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function SetProfileImage($patient_id){

        $sql = "UPDATE Patients SET photo= ? WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([1, $patient_id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function GetPatient($username, $password){

        $sql = "SELECT * FROM Patients WHERE username =?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$username])){
            $stmt = null;
            return false;
        }
        if($stmt->rowCount() > 0){
            $result = $stmt->fetchAll();
            $checked = password_verify($password, $result[0]['password']);
            if($checked == false){
                $stmt = null;
                return false;
            }
            elseif($checked == true){
                session_start();
                $_SESSION['user_id'] = $result[0]['id'];
                $_SESSION['username'] = $result[0]['username'];
                $_SESSION['last_access'] = time();
                $_SESSION['type'] = "patient";
                $stmt = null;
                return true;
            }
        }
        else{
            return false;
        }
    }

    protected function EditPatient($id, $name, $username, $password, $phone, $email){

        $sql = "UPDATE Patients SET name=?, username=?, password=?, phone=?, email=?
             WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$name, $username,$hashed_password, $phone, $email, $id])){
            return false;
        }
        //session_start();
        $_SESSION['username'] = $username;   
        $stmt = null;
        return true;
    }

    protected function ResetPassword($email, $password){

        $sql = "UPDATE Patients SET password=? WHERE email=?";
        $stmt = $this->Connect()->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$hashed_password, $email])){
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function CheckForSamePatient($username, $email){

        $sql = "SELECT * FROM Patients WHERE username=? OR email=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$username, $email])){
            $stmt = null;
            header("location: ../sabtebimar.php?error=stmtfaild");
            exit();
        }
        $result = $stmt->rowCount();
        $check = true;
        if($result >0){
            $check = false;
        }

        return $check;

    }

    protected function GetPatientInfo($id){
        $sql = "SELECT * FROM Patients WHERE id = ?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute($id)){
            $stmt = null;
            header("location: ../panelbimar.php?error=stmtfaild");
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../panelbimar.php?error=doctornotfound");
            exit();
        }
        $result = $stmt->fetchAll();
        return $result;
    }
}