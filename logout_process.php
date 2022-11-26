<?php
//delete all session variables

session_start();
session_unset();
//destroy the session

session_destroy();
setcookie("customer_token", "", time() - 3600);
header("location:index.php?success:Đăng xuất thành công");
