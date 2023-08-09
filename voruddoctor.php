<?php 
include_once("header.php"); 
?>
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item active">ورود کاربران </li>
                </ol>
            </nav>
        </header>
        <div class="py-3">
            <div class="container" align="center">
                <form id="login" method="post">
                    <div class="col-md-4" align="start">
                        <label>نام کاربری</label>
                        <input type="text" name="username" class="form-control formColor">
                    </div>
                    <br />
                    <div class="col-md-4" align="start">
                        <label>رمز عبور</label>
                        <input type="password" name="password" class="form-control formColor">
                    </div>
                    <div class="form-check col-md-4" align="start">
                        <input class="form-check-input" type="checkbox" id="sampleCheck" data-bs-toggle="modal" data-bs-target="#newModal">
                        <label for="sampleCheck" class="form-check-label">رمز عبور خود را فراموش کرده ام.</label>
                    </div>
                    <br />
                    <input type="submit" name="submit" class="btn btn-success subBtn" value="ورود" />
                </form>
                <div id="message">
                    <?php
                        if(isset($_POST['submit'])){
                            $username = $_POST['username'];
                            $password = $_POST['password'] ;
                            
                            $doctor = new DoctorController();
                            $message = new Message();
                            $doctor->username = $username;
                            $doctor->password = $password;
                            $message = $doctor->UsersLogin();
                            if($message->GetMessageType() == true){
                                header("location: asli.php");
                            }
                            else if($message->GetMessageType() == false){
                                $patient = new PatientController();
                                $patient->username = $username;
                                $patient->password = $password;
                                $message = $patient->PatientLogin();
                                if($message->GetMessageType() == true){
                                    header("location: asli.php");
                                }
                                else{
                                    ShowNotification($message->GetMessage(), 0, "450px", "50px");
                                }
                            }    
                        }
                     ?>
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
        <div class="modal fade" id="newModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>فراموشی رمز عبور</h3>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="container-fluid">
                            <form id="reset-password" method="post">
                                <div class="col-md-8" align="start">
                                    <label>لطفا آدرس ایمیل خود را وارد کنید</label>
                                    <input type="text" id="email" class="form-control formColor">
                                    <br />
                                </div>
                                <a href="panelbimar.html">
                                    <input type="submit" class="btn btn-success subBtn" value="تایید ایمیل" />
                                </a>
                            </form>
                        </div>
                        <div id="request-message"></div>
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
                $('#sampleCheck').click(function(){
                    $('#newModal').modal('show');
			    })    
		    })
		</script>

        <script>
		    $(document).ready(function(){
                $('#reset-password').submit(function(event){
                    event.preventDefault();
                    var email = $("#email").val();

                    $("#request-message").load("Includes/ResetPasswordRequest.Include.php",
                    {email: email});
			    })    
		    })
		</script>
    </body>
</html>