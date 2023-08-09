<?php include_once("header.php"); ?>
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item active">ثبت نام مراجعه کنندگان</li>
                </ol>
            </nav>
        </header>
        <div class="py-3">
            <div class="container" align="center">
                <form id="patient_register" method="post">
                    <div class="col-md-4" align="start">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" id="name" class="form-control formColor">
                    </div>
                    <div class="col-md-4" align="start">
                        <label>نام کاربری</label>
                        <input type="text" id="username" class="form-control formColor">
                    </div>
                    <div class="col-md-4" align="start">
                        <label>رمز عبور</label>
                        <input type="password" id="password" class="form-control formColor" >
                    </div>
                    <div class="col-md-4" align="start">
                        <label>تکرار رمز عبور</label>
                        <input type="password" id="password_repeat" class="form-control formColor" >
                    </div>
                    <div class="col-md-4" align="start">
                        <label>شماره تماس</label>
                        <input type="tel" id="phone" class="form-control formColor" >
                    </div>
                    <div class="col-md-4" align="start">
                        <label>ایمیل</label>
                        <input type="text" id="email" class="form-control formColor">
                    </div>
                    <div class="col-md-4" align="start">
                        <label class="form-label">جنسیت</label>
                        <select id="gender" class="form-select formColor selector" >
                            <option selected disabled value="">انتخاب کنید</option>
                            <option value="مرد">مرد</option>
                            <option value="زن">زن</option>
                        </select>
                    </div>
                    <br />
                    <!-- <div class="form-check form-switch col-md-4" align="start">
                        <input class="form-check-input" type="checkbox" role="switch" id="sampleCheck" value="accepted">
                        <label for="sampleCheck" class="form-check-label">قوانین سایت را می پذیرم.</label>
                    </div> -->
                    <br />
                    <input type="submit" name="submit" class="btn btn-success subBtn" value="ثبت نام" />
                    <br />
                    
                </form>
                <div id="message">

                </div>
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
        <script>
            $(document).ready(function(){
                $("#patient_register").submit(function(event){
                    event.preventDefault();
                    var name = $("#name").val();
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var password_repeat = $("#password_repeat").val();
                    var phone = $("#phone").val();
                    var email = $("#email").val();
                    var gender = $("#gender").val();
                    //var rules = $("#sampleCheck").val();
                    $("#message").load("Includes/RegisterPatient.Include.php",
                    {name: name,
                    username: username,
                    password: password,
                    password_repeat: password_repeat,
                    phone: phone,
                    email: email,
                    gender: gender
                    });

                });
                
            });
        </script>
    </body>
</html>

