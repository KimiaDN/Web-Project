<?php 
include_once("Config.php");
$DoctorInfo = new DoctorView();
$doctor_cont = new DoctorController();
$exp = $doctor_cont->ConvertExpertiseName($_POST['exp']);
$profilePhoto = new ProfileImageView();
?>
<html dir="rtl">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>کلینیک سلامت</title>
        <link rel="stylesheet" href="css/bootstrap.rtl.css">
	    <link type="text/css" rel="stylesheet" href="nobat2.css">

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
        </script>

        
    </head>
    <body>
        <header class="sticky">
            <div class="container-fluid" id="pageHeader">
                <div class="row">
                    <div class="col-md-1 py-2">
                        <img src="img/logo.jpg" class="rounded" width="100" height="100">
                    </div>
                    <div class="col-md-8 py-5" id="pageTitle">
                        <p>سامانه نوبت دهی کلینیک سلامت</p>
                    </div>
                </div>
            </div>
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item active">نوبت دهی آنلاین</li>
                </ol>
            </nav>
        </header>
        <div class="py-3" align="center">
            <div class="container">
                <h3 align="start">پزشکان شاخه <?php echo $_POST['exp']; ?> </h3>
                <?php 
                    $size = $DoctorInfo->FetchDoctorsNumberByExpertise($exp);
                    $counter = 0;
                    $even = true;
                    if($size % 2 != 0){
                        $even = false;
                        $size = $size - 1;
                    }
                    while($counter < $size){
                        $doctor_id1 = $DoctorInfo->FetchDoctorsIDByExpertise($exp, $counter); 
                        $doctor_id2 = $DoctorInfo->FetchDoctorsIDByExpertise($exp, $counter+1); ?>
                    
                        <div class="row py-4">
                            <div class="col-md-6">
                                <div class="dr1">
                                    <?php echo 'hell0'; ?>
                                    <div class="row">   
                                        <div class="col-md-5">
                                        <?php 
                                            if($profilePhoto->HasProfileImage($doctor_id)){
                                                $path = $profilePhoto->FetchProfileImagePath($doctor_id);
                                                echo $path;
                                                
                                                echo "<img src='ProfileUploads/Doctors/$path' class='rounded py-1' width='100' height='100'>";
                                            } 
                                            else{
                                                echo "<img src='img/bimarman.jpg' class='rounded' width='100' height='100'>";
                                            }
                                        ?>
                                        </div>  
                                        <div class="col-md-7">
                                            <form action="nobat3.php" method="post">
                                                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id1; ?>" >
                                                <input type="submit" class="dr form-control formColor2"  name="doctor_name" value="<?php echo $DoctorInfo->FetchName($doctor_id1); ?>" >
                                            </form>
                                            <br />
                                            <p class="num">شماره نظام : <?php $DoctorInfo->FetchCode($doctor_id1); ?></p> 
                                        </div>                                                                          
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dr2" >
                                    <div class="row">
                                        <div class="col-md-5">
                                        <?php 
                                            if($profilePhoto->HasProfileImage($doctor_id)){
                                                $path = $profilePhoto->FetchProfileImagePath($doctor_id);
                                                echo $path;
                                                
                                                echo "<img src='ProfileUploads/Doctors/$path' class='rounded py-1' width='100' height='100'>";
                                            } 
                                            else{
                                                echo "<img src='img/bimarman.jpg' class='rounded' width='100' height='100'>";
                                            }
                                        ?>
                                        </div>
                                        <div class="col-md-7">
                                            <form action="nobat3.php" method="post">
                                                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id2; ?>" >
                                                <input type="submit" class="dr form-control formColor1"  name="doctor_name" value="<?php echo $DoctorInfo->FetchName($doctor_id2); ?>" >
                                            </form>
                                            <br />
                                            <p class="num">شماره نظام : <?php $DoctorInfo->FetchCode($doctor_id2); ?></p> 
                                        </div>     
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    <?php 
                
                        $counter = $counter+2;
                    }
                    if($even == false){
                        $doctor_id = $DoctorInfo->FetchDoctorsIDByExpertise($exp, $counter); ?>
                        <div class="row py-4">
                            <div class="col-md-6">
                                <div class="dr2" >
                                    <div class="row">
                                        <div class="col-md-5">
                                        <?php 
                                            if($profilePhoto->HasProfileImage($doctor_id)){
                                                $path = $profilePhoto->FetchProfileImagePath($doctor_id);
                                                
                                                echo "<img src='ProfileUploads/Doctors/$path' class='rounded py-1' width='100' height='100'>";
                                            } 
                                            else{
                                                echo "<img src='img/bimarman.jpg' class='rounded' width='100' height='100'>";
                                            }
                                        ?>
                                        </div>   
                                        <div class="col-md-7">
                                            <form action="nobat3.php" method="post">
                                                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>" >
                                                <input type="submit" class="dr form-control formColor1"  name="doctor_name" value="<?php echo $DoctorInfo->FetchName($doctor_id); ?>" >
                                            </form>
                                            <br />
                                            <br />
                                            <p class="num">شماره نظام : <?php $DoctorInfo->FetchCode($doctor_id); ?></p> 
                                        </div>
                                          
                                    </div> 
                                </div>
                            </div> 
                        </div>
                        
                <?php
                    } ?>    
            </div>
        </div>


        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-3 border-top">
                <p class="col-md-4 mt-0 text-muted">
                    آدرس : رشت، گلسار، نبش کوچه 110
                    <br>
                    ساختمان سلامت
                </p>
                <div class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <img src="img/clinic.jpg" class="rounded" width="150">
                </div>
                <div class="col-md-4 mb-0 text-muted">
                    شماره های تماس :
                    <p class="d-flex justify-content-end">013-32117683</p>
                    <p class="d-flex justify-content-end">013-32117689</p>
                </p>
            </footer>
        </div>
	    <script src="js/bootstrap.bundle.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
        </script>

        <script >
            function DoctorPage(clicked_id)
            {
                //alert(clicked_id);

                $.post("nobat3.php", {doctor_name: clicked_id});
                window.location.replace("nobat3.php");
            }
        </script>
    </body>
</html>