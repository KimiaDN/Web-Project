<?php

class Doctor extends DB{

    protected function AddDoctor($names, $user, $pass, $code, $exp, $phone, $email, 
        $gender, $add, $description, $photo){

        $sql = "INSERT INTO Users(name, username, password, code, expertise, phone, 
            email, gender, address, description, photo) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->Connect()->prepare($sql);
        $hased_password = password_hash($pass, PASSWORD_DEFAULT);
        if(!$stmt->execute([$names, $user, $hased_password, $code, $exp, $phone, $email,
            $gender, $add, $description, $photo])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function GetDoctor($username, $password){

        $sql = "SELECT * FROM Users WHERE username =?";
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
                $_SESSION['type'] = "doctor";
                $_SESSION['part'] = 1;
                return true;
            }
        }
        else{
            return false;
        }
        
        
    }

    protected function GetAdmin($username, $password){

        $sql = "SELECT * FROM Admins WHERE username =?";
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
                $_SESSION['type'] = "admin";
                $_SESSION['part'] = 1;
                return true;
            }
        }
        else{
            return false;
        }        
    }

    protected function GetSupportTeam($username, $password){

        $sql = "SELECT * FROM SupportTeam WHERE username =?";
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
                $_SESSION['type'] = "support";
                $_SESSION['part'] = 1;
                return true;
            }
        }
        else{
            return false;
        }
        
        
    }

    protected function EditDoctor($id, $names, $user, $password, $code, $exp, $phone,
     $email, $add, $description){

        $sql = "UPDATE Users SET name=?, username=?, password=?, code=?, expertise=?, phone=?, 
            email=?, address=?, description=? WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if(!$stmt->execute([$names, $user,$hashed_password, $code, $exp, $phone, $email, $add, $description, $id])){
            $stmt = null;
            return false;
        }
        //session_start();
        $_SESSION['username'] = $user;   
        $stmt = null;
        return true;
    }

    protected function CheckForSameUser($username, $code, $email){

        $sql = "SELECT * FROM Users WHERE username=? OR code=? OR email=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$username, $code, $email])){
            $stmt = null;
            return false;
        }
        $result = $stmt->rowCount();
        $check = true;
        if($result >0){
            $check = false;
        }

        return $check;

    }

    protected function CheckChangedInfo($username, $code, $email, $doctor_id){

        $sql = "SELECT * FROM Users WHERE (username=? OR code=? OR email=?) AND id !=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$username, $code, $email, $doctor_id])){
            $stmt = null;
            return false;
        }
        $result = $stmt->rowCount();
        $check = true;
        if($result >0){
            $check = false;
        }

        return $check;

    }

    protected function GetDoctorInfo($id){
        //var_dump($id);
        $sql = "SELECT * FROM Users WHERE id = ?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute($id)){
            $stmt = null;
            return null;
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function GetDoctorByExpertise($exp){
        $sql = "SELECT * FROM Users WHERE expertise = ?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$exp])){
            $stmt = null;
            return null;
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function GetDoctorIDByName($name){
        $sql = "SELECT id FROM Users WHERE name=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$name])){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        $stmt = null;
        return $result;
    }

    protected function GetDoctorsListByName($name){
        $sql = "SELECT * FROM Users WHERE name LIKE ?";
        $stmt = $this->Connect()->prepare($sql);
        $param = "%$name%";
        if(!$stmt->execute([$param])){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        $stmt = null;
        return $result;
    }

    protected function GetDoctorCountByExpertise($exp){
        $sql = "SELECT * FROM Users WHERE expertise = ?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$exp])){
            $stmt = null;
            return 0;
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            return 0;
        }
        return $stmt->rowCount();
    }

    protected function GetAllDoctors(){
        $sql = "SELECT * FROM Users";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute()){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        $stmt = null;
        return $result;
    }

    protected function GetAllDoctorsExpertise(){
        $sql = "SELECT expertise FROM Users";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute()){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        $stmt = null;
        return $result;
    }

    protected function RemoveDoctor($doctor_id){
        $sql = "DELETE FROM Users WHERE id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$doctor_id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }
}