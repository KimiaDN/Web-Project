<?php 
include_once("header.php");
$doctors = new DoctorController();
$doctor_view = new DoctorView();
$all_expertise = $doctors->GetAllExpertise();
?>

        <nav>
            <ol class="breadcrumb px-3 bg-light">
                <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                <li class="breadcrumb-item active">نوبت دهی آنلاین</li>
            </ol>
        </nav>
    </header>
    <div class="py-3" align="center">
        <div class="container">
            <?php
                $actual_size = sizeof($all_expertise);
                $size = 0;
                if($actual_size % 2 == 0){
                    $size = $actual_size;
                }
                else{
                    $size = $actual_size - 1;
                }
                $counter = 0;
                while($counter < $size){
                    $exp1 = $doctor_view->ConvertExpertiseNumber($all_expertise[$counter]);
                    $exp2 = $doctor_view->ConvertExpertiseNumber($all_expertise[$counter + 1]);
                    echo '<div class="row">';
                        echo '<div class="col-md-6">';
                            echo '<form action="nobat2.php" method="post">';
                                echo "<input type='submit' class='btn linkBtn1' name='exp' value = '$exp1'>";
                            echo '</form>';
                        echo '</div>';
                        echo '<div class="col-md-6">';
                            echo '<form action="nobat2.php" method="post">';
                                echo "<input type='submit' class='btn linkBtn2' name='exp' value = '$exp2'>";
                            echo '</form>';    
                        echo '</div>';
                    echo'</div>';
                echo '</br>';
                $counter = $counter + 2;
                }
                if($actual_size % 2 != 0){
                    $exp1 = $doctor_view->ConvertExpertiseNumber($all_expertise[$counter]);
                    echo '<div class="row">';
                        echo '<div class="col-md-6">';
                            echo '<form action="nobat2.php" method="post">';
                                echo "<input type ='submit' class='btn linkBtn1' name='exp' value ='$exp1'>";
                            echo '</form>';
                        echo '</div>';
                    echo'</div>';
                }
             ?>
        </div>            
    </div>
    <?php include_once('footer.php'); ?>