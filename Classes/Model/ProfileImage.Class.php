<?php 
class ProfileImage extends DB{

    protected function AddProfileImage($user_id, $path){
        $sql = "INSERT INTO ProfileImages(user_id, status, path) VALUES(?, ?, ?)";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$user_id, 1, $path])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function EditProfileImage($user_id, $path){
        $sql = "UPDATE ProfileImages SET status=?, path=?  WHERE user_id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([1, $path, $user_id])){
            $stmt = null;
            return false;
        }
        $stmt = null;
        return true;
    }

    protected function CheckProfileImage($user_id){
        $sql = "SELECT path FROM ProfileImages WHERE user_id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$user_id])){
            $stmt = null;
            return false;
        }
        if($stmt->rowCount() > 0){
            return true;
        }
        return false;
    }

    protected function GetProfileImagePath($user_id){
        $sql = "SELECT path FROM ProfileImages WHERE user_id=?";
        $stmt = $this->Connect()->prepare($sql);
        if(!$stmt->execute([$user_id])){
            $stmt = null;
            return null;
        }
        return $stmt->fetchAll();
    }

}