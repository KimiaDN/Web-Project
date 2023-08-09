<?php 
include_once('../Classes/Model/DB.Class.php');
include_once('../Classes/Model/Comments.Class.php');
include_once('../Classes/View/CommentsView.Class.php');
include_once('../Classes/Model/Patients.Class.php');
include_once('../Classes/View/PatientsView.Class.php');
$comments = new CommentsView();

$doctor_id = $_POST['doctor_id'];
$limit = $_POST['limit'];

$result = $comments->FetchComments($doctor_id, $limit);
$size = $comments->FetchCommentsSize($doctor_id, $limit);
if($size > 0){
    $counter = 0;
    while($counter < $size){
        $message = $result[$counter]['message'];
        $rate = $result[$counter]['rate'];
        echo '<div class="row px-3" align="start">';
            echo '<div class="col-md-3">';
    
            if($rate == 5){
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
            }
            if($rate == 4){
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
            }
            if($rate == 3){
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
            }
            if($rate == 2){
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
            }
            if($rate == 1){
                echo'<span class="fa fa-star checked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
                echo'<span class="fa fa-star notchecked"></span>';
            }
        
            echo '</div>';
            echo '<div class="col-md-9">';
                echo $message;
            echo '</div>';
        echo '</div>';
        $counter++;
    }
}


