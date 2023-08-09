<?php 
session_start();
$id = $_SESSION['user_id'];
include_once("header.php");
$appointmentInfo = new AppointmentView();
$profileInfo = new DoctorView();
$profilePhoto = new ProfileImageView();
$comments = new CommentsView();
?>
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item active">پنل کاربری پزشکان</li>
                </ol>
            </nav>
        </header>
        <div class="py-3" align="center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <nav class="navbar menu px-5">
                            <ul class="navbar-nav me-auto px-4">
                                <li class="nav-item py-2">
                                    <a href="#" class="nav-link active" id="info">اطلاعات کاربری</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a href="#" class="nav-link active" id="addnobat">افزودن نوبت</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a href="#" class="nav-link active" id="reserved">نوبت های رزرو شده</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a href="#" class="nav-link active" id="empty">نوبت های خالی</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a href="#" class="nav-link active" id="comment"> نظرات مراجعه کنندگان</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a href="Includes/Logout.Include.php" class="nav-link active" id="">خروج از حساب کاربری</a>
                                </li>
                            </ul>          
                        </nav>
                    </div>
                    <div class="col-md-8">
                        <div class="info drInfo">
                            <div class="row">
                                <div class="col-md-6 py-3">
                                    <?php 
                                        if($profilePhoto->HasProfileImage($id)){
                                            $path = $profilePhoto->FetchProfileImagePath($id);
                                            echo "<img src='ProfileUploads/Doctors/$path' class='rounded py-1' width='120' height='120'>";
                                        } 
                                        else{
                                            echo "<img src='img/bimarman.jpg' class='rounded' width='120' height='120'>";
                                        }
                                     ?>
                                    <br/>
                                    <input type="button" class="btn editPic" data-bs-toggle="modal" data-bs-target="#nextModal" value="ویرایش تصویر" />
                                    <div class="py-5">
                                        <input type="button" class="btn editPass" data-bs-toggle="modal" data-bs-target="#sampleModal" value="ویرایش اطلاعات" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="drName py-2">
                                    دکتر
                                    <?php $profileInfo->FetchName($_SESSION['user_id']); ?>
                                    </div> 
                                    <br />
                                    <br />
                                    <div class="py-1">
                                        متخصص
                                        <?php $profileInfo->FetchExpertise($_SESSION['user_id']); ?>
                                    </div>
                                    <div>
                                        شماره نظام پزشکی :
                                        <?php $profileInfo->FetchCode($_SESSION['user_id']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        
                        <div class="addnobat" id="addnobat2" style="display: none;" >
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6 py-2" align="end">
                                        اضافه کردن نوبت آزاد در روز
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select selector" name="date" id="addNobat-date">
                                        <?php 
                                            $count = 0;
                                            while($count <= 7){
                                                if(GetSpecificDay($count) != 'جمعه'){
                                                    $selected_date = GetSelectedDate($count);
                                                    if($count == 0){
                                                        echo "<option selected value='$selected_date'>". GetSpecificDate($count). '         '. GetSpecificDay($count)."</option>";
                                                    }
                                                    else{ 
                                                        echo "<option value='$selected_date'>". GetSpecificDate($count). '         '. GetSpecificDay($count)."</option>";
                                                    }
                                                }
                                                else{
                                                    $count++;
                                                    $selected_date = GetSelectedDate($count);
                                                    if($count == 1){
                                                        echo "<option selected value='$selected_date'>". GetSpecificDate($count). '         '. GetSpecificDay($count)."</option>";
                                                    }
                                                    else{
                                                        echo "<option value='$selected_date'>". GetSpecificDate($count). '         '. GetSpecificDay($count)."</option>";
                                                    }
                                                }
                                                $count++;
                                            }
                                        ?>
                                        </select>                                  
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 py-3" align="end">
                                        از ساعت
                                    </div>
                                    <div class="col-md-2 py-3" align="end">
                                        <input type="text" name="start" id="addNobat-start" class="form-control formColor">
                                    </div>
                                    <div class="col-md-2 py-3" align="end">
                                        تا ساعت
                                    </div>
                                    <div class="col-md-2 py-3" align="end">
                                        <input type="text" name="end" id="addNobat-end" class="form-control formColor">
                                    </div>
                                    <div class="col-md-3 py-3" align="end">
                                        <a href="#">
                                            <input type="submit" id="show-table" class="btn viewBtn" value="مشاهده نوبت" />
                                        </a>
                                    </div>
                                </div>

                            </form>
                            <div class="table-responsive" align="center" id="add-nobat">
                               
                                
                            </div>
                            </br>
                            <div id="addNobat-message"></div>
                        </div>
                        
                        <div class="reserved" style="display: none;" >
                            <div class="row">
                                <div class="col-md-4 py-2" align="end">
                                    نوبت های رزرو روز
                                </div>
                                <div class="col-md-7">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <select class="form-select selector" name="reserved-date" id="reserved-date">
                                                    <?php 
                                                    $count = 0;
                                                    while($count <= 7){
                                                        if(GetSpecificDay($count) != 'جمعه'){
                                                            if($count == 0){ ?>
                                                                <option selected value="<?php echo GetSelectedDate($count) ?>"> <?php echo GetSpecificDate($count). '         '. GetSpecificDay($count); ?> </option>
                                                            <?php
                                                            }
                                                            else{ ?>
                                                                <option value="<?php echo GetSelectedDate($count) ?>"><?php echo GetSpecificDate($count). '       '. GetSpecificDay($count); ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        else{
                                                            if($count == 0){
                                                                $count++; ?>
                                                                <option selected value="<?php echo GetSelectedDate($count) ?>"> <?php echo GetSpecificDate($count). '         '. GetSpecificDay($count); ?> </option>
                                                            <?php
                                                            }
                                                            else{
                                                                $count++; ?>
                                                                <option value="<?php echo GetSelectedDate($count) ?>"><?php echo GetSpecificDate($count). '       '. GetSpecificDay($count); ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="submit" name="reserved" id="reserved-btn" class="btn viewBtn" value="مشاهده" /> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive" id="reserved-table" align="center" ></div>
                        </div>
                       
                        <div class="empty" style="display: none;" >
                            <div class="row">
                                <div class="col-md-4 py-2" align="end">
                                    نوبت های آزاد روز
                                </div>
                                <div class="col-md-7">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <select class="form-select selector" name="empty-date" id="empty-date">
                                                    <?php 
                                                    $count = 0;
                                                    while($count <= 7){
                                                        if(GetSpecificDay($count) != 'جمعه'){
                                                            if($count == 0){ ?>
                                                                <option selected value="<?php echo GetSelectedDate($count) ?>"> <?php echo GetSpecificDate($count). '         '. GetSpecificDay($count); ?> </option>
                                                            <?php
                                                            }
                                                            else{ ?>
                                                                <option value="<?php echo GetSelectedDate($count) ?>"><?php echo GetSpecificDate($count). '       '. GetSpecificDay($count); ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        else{
                                                            if($count == 0){
                                                                $count++; ?>
                                                                <option selected value="<?php echo GetSelectedDate($count) ?>"> <?php echo GetSpecificDate($count). '         '. GetSpecificDay($count); ?> </option>
                                                            <?php
                                                            }
                                                            else{
                                                                $count++; ?>
                                                                <option value="<?php echo GetSelectedDate($count) ?>"><?php echo GetSpecificDate($count). '       '. GetSpecificDay($count); ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        $count++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="submit" id="empty-btn" class="btn viewBtn" value="مشاهده" /> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="empty-form">
                                
                            </div>
                            <div id="edit-form">
                                
                            </div>
                        </div>
                        
                        <div class="comment" style="display: none;" >
                            <div class="row">
                                <div class="drcomment">
                                    <h4 class="px-3" align="start">نظرات :</h4>
                                    <div id="comments">
                                        <?php 
                                        $result = $comments->FetchComments($id, 8);
                                        $size = $comments->FetchCommentsSize($id, 8);
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
                                        ?>        
                                    </div>
                                    <input type="button" id="show-comments" class="btn morebtn" value="نمایش بیشتر">                                                                 
                                </div> 
                                
                            </div>
                        </div>

                    </div>
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
        
	    <div class="modal fade" id="sampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>ویرایش اطلاعات</h3>
                    </div>
                        <div class="modal-body" align="center">
                            <div class="container-fluid">
                                <div class="col-md-8">
                                    <form id="edit-doctor-profile" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6" align="start">
                                                <label>نام و نام خانوادگی</label>
                                                <input type="text" id="name" class="form-control formColor" value="<?php $profileInfo->FetchName($id); ?>">
                                            </div>
                                            <div class="col-md-6" align="start">
                                                <label class="form-label" >تخصص</label>
                                                <select class="form-select formColor" id="expertise">
                                                    <?php $exp_code = $profileInfo->GetExpertiseCode($id); ?>
                                                    <option value="1" <?=$exp_code == '1'? 'selected = "select"':'' ?> >متخصص اصفال</option>
                                                    <option value="2" <?=$exp_code == '2'? 'selected = "select"':'' ?>>متخصص تغذیه </option>
                                                    <option value="3" <?=$exp_code == '3'? 'selected = "select"':'' ?>>جراح عمومی</option>
                                                    <option value="4" <?=$exp_code == '4'? 'selected = "select"':'' ?>>متخصص داخلی </option>
                                                    <option value="5" <?=$exp_code == '5'? 'selected = "select"':'' ?>> روان شناسی</option>
                                                    <option value="6" <?=$exp_code == '6'? 'selected = "select"':'' ?>> پزشک عمومی</option>
                                                    <option value="7" <?=$exp_code == '7'? 'selected = "select"':'' ?>> متخصص کلیه</option>
                                                    <option value="8" <?=$exp_code == '8'? 'selected = "select"':'' ?>>متخصص مغز و اعصاب</option>
                                                    <option value="9" <?=$exp_code == '9'? 'selected = "select"':'' ?>>ارتوپدی </option>
                                                    <option value="10"<?=$exp_code == '10'? 'selected = "select"':'' ?>> متخصص پوست و مو</option>
                                                    <option value="11"<?=$exp_code == '11'? 'selected = "select"':'' ?>> متخصص زیبایی</option>
                                                    <option value="12"<?=$exp_code == '12'? 'selected = "select"':'' ?>> متخصص چشم</option>
                                                    <option value="13"<?=$exp_code == '13'? 'selected = "select"':'' ?>> دندان پزشک</option>
                                                    <option value="14"<?=$exp_code == '14'? 'selected = "select"':'' ?>>زنان و زایمان </option>
                                                    <option value="15"<?=$exp_code == '15'? 'selected = "select"':'' ?>>متخصص قلب و عروق </option>
                                                    <option value="16"<?=$exp_code == '16'? 'selected = "select"':'' ?>> متخصص گوش و حلق و بینی</option>
                                                </select>
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
                                        <br/>
                                        <input type="submit" class="btn btn-success subBtn" value="ثبت تغییرات" />
                                        <br/>
                                    </form>
                                    <div class="col-md-6" id="message">

                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger exitModal" data-bs-dismiss="modal">بستن</button>
                        </div>
                    
                </div>
            </div>
        </div>
        <div class="modal fade" id="nextModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>ویرایش تصویر</h3>
                    </div>
                    <form method="post" action="Includes/ProfileImagesEdit.Include.php" enctype="multipart/form-data">
                        <div class="modal-body" align="center">
                            <div class="container-fluid">
                                <div class="col-md-8" align="start">
                                    <label>تصویر نمایه خود را انتخاب کنید.</label>
                                    <input type="file" name="profile_image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success subBtn" value="تغییر تصویر" />
                            <button type="button" class="btn btn-danger exitModal" data-bs-dismiss="modal">بستن</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
	    <script src="js/bootstrap.bundle.js"></script>
        <script src="jquery-3.6.4.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function(){
                $('#edit-doctor-profile').submit(function(event){
                    event.preventDefault();
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

                    $("#message").load("Includes/EditDoctorProfile.Include.php", 
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
                        description: description
                    });
                    
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                $('#show-table').click(function(event){
                    event.preventDefault();
                    var start = $("#addNobat-start").val();
                    var end = $("#addNobat-end").val();
                    var date = $("#addNobat-date").val();
                    $("#add-nobat").load("Includes/ShowNobatTable.Include.php", 
                    {start: start, end: end, selected_date: date});
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                $('#reserved-btn').click(function(event){
                    event.preventDefault();
                    var doctor_id = <?php echo $id ?>;
                    var date = $("#reserved-date").val();
                    $('#reserved-table').load('Includes/ShowReservedAppointments.Include.php',
                    {doctor_id: doctor_id, reserved_date: date});
                }); 
            });
        </script>
    
        <script>
            $(document).ready(function(){
                $('#empty-btn').click(function(event){
                    event.preventDefault();
                    var doctor_id = <?php echo $id ?>;
                    var date = $("#empty-date").val();
                    $('#empty-form').load('Includes/ShowEmptyAppointments.Include.php',
                    {doctor_id: doctor_id, empty_date: date});
                });
            });
        </script>

        <script type="text/javascript">
            function EditBtn(clicked_id)
            {
                var starts = document.getElementsByClassName("start");
                var ends = document.getElementsByClassName("end");
                
                for(var i = 0; i < starts.length; i++) {
                    
                    if(starts[i].id == clicked_id){
                        var start = starts[i].value;
                        break;
                    }                       
                }
                for(var i = 0; i < ends.length; i++) {
                    
                    if(ends[i].id == clicked_id){
                        var end = ends[i].value;
                        break;
                    }                       
                }
                $("#edit-form").load("Includes/EditAppointmentByDoctor.Include.php",
                {appointment_id: clicked_id, start: start, end: end}
                );
                
            }
        </script>

        <script type="text/javascript">
            function DeleteBtn(clicked_id)
            {
                var selected_date = $("#empty-date").val();
                var doctor_id = <?php echo $id ?>;

                $("#edit-form").load("Includes/DeleteAppointmentByDoctor.Include.php",
                {appointment_id: clicked_id, selected_date: selected_date, doctor_id: doctor_id}
                );   
                
                
        }
        </script>

        <script>
            function selectAll(clicked_id){
                var select_all = document.getElementById(clicked_id);
                if(select_all.checked){
                    var checkboxes = document.getElementsByName("checkboxes");
                    for (var i=0; i<checkboxes.length; i++) {
                        checkboxes[i].checked = true;
                    }
                }
                if(select_all.checked == false){
                    var checkboxes = document.getElementsByName("checkboxes");
                    for (var i=0; i<checkboxes.length; i++) {
                        checkboxes[i].checked = false;
                    }
                }
            }
        </script>

        <script>
            function controlSelect(selected_checkbox){
                if(selected_checkbox.checked == false){
                    var my_checkbox = document.getElementById("check_all");
                    my_checkbox.checked = false;
                }                
            }
        </script>

        <script>
            function setAppointment(clicked_id){
                var date = $("#addNobat-date").val();
                var checkboxes = document.getElementsByName("checkboxes");
                var checkboxesChecked = [];
                for (var i=0; i<checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        checkboxesChecked.push(checkboxes[i].value);
                    }
                }
                $("#addNobat-message").load("Includes/AddAppointmentByDoctor.Include.php", 
                {selected_date: date, time_array: checkboxesChecked});

                $("#addNobat-start").val("");
                $("#addNobat-end").val("");
            }
        </script>

        <script>
            $(document).ready(function(){
                var new_limit = 8;
                $("#show-comments").click(function(){
                    var doctor_id = <?php echo $id; ?>;
                    new_limit = new_limit + 2;
                    $("#comments").load("Includes/ShowCommentsForDoctor.Include.php",
                    {doctor_id: doctor_id, limit: new_limit});
                });   
            });
        </script>

        <script>
		    $(document).ready(function(){
			    $('.delBtn').click(function(){
				    $(this).closest('form').remove()
			    })
                $('.editPass').click(function(){
				    $('#sampleModal').modal('show');
			    })
                $('#info').click(function(){
					$('.info').show()
                    $('.addnobat, .reserved, .empty, .comment').hide()
				})
                $('#addnobat').click(function() {
                    $('.addnobat').show();
                    $('.info, .reserved, .empty, .comment').hide()
                })
                $('#reserved').click(function(){
					$('.reserved').show()
                    $('.addnobat, .info, .empty, .comment').hide()
				})
                $('#empty').click(function(){
					$('.empty').show()
                    $('.addnobat, .reserved, .info, .comment').hide()
				})
                $('#comment').click(function(){
					$('.comment').show()
                    $('.addnobat, .reserved, .empty, .info').hide()
				})
                $('.editPic').click(function(){
                    $('#nextModal').modal('show');
                })
		    })
		</script>
    </body>
</html>