<?php 
include_once("config.php");
$doctor = new DoctorController();
$profile_info = new DoctorView();
?>
<html dir="rtl">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>کلینیک سلامت</title>
        <link rel="stylesheet" href="css/bootstrap.rtl.css">
	    <link type="text/css" rel="stylesheet" href="panelmodir.css">

        <script src="js/bootstrap.bundle.js"></script>
        <script src="jquery-3.6.4.js"></script>
		
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
        </script>

        <script>
		    $(document).ready(function(){
			    $('.editBtn').click(function(){
				    $('#sampleModal').modal('show');
			    })
		    })
		</script>

        <script>
            function DeleteDoctor(clicked_id)
            {
                var name = $("#doctor-name-suggest").val();
                $("#show-doctor-message").load("Includes/DeleteDoctorByAdmin.Include.php", 
                {doctor_id: clicked_id, doctor_name: name});
            }
        </script>

        <script>
		    $(document).ready(function(){
			    $('#doctor-name-suggest').keyup(function(){
                    //alert('hello');
				    var name = $("#doctor-name-suggest").val();
                    $("#show-doctor-list").load("Includes/SuggestDoctorForAdmin.Include.php",
                    {doctor_name: name});
			    });
		    });
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
                        <p>پنل کاربری مدیر کلینیک سلامت</p>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <nav>
                        <ol class="breadcrumb px-2 bg-light">
                            <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active">پنل کاربری مدیر</li>
                        </ol>
                    </nav>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item px-5">
                                <a href="#" class="nav-link active">لیست پزشکان</a>
                            </li>
                            <li class="nav-item">
                                <a href="adddoctor.php" class="nav-link active">اضافه کردن پزشک</a>
                            </li>
                            <li class="nav-item px-5">
                                <a href="tarikhchemodir.php" class="nav-link active">تاریخچه نوبت ها</a>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <a class="btn btn-danger exitBtn" href="Includes/Logout.Include.php">خروج از حساب کاربری</a>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <div class="py-3" align="center">
            <div class="container">
                <h3 align="start">لیست پزشکان</h3>
                <div class="row">
                    <div class="col-md-3" align="end">
                    </div>
                    <div class="col-md-6" align="end">
                        <input type="text" id="doctor-name-suggest" class="form-control formColor" placeholder="جستجوی پزشک">
                    </div>
                    <div class="col-md-2" align="start">
                        <button class="btn btn-success subBtn" type="submit">جستجو</button>
                    </div>
                </div>
               
                <br />
                <div class="list" id="show-doctor-list">
                    <?php
                        $doctors_list = $doctor->GetDoctorsList();
                        $size = sizeof($doctors_list);
                        $counter = 0;
                        while($counter < $size){
                            $doctor_id = $doctors_list[$counter]['id'];
                            echo '<div class="row">';
                                echo '<div class="col-md-4">';
                                    echo "<span class='drName'>". $doctors_list[$counter]['name']."</span><br />".$profile_info->ConvertExpertiseNumber($doctors_list[$counter]['expertise']);
                                echo '</div>';
                                echo '<div class="col-md-4">';
                                    echo "<span class='drInfo'> شماره پروانه : ". $doctors_list[$counter]['code']."</span><br />";
                                    echo "<span class='drInfo'> شماره تماس : ". $doctors_list[$counter]['phone']."</span><br />";
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
                            $counter++;
                        }
                     ?>
                </div>
                </br>
                <div id="show-doctor-message" class="col-md-6"></div>
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
        <div class="modal fade" id="sampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>ویرایش اطلاعات</h3>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="container-fluid">
                            <div class="col-md-8">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6" align="start">
                                            <label>نام و نام خانوادگی</label>
                                            <input type="text" name="name" class="form-control formColor" value="<?php $profileInfo->FetchName($id); ?>">
                                        </div>
                                        <div class="col-md-6" align="start">
                                            <label>تخصص</label>
                                            <input type="text" name="expertise" class="form-control formColor" value="<?php $profileInfo->FetchExpertise($id); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="start">
                                            <label>نام کاربری</label>
                                            <input type="text" name="username" class="form-control formColor" value="<?php $profileInfo->FetchUsername($id); ?>">
                                        </div>
                                        <div class="col-md-6" align="start">
                                            <label>رمز عبور</label>
                                            <input type="text" name="password" class="form-control formColor">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="start">
                                            <label>شماره نظام</label>
                                            <input type="tel" name="code" class="form-control formColor" value="<?php $profileInfo->FetchCode($id); ?>">
                                        </div>
                                        <div class="col-md-6" align="start">
                                            <label>ایمیل</label>
                                            <input type="email" name="email" class="form-control formColor" value="<?php $profileInfo->FetchEmail($id); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="start">
                                            <label>شماره تماس</label>
                                            <input type="tel" name="phone" class="form-control formColor" value="<?php $profileInfo->FetchPhone($id); ?>">
                                        </div>
                                        <div class="col-md-6" align="start">
                                            <label>آدرس</label>
                                            <input type="text" name="address" class="form-control formColor" value="<?php $profileInfo->FetchAddress($id); ?>">
                                        </div>
                                    </div>
                                    <br />
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success subBtn" value="ثبت تغییرات" />
                        <button type="button" class="btn btn-danger exitModal" data-bs-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
	    
        
    </body>
</html>
