<?php 
include_once("../Config.php");
$doctor = new DoctorController();
$profile_info = new DoctorView();
$profileImageInfo = new ProfileImageView();
$name = $_POST['suggested_name'];
if(!empty($name)){
    $doctor_list = $doctor->SuggestDoctorByName($name);

    echo '<div class="row">';
        echo '<div class="col-md-5"></div>';
        echo '<div class="col-md-3">';
            echo '<div class="bg-light form-control">';
                foreach($doctor_list as $item){
                    $doctor_name = $item['name'];
                    echo '<div class="row">';
                        echo '<div class="col-md-3">';
                            if($profileImageInfo->HasProfileImage($item['id'])){
                                $path = $profileImageInfo->FetchProfileImagePath($item['id']);
                                $full_path = 'ProfileUploads/Doctors/'. $path ;
                                echo "<img src='$full_path' class='rounded' width='30' height='30'>";
                            }else{
                                echo '<img src="img/logo.jpg" class="rounded" width="30" height="30">';
                            }                           
                        echo '</div>';
                        echo '<div class="col-md-9">';
                            echo "<span class='doctor_name' onclick='SelectSuggestion(this.id)' id='$doctor_name'>".$doctor_name . "</span>";
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';
    echo '</div>';

}