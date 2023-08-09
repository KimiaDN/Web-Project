<html dir="rtl">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>کلینیک سلامت</title>
        <link rel="stylesheet" href="css/bootstrap.rtl.css">
	    <link type="text/css" rel="stylesheet" href="tarikhchemodir.css">
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
                    <li class="breadcrumb-item"><a href="asli.php">صفحه اصلی</a></li>
                    <li class="breadcrumb-item"><a href="panelmodir.php">پنل کاربری مدیر</a></li>
                    <li class="breadcrumb-item active">تاریخچه نوبت ها</li>
                </ol>
            </nav>
        </header>
        <div class="py-2">
            <div class="container">
                <h3 class="py-2" align="start">تاریخچه نوبت ها</h3>
                <div class="row">
                    <div class="col-md-3" align="end">
                    </div>
                    <div class="col-md-6" align="end">
                        <input type="text" id="doctor-name-suggest" class="form-control formColor" placeholder="جستجوی پزشک">
                    </div>
                    <div class="col-md-2" align="start">
                        <button id="search-doctorName" class="btn btn-success subBtn" type="submit">جستجو</button>
                    </div>
                    
                </div>
                 <!-- برای ساجسشن سرچ -->
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" id="suggestion"></div>
                </div>
                
               
                <br />
                <div class="col-md_10">
                    <div class="table-responsive" align="center" id="show-appointments">
                       
                    </div>
                    <div id="message"></div>
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

        <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" 
            crossorigin="anonymous">
        </script>

        <script>
            $(document).ready(function(){
                $("#search-doctorName").click(function(){
                    var doctor_name = $("#doctor-name-suggest").val();
                    $("#show-appointments").load("Includes/ShowAppointmentsToAdmin.Include.php",
                        {doctor_name: doctor_name}
                    );
                });
            });
        </script>

        <script>
            $(document).ready(function(){
                $("#doctor-name-suggest").keyup(function(){
                    var doctor_name = $("#doctor-name-suggest").val();
                    $("#suggestion").load("Includes/SuggestDoctorName.Include.php", 
                    {doctor_name: doctor_name});
                    
                });
            });
        </script>

        <script>
            function SelectSuggestion(clicked_name){
                $("#doctor-name-suggest").val(clicked_name);
                $("#suggestion").html("");
            }
        </script>

        <script>
            function DeleteAppointment(clicked_id){
                var doctor_name = $("#doctor-name-suggest").val();
                $("#message").load("Includes/CancelReservation.Include.php", 
                    {appointment_id: clicked_id}
                );
                $("#show-appointments").load("Includes/ShowAppointmentsToAdmin.Include.php",
                    {doctor_name: doctor_name});
            }
        </script>
    </body>
</html>
