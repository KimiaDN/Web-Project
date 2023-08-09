<?php 
include_once("../Config.php");

$doctor = new DoctorController();

$doctor_name = $_POST['doctor_name'];
if(!empty($doctor_name)){
    $doctorLists = $doctor->SuggestDoctorByName($doctor_name);
    if(!empty($doctorLists)){
        echo '<div class="bg-light form-control">';
        foreach($doctorLists as $item){
            $name = $item['name'];
            echo "<span id='$name' onclick='SelectSuggestion(this.id)'>".$item['name']."</span>"."</br>";
        }
    echo '</div>';
    }
}