<?php 

function EnglishDayToPersion($day){

    if($day == "Saturday"){
        return "شنبه";
    }
    if($day == "Sunday"){
        return "یکشنبه";
    }
    if($day == "Monday"){
        return "دوشنبه";
    }
    if($day == "Tuesday"){
        return "سه شنبه";
    }
    if($day == "Wednesday"){
        return "چهارشنبه";
    }
    if($day == "Thursday"){
        return "پنج شنبه";
    }
    if($day == "Friday"){
        return "جمعه";
    }
}

function EnglishDateToPersion($date){

    $formatter = new IntlDateFormatter(
        "fa_IR@calendar=persian", 
        IntlDateFormatter::FULL, 
            IntlDateFormatter::FULL, 
        'Asia/Tehran', 
        IntlDateFormatter::TRADITIONAL, 
        "yyyy/MM/dd");

    return $formatter->format($date);
}

function GetSpecificDay($num){

    $d= date("l", mktime(0,0,0,date("m"), date("d")+$num , date("y")));
    return EnglishDayToPersion($d);
}

function GetSpecificDate($num){

    $day_day = date("d", mktime(0,0,0,date("m"), date("d")+$num, date("y")));
    $day_mounth = date("m", mktime(0,0,0,date("m"), date("d")+$num, date("y")));
    $day_year = date("Y", mktime(0,0,0,date("m"), date("d")+$num, date("y")));

    $date = new DateTime();
    $date->setDate($day_year, $day_mounth, $day_day);
    return EnglishDateToPersion($date);
}

function GetPersianDate($date){
    $day = date("d", strtotime($date));
    $mounth = date("m", strtotime($date));
    $year = date("Y", strtotime($date));

    $new_date = new DateTime();
    $new_date->setDate($year, $mounth, $day);
    return EnglishDateToPersion($new_date);
}

function GetSelectedDate($num){

    return date("Y-m-d", mktime(0,0,0,date("m"), date("d")+$num, date("y")));
}

function ConvertTimeToNumber($time){
    $mark_pos = strpos($time, ':');
    $number = 0;
    if($mark_pos !== false){
        $req = substr($time, $mark_pos);
        if($req == ":00"){
            echo "00";
            $number = (float)substr($time, 0, $mark_pos);
        }
        else if($req == ":30"){
            $str = substr($time, 0, $mark_pos) . ".5";
            $number = (float)$str;
        }
    }
    else{
        $number = (float)$time;
    }
    return $number;
}

function ConvertNumberToTime($number){
    $div = (int) $number / 1;

    if($div + 0.5 == $number){
        $str = strval($div) . ":30";
        return $str;
    }
    $str = strval($div) . ":00";
    return $str;

}