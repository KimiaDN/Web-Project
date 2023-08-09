<?php

define('SESSION_EXPIRATION_TIME', 60);

function CheckUserLoginExpiration(){

    if(isset($_SESSION['user_id'])){
        $lastAccess = $_SESSION['last_access'];
        if(time() - $lastAccess < SESSION_EXPIRATION_TIME){
            UserLogout();
        }
    }
}

function UserLogout(){

    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['last_access']);
}