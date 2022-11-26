<?php
//delete all session variables
session_unset();

// destroy the session
session_destroy();
setcookie("admin_token", "", time() - 1);
header("location:index.php?success:Đăng xuất thành công");
