<?php 
include_once("header.php");

if(isset($_POST['doctor_id'])){
    $doctor_id = $_POST['doctor_id'];
}
else if(isset($_POST['doctor_name'])){
    $doctor = new DoctorController();
    $doctor_id = $doctor->ReadDoctorIDByName($_POST['doctor_name']);
}

$DoctorInfo = new DoctorView();
$comments = new CommentsView();
$patient_profile = new PatientView();
$profilePhoto = new ProfileImageView();

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
                <div class="row">
                    <div class="col-md-5">
                    <div class="drInfo">
                            <div class="row">
                                <div class="col-md-5" align="end">
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
                                <div class="col-md-7 drName">
                                    دکتر
                                    <?php echo $DoctorInfo->FetchName($doctor_id); ?>
                                </div>
                            </div>
                            متخصص 
                            <?php echo $DoctorInfo->FetchExpertise($doctor_id); ?>
                            <br />
                            شماره نظام پزشکی :
                            <?php echo $DoctorInfo->FetchCode($doctor_id); ?>
                            <br />
                            <br />
                            آدرس دقیق :
                            <?php echo $DoctorInfo->FetchAddress($doctor_id); ?>
                            <br />
                            شماره تماس :
                            <?php echo $DoctorInfo->FetchPhone($doctor_id); ?>
                            <br />
                            <br />
                            درباره دکتر : </br>
                            <?php echo $DoctorInfo->FetchDescription($doctor_id); ?>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div id="comments" class="drcomment">
                                <h4 class="px-3" align="start">نظرات :</h4>
                                <div id="submited-comments">
                                    <?php 
                                        $results = $comments->FetchComments($doctor_id, 2);
                                        $size = $comments->FetchCommentsSize($doctor_id, 2);
                                        if($size > 0){           
                                            $counter = 0;
                                            while($counter < $size){
                                                $patient_id = $results[$counter]['patient_id'];
                                                $rate = $results[$counter]['rate'];
                                                $message = $results[$counter]['message'];
                                                ?>
                                                <div class="row px-3" align="start">
                                                    <div class="col-md-1 py-2">
                                                        <?php if($patient_profile->HasProfilePhoto($patient_id) == true){
                                                            echo "<img src='ProfileUploads/Patients/profile";$patient_profile->FetchPhone($patient_id); echo "'.jpg' class='rounded py-1' width='35' height='35'>";
                                                        }
                                                        else{
                                                            echo "<img src='img/doctorwoman.jpg' class='rounded py-1' width='35' height='35'>";
                                                        } 
                                                        ?>                    
                                                    </div>
                                                    <div class="col-md-8 px-5">
                                                        <div class="row namesize">
                                                            <?php $patient_profile->FetchUsername($patient_id) ?>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5 px-1">
                                                                <?php $rate_counter = 0;
                                                                while($rate_counter < $rate){
                                                                    echo "<span class='fa fa-star checked'></span>";
                                                                    $rate_counter++;
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <?php echo $message; ?>
                                                    </div>
                                                </div>
                                            <?php 
                                                $counter++;
                                            }
                                        }else{
                                            echo "نظری ثبت نشده است";
                                        }
                                        ?>
                                </div>
                                
                                <input type="button" id="show-comments" class="btn morebtn" value="نمایش بیشتر"> 
                                <i class="arrow down"></i>
                                <form id="add-comments">
                                    <div class="row" align="center">
                                        <div class="col-md-3 py-1"> 
                                            <div class="rating" >
                                                <input type='radio' hidden name='rate' class="rate"  value="5" id='rating-opt5-2' data-idx='0'>
                                                <label for='rating-opt5-2'></label>
                                          
                                                <input type='radio' hidden name='rate' class="rate"  value="4" id='rating-opt4-2' data-idx='1'>
                                                <label for='rating-opt4-2'></label>
                                          
                                                <input type='radio' hidden name='rate' class="rate"   value="3" id='rating-opt3-2' data-idx='2'>
                                                <label for='rating-opt3-2'></label>
                                          
                                                 <input type='radio' hidden name='rate' class="rate" value="2" id='rating-opt2-2' data-idx='3'>
                                                 <label for='rating-opt2-2'></label>
                                          
                                                <input type='radio' hidden name='rate' class="rate"  value="1" id='rating-opt1-2' data-idx='4'>
                                                 <label for='rating-opt1-2'></label>
                                            </div>
                                        </div>
                                        <div class="col-md-7 py-1">
                                            <input type="text" class="form-control" id="message" name="message" placeholder="نظر خود را ثبت کنید..." />
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-2">
                                    <button name="submit-comment" class="btn btn-success subBtn" id="btn"> ثبت نظر </button>
                                </div>
                                <br/>
                                <div id="set-nothing"></div>
                                <br/>
                            </div> 
                        </div>
                        <div class="row py-5">
                            <div class="drnobat">
                                <div class="row">
                                    <div class="col-md-4 py-2" align="end">
                                         نوبت های آزاد روز
                                    </div>
                                    <div class="col-md-6">
                                        <form id="select-date" method="post">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <select class="form-select selector" name="selected_date" id="selected_date">
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
                                                    <input type="submit" name="show_appointments" class="btn viewBtn" value="مشاهده" /> 
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="show_nobat"></div>  
                                <div id="reserve-result"></div>
                                <div id="notification"></div>                           
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
	    <script src="js/bootstrap.bundle.js"></script>
        <script src="jquery-3.6.4.js"></script>
        <script>
            $(document).ready(function(){
                var set_rate = 0;
                $("#rating-opt5-2").click(function(){
                    set_rate = 5;
                });   
                $("#rating-opt4-2").click(function(){
                    set_rate = 4;
                });
                $("#rating-opt3-2").click(function(){
                    set_rate = 3;
                });
                $("#rating-opt2-2").click(function(){
                    set_rate = 2;
                });
                $("#rating-opt1-2").click(function(){
                    set_rate = 1;
                });            

                $("#btn").click(function(){
                    var doctor_id = <?php echo $doctor_id; ?>;
                    var message = $("#message").val();
                    var rate = set_rate;
                    $("#set-nothing").load("Includes/AddComments.Include.php",
                    {doctor_id: doctor_id,  message: message, rate: rate});                      
                    $("#message").val(""); 
                    $("#rating-opt5-2").prop('checked', false);     
                    $("#rating-opt4-2").prop('checked', false);   
                    $("#rating-opt3-2").prop('checked', false);   
                    $("#rating-opt2-2").prop('checked', false);   
                    $("#rating-opt1-2").prop('checked', false);       
                    var doctor_id = <?php echo $doctor_id; ?>;
                    var limitation = 10;
                    $("#submited-comments").load("Includes/ShowComments.Include.php",
                    {doctor_id: doctor_id, limit: limitation});
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                var new_limit = 2;
                $("#show-comments").click(function(){
                    var doctor_id = <?php echo $doctor_id; ?>;
                    new_limit = new_limit + 2;
                    $("#submited-comments").load("Includes/ShowComments.Include.php",
                    {doctor_id: doctor_id, limit: new_limit});
                });               
            });
        </script>

        <script>
            $(document).ready(function(){
                $("#select-date").submit(function(event){
                    event.preventDefault();
                    var selected_date = $("#selected_date").val();
                    var doctor_id =  <?php echo $doctor_id; ?>;
                    $("#show_nobat").load("Includes/ShowEmptyAppointmentForPatient.Include.php",
                    {selected_date: selected_date, doctor_id: doctor_id});
                    
                });               
            });
        </script>


        <script type="text/javascript">
        function ReserveBtn(clicked_id)
        {
            var selected_date = $("#selected_date").val();
            $("#reserve-result").load("Includes/ReserveAppointment.Include.php",
            {appointment_id: clicked_id, selected_date: selected_date}
            );
        }
        </script>

        
    </body>
</html>
