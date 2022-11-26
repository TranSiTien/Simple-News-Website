<?php
require "db-handeler/bootstrap.php";
require "sercurity.php";



session_start();

// check if user is choose remember me before
// if there were update a new token for user set email, id and name to session
if (isset($_COOKIE['admin_token'])) {

    $token = $_COOKIE['admin_token'];
    $sql = "select id, name, email from admin where token = '$token'";
    $result = $connect_DB->execute_sql($sql);
    $arr = mysqli_fetch_assoc($result);

    //if there are no admin with this token in database then redirect to login page
    if ($arr) {
        $_SESSION['admin_email'] = $arr['id'];
        $_SESSION['admin_id'] = $arr['id'];
        $_SESSION['admin_name'] = $arr['name'];
    } else {
        header("location:login_form.php?error=Vui lòng đăng nhập");
        exit;
    }
} else {
    header("location:login_form.php?error=Vui lòng đăng nhập");
    exit;
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>

<body>
    <!-- navigation bar -->
    <a href="news/index.php">Danh sách bài đăng</a>
    <a href="logout_process.php">Đăng xuất</a>

    <!-- content -->
    <h1>UID: <?= $_SESSION['admin_id'] ?></h1>
    <h1>Chào admin: <?= $_SESSION['admin_name'] ?></h1>
</body>

</html>