<?php 
include_once("header.php");
session_start();
$id = $_SESSION['user_id'];
$profileInfo = new PatientView();
$profileImageIInfo = new ProfileImageView();
$message = new Message();
$message->SetMessage("");

?>
<html dir="rtl">

            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item active">پنل کاربری مراجعه کنندگان</li>
                </ol>
            </nav>
        </header>
        <div class="py-3" align="center">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="bimarInfo">
                            <?php
                                if(!empty($message->GetMessage())){
                                    if($mesaage->GetMessageType()){
                                        ShowNotification($mesaage->GetMessage(), 1, "450px", "50px");
                                    }else{
                                        ShowNotification($mesaage->GetMessage(), 0, "450px", "50px");
                                    }
                                }
                             ?>
                            <div class="row">
                                <div class="col-md-6 py-1">
                                    <?php 
                                        if($profileImageIInfo->HasProfileImage($id)){ 
                                            $path = $profileImageIInfo->FetchProfileImagePath($id);
                                            echo "<img src='ProfileUploads/Patients/$path' class='rounded py-1' width='120' height='120'>";
                                        } else{ 
                                            echo "<img src='img/bimarman.jpg' class='rounded' width='120' height='120'>";
                                        }
                                    ?>
                                    <div class="col-md-8">
                                        <a class="btn editPic" data-bs-toggle="modal" data-bs-target="#newModal" href="#">ویرایش تصویر</a>
                                    </div>
                                </div>
                                <div class="col-md-6 bimarName py-4">
                                    <?php $profileInfo->FetchName($id) ?>
                                 </div>
                            </div>
                            <div class="col-md-10">
                                <div>
                                    نام کاربری : 
                                    <?php $profileInfo->FetchUsername($id) ?>
                                </div>
                                <div>
                                    شماره تماس : 
                                    <?php $profileInfo->FetchPhone($id) ?>
                                </div>
                                <div>
                                    ایمیل : 
                                    <?php $profileInfo->FetchEmail($id) ?>
                                </div>
                                <div class="py-2" align="center">
                                    <input type="button" class="btn editPass" data-bs-toggle="modal" data-bs-target="#sampleModal" value="ویرایش اطلاعات" />
                                </div>
                                <div class="py-1" align="center">
                                    <a type="submit" class="btn btn-danger exitBtn" href="Includes/Logout.Include.php">خروج از حساب کاربری </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" align="start">
                        <div class="row">
                            <div class="col-md-4" align="end">
                                <h3 class="py-1">تاریخچه نوبت های</h3>
                            </div>
                            <div class="col-md-8" align="start">
                                <form id="show-appointment" method="post">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select id="select" class="form-select selector"  >
                                                <option selected value="active">فعال</option>
                                                <option value="not-active">انجام شده</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" class="btn viewBtn" value="مشاهده" /> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div id="show-history" class=" col-md_10">
                        <div id="history-message"></div>
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
                                <form action = "Includes/ProfileImagesEdit.Include.php" id="patient_edit_profile" method="post">
                                    <div class="row">
                                        <div class="col-md-6" align="start">
                                            <label>نام و نام خانوادگی</label>
                                            <input type="text" id="name" class="form-control formColor" value="<?php $profileInfo->FetchName($id); ?>">
                                        </div>
                                        <div class="col-md-6" align="start">
                                            <label>نام کاربری</label>
                                            <input type="text" id="username" class="form-control formColor" value="<?php $profileInfo->FetchUsername($id); ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" align="start">
                                            <label>رمز عبور</label>
                                            <input type="password" id="password" class="form-control formColor">
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
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success subBtn" value="ثبت تغییرات" />
                                        <button type="button" class="btn btn-danger exitModal" data-bs-dismiss="modal">بستن</button>
                                    </div>              
                                </form>
                                <div id="edit-message"></div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="modal fade" id="newModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>ویرایش تصویر</h3>
                    </div>
                    
                        <div class="modal-body" align="center">
                            <form action="Includes/ProfileImagesEdit.Include.php" method="post"  enctype="multipart/form-data">
                                <div class="container-fluid">
                                    <div class="col-md-8" align="start">
                                        <label>تصویر نمایه خود را انتخاب کنید.</label>
                                        <input type="file" name="profile_image" class="form-control">
                                    </div>
                                </div>
                                    </br>
                                <input type="submit" name="submit_image" class="btn btn-success subBtn" value="تغییر تصویر" />
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger exitModal" data-bs-dismiss="modal">بستن</button>
                        </div>
                    
                </div>
            </div>
        </div>
        <script src="js/bootstrap.bundle.js"></script>
        <script src="jquery-3.6.4.js"></script>
        
        <script>
            $(document).ready(function(){
                $('.editPass').click(function(){
                    $('#sampleModal').modal('show');
                })
                $('.editPic').click(function(){
                    $('#newModal').modal('show');
                })
            })
        </script>
        <script>
            $(document).ready(function(){
                $("#patient_edit_profile").submit(function(event){
                    event.preventDefault();
                    var name = $("#name").val();
                    var username = $("#username").val();
                    var password = $("#password").val();
                    var repeat_password = $("#repeat_password").val();
                    var phone = $("#phone").val();
                    var email = $("#email").val();
                    $("#edit-message").load("Includes/EditPatientProfile.Include.php",
                    {name: name,
                    username: username,
                    password: password,
                    repeat_password: repeat_password,
                    phone: phone,
                    email: email
                    });

                });
                
            });
        </script>

        <script>
            $(document).ready(function(){
                $("#show-appointment").submit(function(event){
                    event.preventDefault();
                    var type = $("#select").val();
                    var patient_id = <?php echo $id; ?>;
                    $("#show-history").load("Includes/ShowPatientProfileAppointments.Include.php",
                    {type: type,
                    patient_id: patient_id
                    });
                });             
            });
        </script>

        <script>
            function CancleReserve(clicked_id){
                var type = $("#select").val();
                var patient_id = <?php echo $id; ?>;

                $("#history-message").load("Includes/CancelReservation.Include.php",
                    {appointment_id: clicked_id});
                
                $("#show-history").load("Includes/ShowPatientProfileAppointments.Include.php",
                {type: type,
                patient_id: patient_id
                });
            }
        </script>
        
    </body>
</html>
