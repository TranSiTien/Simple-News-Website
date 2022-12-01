<?php
// if user log out then delete cookie and session
//delete all session variables

session_start();
session_unset();
//destroy the session

session_destroy();
setcookie("customer_token", "", time() - 3600);

header("location:/?success:Đăng xuất thành công");
