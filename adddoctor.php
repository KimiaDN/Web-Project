<?php include_once("header.php"); ?>
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item"><a href="panelmodir.php">پنل کاربری مدیر</a></li>
                    <li class="breadcrumb-item active">اضافه کردن پزشک</li>
                </ol>
            </nav>
            <script>
                $(document).ready(function(){
                    $("#add-doctor").submit(function(event){
                        event.preventDefault();
                        var name = $("#name").val();
                        var username = $("#username").val();
                        var code = $("#code").val();
                        var expertise = $("#expertise").val();
                        var password = $("#password").val();
                        var password_repeat = $("#password_repeat").val();
                        var phone = $("#phone").val();
                        var email = $("#email").val();
                        var gender = $("#gender").val();
                        var address = $("#address").val();
                        $("#message").load("Includes/RegisterDoctor.Include.php",
                        {name: name,
                        username: username,
                        password: password,
                        password_repeat: password_repeat,
                        phone: phone,
                        code: code,
                        expertise: expertise,
                        address: address,
                        email: email,
                        gender: gender
                        });

                    });
                    
                });
            </script>
        </header>
        <div class="py-3">
            <div class="container" align="center">
                <div class="col-md-9">
                    <form id="add-doctor" method="post">
                        <div class="row">
                            <div class="col-md-6" align="start">
                                <label>نام و نام خانوادگی</label>
                                <input type="text" id="name" class="form-control formColor">
                            </div>
                            <div class="col-md-6" align="start">
                                <label>شماره نظام</label>
                                <input type="text" id="code" class="form-control formColor">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" align="start">
                                <label>نام کاربری</label>
                                <input type="text" id="username" class="form-control formColor">
                            </div>
                            <div class="col-md-6" align="start">
                                <label>آدرس</label>
                                <input type="text" id="address" class="form-control formColor">
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6" align="start">
                                <label>رمز عبور</label>
                                <input type="password" id="password" class="form-control formColor">
                            </div>
                            <div class="col-md-6" align="start">
                                <label>تکرار رمز عبور</label>
                                <input type="password" id="password_repeat" class="form-control formColor">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" align="start">
                                <label>شماره تماس</label>
                                <input type="tel" id="phone" class="form-control formColor">
                            </div>
                            <div class="col-md-6" align="start">
                                <label>ایمیل</label>
                                <input type="email" id="email" class="form-control formColor">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" align="start">
                                <label class="form-label">جنسیت</label>
                                <select class="form-select formColor selector" id="gender">
                                    <option selected disabled value="">انتخاب کنید</option>
                                    <option value="مرد">مرد</option>
                                    <option value="زن">زن</option>
                                </select>
                            </div>
                            <div class="col-md-6" align="start">
                                <label class="form-label" >تخصص</label>
                                <select class="form-select formColor selector" id="expertise">
                                    <option selected value="0">انتخاب کنید</option>
                                    <option value="1">متخصص اصفال</option>
                                    <option value="2">متخصص تغذیه </option>
                                    <option value="3">جراح عمومی</option>
                                    <option value="4">متخصص داخلی </option>
                                    <option value="5"> روان شناسی</option>
                                    <option value="6"> پزشک عمومی</option>
                                    <option value="7"> متخصص کلیه</option>
                                    <option value="8">متخصص مغز و اعصاب</option>
                                    <option value="9">ارتوپدی </option>
                                    <option value="10"> متخصص پوست و مو</option>
                                    <option value="11"> متخصص زیبایی</option>
                                    <option value="12"> متخصص چشم</option>
                                    <option value="13"> دندان پزشک</option>
                                    <option value="14">زنان و زایمان </option>
                                    <option value="15">متخصص قلب و عروق </option>
                                    <option value="16"> متخصص گوش و حلق و بینی</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <input type="submit" name="submit" class="btn btn-success subBtn" value="اضافه کردن پزشک" />
                        <br />
                    </form>
                    <div id="message"></div>
                </div>
            </div>
        </div>
        <?php include_once("footer.php"); ?>
</html>