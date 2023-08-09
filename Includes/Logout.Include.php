<?php
session_start();
session_unset();
session_destroy();

header("location: ../asli.php?error=noerror");
exit();