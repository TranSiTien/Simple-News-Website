<?php
require "./admin/db-handeler/bootstrap.php";
session_start();
if (isset($_COOKIE['token'])) {

    $token = $_COOKIE['token'];
    $sql = "select id from customers where token = '$token'";
    $result = $connect_DB->execute_sql($sql);
    $arr = mysqli_fetch_assoc($result);
    if ($arr) {
        if ($_SESSION["id"] == $arr["id"]) {
            header("location:customer_home.php?success=Đăng nhập lại thành công");
            exit;
        }
    }
}
?>

<a href="sign_up_form.php">Đăng kí</a>
<a href="login_form.php">Đăng nhập</a>