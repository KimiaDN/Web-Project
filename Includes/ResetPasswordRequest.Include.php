<?php 
include_once("../Config.php");


//Set ResetPasswords Info
$user_email = $_POST['email'];
$selector = bin2hex(random_bytes(8));
$token = random_bytes(32);

$url ="http://localhost/Final%20Project/ResetPassword.php?selector=".$selector
        ."&validator=".bin2hex($token);

$expire_time = date("U") + 1000;

//Add information to the database
$reset_password = new ResetPasswordController($user_email, $selector, $token, $expire_time);
$message = new Message();

$message = $reset_password->SetResetPassword();

//Send an email
$to = $user_email;
$subject = "ایمیل بازیابی رمز عبور";
$content = "<p>درخواست بازیابی رمز عبور با موفقیت دریافت شد. 
لطفا وارد لینک زیر شده و نسبت به بازسازی رمز عبور خود اقدام نمایید. </p>";
$content .= "<p>در صورتی که درخواست از جانب شما ارسال نشده است به آن توجهی نکنید</p>";
$content .= "<a href='$url'>لینک بازیابی رمز عبور</a>";

$headers  = "From: kdarvishnoori@gmail.com\r\n";
$headers .= "Reply-To: kdarvishnoori@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";

//echo phpinfo();
mail($to, $subject, $content, $headers);


if($message->GetMessageType()){
    ShowNotification($message->GetMessage(), 1, "450px", "50px");
}else{
    ShowNotification($message->GetMessage(), 0, "450px", "50px");
}


