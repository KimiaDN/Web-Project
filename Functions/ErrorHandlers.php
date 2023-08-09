<?php
include_once("C:\wamp64\www\Final Project\Config.php");
//Empty Input
function EmptyInputForDoctor($name, $code, $exp, $phone, $email, $gender, $usern, $pass, $add){
    $result = true;
    if (empty($name)|| empty($code)|| empty($exp)|| empty($phone)|| empty($email)||
        empty($gender)|| empty($usern)|| empty($pass)|| empty($add)) {
        $result = false;  
    }
    return $result;
}

function EmptyInputForPatient($name, $username, $password, $password_repeat, $phone, $email, $gender){
    $result = true;
    if (empty($name)|| empty($username)|| empty($password)|| empty($password_repeat) 
    || empty($phone)|| empty($email)||empty($gender)) {
        $result = false;   
    }
    return $result;
}

function EmptyInputForAppointment($doctor_id, $day, $date, $start, $end){
    $result = true;
    if (empty($doctor_id)|| empty($day)|| empty($date)|| empty($start)|| empty($end)) {
        $result = false;   
    }
    return $result;
}

//Invalid Data
function InvalidUsername($username){
    $result = true;
    if (!preg_match("/^[A-Za-z0-9]*$/", $username)) {
        $result = false; 
    }
    return $result;
}

function InvalidPhone($phone){
    $result = false;
    if (preg_match("/^[0-9]*$/", $phone) && strlen($phone) == 11) {
        $result = true; 
    }
    return $result;
}


function InvalidEmailAddress($email) {
        
    $result = true;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $result = false; 
    }
    return $result;
}

//Checking Password
function CheckPassword($password, $repeat_password){
        
    $result = true;
    if ($password !== $repeat_password) {
        $result = false; 
    }
    return $result;   
}

//Checking Reservation Valid Time
function CheckReservedAppointmentTime($start){
    date_default_timezone_set('Asia/Tehran');
    $start = $start . ":00"; 

    $time1 = strtotime("now");
    $time2 = strtotime($start);
    if ($time2 > $time1) {
        return true;
    }
    return false;
}

function ShowNotification($message, $type, $width, $height){
    //success
    if($type == 1){
        echo "<div class='bg-suc' style='width:$width; height:$height;'>".$message."</div>";
    }
    elseif($type == 0){  //error
        echo "<div class='bg-err' style='width:$width; height:$height;'>".$message."</div>";
    }
}
