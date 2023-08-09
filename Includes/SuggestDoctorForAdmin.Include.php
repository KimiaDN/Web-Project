<?php 

include_once("../Config.php");
$doctor = new DoctorController();
$profile_info = new DoctorView();

$name = $_POST['doctor_name'];
$doctor_list = $doctor->SuggestDoctorByName($name);
foreach($doctor_list as $doc){
    $doctor_name = $doc['name'];
    $doctor_id = $doc['id'];
    echo '<div class="row">';
        echo '<div class="col-md-4">';
            echo "<span class='drName'>". $doctor_name."</span><br />".$profile_info->ConvertExpertiseNumber($doc['expertise']);
        echo '</div>';
        echo '<div class="col-md-4">';
            echo "<span class='drInfo'>شماره پروانه: ". $doc['code']."</span><br />";
            echo "<span class='drInfo'>شماره تماس : ". $doc['phone']."</span><br />";
        echo '</div>';
        echo '<div class="col-md-2" align="end">';
            echo "<form action='EditDoctorInfo.php' method='post'>";
                echo "<input type='hidden' name='doctor_id' value='$doctor_id'>";
                echo "<button class='btn' title='ویرایش' ><img class='editBtn' src='img/edit.png'></button>";
            echo "</form>";
        echo '</div>';
        echo '<div class="col-md-2" align="start">';
            echo "<button class='btn' id='$doctor_id' title='حذف' onClick='DeleteDoctor(this.id)'><img class='delBtn' src='img/del.svg.png'></button>";
        echo '</div>';
    echo '</div>';
    echo '</br>';
}