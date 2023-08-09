<?php 
class ResetPasswordView extends ResetPassword{
    
    public function FetchEmail($selector){
        $result = $this->GetResetPassword($selector);
        return $result[0]['user_email'];
    }
}