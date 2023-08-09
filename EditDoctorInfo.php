<?php 
include_once("Config.php");
$doctor = new DoctorController();
$profileInfo = new DoctorView();
$id = $_POST['doctor_id'];

?>
<html dir="rtl">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>کلینیک سلامت</title>
        <link rel="stylesheet" href="css/bootstrap.rtl.css">
	    <link type="text/css" rel="stylesheet" href="panelmodir.css">    
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
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.html">صفحه اصلی</a></li>
                    <li class="breadcrumb-item">پنل کاربری مدیر</li>
                    <li class="breadcrumb-item active">ویرایش مشخصات پزشک</li>
                </ol>
            </nav>
        </header>
        <div class="py-3" align="center">
            <div class="container">
                <h3 align="start">مشخصات پزشک</h3>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6" align="start">
                            <label>نام و نام خانوادگی</label>
                            <input type="text" id="name" class="form-control formColor" value="<?php $profileInfo->FetchName($id); ?>">
                        </div>
                        <div class="col-md-6" align="start">
                            <label>تخصص</label>
                            <input type="text" id="expertise" class="form-control formColor" value="<?php $profileInfo->FetchExpertise($id); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" align="start">
                            <label>نام کاربری</label>
                            <input type="text" id="username" class="form-control formColor" value="<?php $profileInfo->FetchUsername($id); ?>">
                        </div>
                        <div class="col-md-6" align="start">
                            <label>رمز عبور</label>
                            <input type="password" id="password" class="form-control formColor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" align="start">
                            <label>شماره نظام</label>
                            <input type="tel" id="code" class="form-control formColor" value="<?php $profileInfo->FetchCode($id); ?>">
                        </div>
                        <div class="col-md-6" align="start">
                            <label>تکرار رمز عبور</label>
                            <input type="password" id="repeat_password" class="form-control formColor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" align="start">
                            <label>شماره تماس</label>
                            <input type="tel" id="phone" class="form-control formColor" value="<?php $profileInfo->FetchPhone($id); ?>">
                        </div>
                        <div class="col-md-6" align="start">
                            <label>ایمیل</label>
                            <input type="email" id="email" class="form-control formColor" value="<?php $profileInfo->FetchEmail($id); ?>">
                        </div>
                    </div>
                    <div align="start">
                        <label>آدرس</label>
                        <input type="text" id="address" class="form-control formColor" value="<?php $profileInfo->FetchAddress($id); ?>">
                    </div>
                    <div class="col-md-8" align="start">
                        <label>توضیحات</label>
                        <textarea class="form-control formColor" id="description" rows="4">
                            <?php $profileInfo->FetchDescription($id); ?>
                        </textarea>
                    </div>
                </div>
                <br /> 
                <input type="submit" id="EditDoctorInfo" class="btn btn-success subBtn" value="ثبت تغییرات" />
                <input type="submit" id="CloseBtn" class="btn btn-danger exitModal" value="بستن" />
                <br />    
            </div>
            
            <br />
            <div id="message"></div>
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
        <script src="jquery-3.6.4.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
        </script>
        <script>
		    $(document).ready(function(){
			    $('#EditDoctorInfo').click(function(){
                    var name = $("#name").val();
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var repeat_password = $("#repeat_password").val();
                    var code = $("#code").val();
                    var expertise = $("#expertise").val();
                    var phone = $("#phone").val();
                    var email = $("#email").val();
                    var address = $("#address").val();
                    var description = $("#description").val();
                    var doctor_id = "<?php echo $id; ?>";

                    $("#message").load("Includes/EditDoctorProfileByAdmin.Include.php", 
                    {
                        name: name,
                        username: username,
                        password: password,
                        repeat_password: repeat_password,
                        code: code,
                        expertise: expertise,
                        phone: phone,
                        email: email,
                        address: address,
                        description: description,
                        doctor_id: doctor_id
                    });
			    });
		    });
		</script>
        <script>
		    $(document).ready(function(){
			    $('#CloseBtn').click(function(){
                    window.open("panelmodir.php");
			    });
		    });
		</script>

        
    </body>
</html>
