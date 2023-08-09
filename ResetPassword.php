<?php include_once("header.php"); 
$message = new Message();
?>
            <nav>
                <ol class="breadcrumb px-3 bg-light">
                    <li class="breadcrumb-item active">بازیابی رمز عبور</li>
                </ol>
            </nav>
        </header>
        <div class="py-3">
            <div class="container" align="center">
                <?php
                    $selector = $_GET['selector'];
                    $validator = $_GET['validator'];
                    if(empty($selector) || empty($validator)){
                        $message->SetMessageType(false);
                        $message->SetMessage("خطایی رخ داده است");
                        ShowNotification($message->GetMessage(), 1, "450px", "50px");
                    }
                    else{
                        if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                            ?>
                            <form id="reset-password" method="post">
                                <div class="col-md-4" align="start">
                                    <label>رمز عبور:</label>
                                    <input type="password" name="password" class="form-control formColor">
                                </div>
                                <br />
                                <div class="col-md-4" align="start">
                                    <label>تکرار رمز عبور: </label>
                                    <input type="password" name="repeat_password" class="form-control formColor">
                                </div>
                                <br />
                                <input type="submit" name="submit-password" class="btn btn-success subBtn" value="ثبت رمز عبور" />
                            </form>
                        <?php
                        }
                    }
                    if(isset($_POST['submit-password'])){
                        $password = $_POST['password'];
                        $repeat_password = $_POST['repeat_password'];
    
                        $reset_password = new ResetPasswordController("", "", "", "");
                        $reset_pwd_info = new ResetPasswordView();
                        $message = new Message();
                        $success = false;
    
                        $message = $reset_password->CheckUserAuthentication($selector, $validator);
                        if($message->GetMessageType()){
                            $patient = new PatientController();
                            $email = $reset_pwd_info->FetchEmail($selector);
                            $message = $patient->ResetPatientPassword($email, $password, $repeat_password);
                            if($message->GetMessageType()){
                                $reset_password->RemoveResetPassword($email);
                                ShowNotification($message->GetMessage(), 1, "450px", "50px");
                            }else{
                                ShowNotification($message->GetMessage(), 0, "450px", "50px");
                            }
                        }else{
                            ShowNotification($message->GetMessage(), 0, "450px", "50px");
                        }
                    }
                 ?>
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
                            <form>
                                <div class="col-md-8" align="start">
                                    <label>کد ارسالی به موبایل خود را وارد نمایید.</label>
                                    <input type="text" class="form-control formColor">
                                    <br />
                                </div>
                                <a href="panelbimar.html">
                                    <input type="submit" class="btn btn-success subBtn" value="ورود با کد یکبار مصرف" />
                                </a>
                            </form>
                        </div>
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
    </body>
</html>