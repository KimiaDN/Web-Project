<?php 

class ResetPassword extends DB{

    protected function AddResetPassword($email, $selector, $token, $expire){
        $sql = "INSERT INTO ResetPasswords(user_email, selector, token, expire_time)
             VALUES(?, ?, ?, ?)";
        $stmt = $this->Connect()->prepare($sql);
        $hashed_token = password_hash($token, PASSWORD_DEFAULT);
        if(!$stmt->execute([$email, $selector, $hashed_token, $expire])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function DeleteResetPassword($email){
        $sql = "DELETE FROM ResetPasswords WHERE user_email=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$email])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function CheckForExsitedResetPassword($email){
        $sql = "SELECT * FROM ResetPasswords WHERE user_email=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$email])){
            $stmt = null;
            return false;
        }
        if($stmt->rowCount() > 0){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function GetResetPassword($selector){
        $sql = "SELECT * FROM ResetPasswords WHERE selector=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$selector])){
            $stmt = null;
            return null;
        }
        $result = $stmt->fetchAll();
        $stmt = null;
        return $result;
    }


}