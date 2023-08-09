<?php
session_start();
include_once "header.php";
$DoctorInfo = new DoctorController();
?>

            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">صفحه اصلی</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle Navigitaion">
                                    <span class="navbar-toggler-icon"></span>
                                </button> 
                            </li>
                            <li class="nav-item px-5">
                                <a href="nobat1.php" class="nav-link active">نوبت دهی آنلاین</a>
                            </li>
                            <li class="nav-item">
                                <a href="poshtibani.php" class="nav-link active">پشتیبانی</a>
                            </li>
                            <li class="nav-item px-5">
                                <a href="ghavanin.php" class="nav-link active">قوانین سایت</a>
                            </li>
                            <form action="nobat3.php" class="d-flex nav-item" method="post">
                                <input id="suggested-name" name="doctor_name" class="form-control me-2" type="search" placeholder="جستجو در سایت...">
                                <button class="btn btn-success subBtn" type="submit">جستجو</button>
                            </form>
                        </ul>
                        <form>
                            <div class="dropdown px-5">
                                <a class="dropdown-toggle nav-link selector" type="button" id="drpBTN" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php if(isset($_SESSION['user_id'])){                        
                                        echo $_SESSION['username'];
                                    }
                                    else{
                                        echo 'ورود به حساب کاربری';
                                    }?>                                  
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="drpBTN">
                                    <?php if(!isset($_SESSION['user_id'])){?>
                                        <li class="dropdown-item">
                                            <a href="voruddoctor.php">ورود به حساب کاربری</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="sabtebimar.php">ساخت حساب جدید</a>
                                        </li>
                                    <?php }
                                    else{ 
                                        if($_SESSION['type'] == "doctor"){ ?>
                                            <li class="dropdown-item">
                                                <a href="paneldoctor.php">ورود به حساب کاربری</a>
                                            </li>
                                         <?php
                                        }
                                        elseif($_SESSION['type'] == "patient"){ ?>
                                            <li class="dropdown-item">
                                                <a href="panelbimar.php">ورود به حساب کاربری</a>
                                            </li>
                                        <?php } 
                                        elseif($_SESSION['type'] == "admin")  { ?>
                                            <li class="dropdown-item">
                                                <a href="panelmodir.php">ورود به حساب کاربری</a>
                                            </li>
                                        <?php }
                                        elseif($_SESSION['type'] == "support")  { ?>
                                            <li class="dropdown-item">
                                                <a href="panelposhtiban.php">ورود به حساب کاربری</a>
                                            </li>
                                        <?php }            
                                        ?>        
                                        <li class="dropdown-item">
                                            <a href="Includes/Logout.Include.php">خروج</a>
                                        </li>
                                    <?php }?>    
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <div id="suggestion"></div>
            
        </header>
        <div class="py-3" align="center">
            <div class="container">
                <div id="firstCarousel" class="carousel slide col-8 carousel-fade" data-bs-ride="carousel" data-bs-interval="true" data-bs-pause="hover">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#firstCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="اسلاید 1"></button>
                        <button type="button" data-bs-target="#firstCarousel" data-bs-slide-to="1" aria-label="اسلاید 2"></button>
                        <button type="button" data-bs-target="#firstCarousel" data-bs-slide-to="2" aria-label="اسلاید 3"></button>
                        <button type="button" data-bs-target="#firstCarousel" data-bs-slide-to="3" aria-label="اسلاید 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="3000">
                            <img src="img/clinic.jpg" class="d-block image">
                            <div class="carousel-caption d-none d-md-block imageHeader">
                                <h3>بهترین کلینیک، با بهترین خدمات</h3>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="img/kadr.png" class="d-block image">
                            <div class="carousel-caption d-none d-md-block imageHeader">
                                <h3>کادری مجرب و متخصص</h3>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="img/tajhiz.jpg" class="d-block image">
                            <div class="carousel-caption d-none d-md-block imageHeader">
                                <h3>پیشرفته ترین تجهیزات</h3>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="3000">
                            <img src="img/salon.jpg" class="d-block image">
                            <div class="carousel-caption d-none d-md-block imageHeader">
                                <h3>ضامن آرامش و سلامتی شما</h3>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#firstCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">قبلی</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#firstCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">بعدی</span>
                    </button>
                </div>
                <br />
                <div align="start">
                    کلینیک سلامت در سال 1402 افتتاح شد و با بکارگیری بهترین تجهیزات و همکاری با مجرب ترین کادر استان گیلان توانسه رضایت 94 درصدی از مراجعان خود دریافت کند.
                    این کلینیک شامل 90 درصد شاخه های پزشکی می شود. و با قرار گرفتن در بهترین نقطه مکانی شهر، آرامش شما را تضمین می کند.
                    <br />
                    <span class="imp">اعتبار ما، رضایت شماست.</span>
                </div>
                <div align="end">
                    <a class="btn btn-success subBtn" href="nobat1.php">برای دریافت نوبت کلیک کنید...</a>
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
                $("#suggested-name").keyup(function(){
                    var doctor_name = $("#suggested-name").val();
                    $("#suggestion").load("Includes/MainPageSuggestion.Include.php", 
                    {suggested_name: doctor_name});
                    
                });
            });
        </script>

        <script>
            function SelectSuggestion(clicked_name){
                $("#suggested-name").val(clicked_name);
            }
        </script>
    </body>
</html>
       