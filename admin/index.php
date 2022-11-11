<a href="./news/index.php">Danh sách bài đăng</a>
<?php
require "db-handeler/bootstrap.php";
session_start();

if (isset($_COOKIE['admin_token'])) {

    $token = $_COOKIE['admin_token'];
    $sql = "select id, name from admin where token = '$token'";
    $result = $connect_DB->execute_sql($sql);
    $arr = mysqli_fetch_assoc($result);
    if ($arr) {
        $_SESSION['admin_id'] = $arr['id'];
        $_SESSION['admin_name'] = $arr['name'];
    } else {
        header("location:login_form.php?success=Đăng nhập lại thành công");
        exit;
    }
} else {
    header("location:login_form.php");
    exit;
} ?>
<h1>Chào admin: <?= $_SESSION['admin_name'] ?></h1>
<a href="news/index.php">Danh sách bài đăng</a>
<a href="logout_process.php">Đăng xuất</a>