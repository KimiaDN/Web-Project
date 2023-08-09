<?php 

class ProfileImageView extends ProfileImage{

    public function FetchProfileImagePath($id){
        $result = $this->GetProfileImagePath($id);
        return $result[0]['path'];
    }

    public function HasProfileImage($id){
        $result = $this->CheckProfileImage($id);
        if($result){
            return true;
        }
        return false;
    }
}