<?php
session_start();
echo "hello User: " . $_SESSION['id'];
?>
<a href="logout_process.php">Đăng xuất</a>