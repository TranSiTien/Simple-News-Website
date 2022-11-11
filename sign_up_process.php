<?php
require 'admin/db-handeler/bootstrap.php';
if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['cfm_password'])) {
    header('location:sign_up_form.php?error=Thiếu thông tin!');
    exit;
}


$email = $_POST['email'];
$password = $_POST['password'];
$cfm_password = $_POST['cfm_password'];
$sql = "select count(*) from customers where email = '$email'";
$result = $connect_DB->execute_sql($sql);
$num_row = mysqli_fetch_array($result)[0];
$token = openssl_random_pseudo_bytes(20);
$token = bin2hex($token);

if ($num_row) {
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    header("location:sign_up_form.php?error=Email đã được sử dụng");

    exit;
} else if ($cfm_password != $password) {
    header("location:sign_up_form.php?error=Mật khẩu nhập lại không đúng");
    exit;
} else if (strlen($password) < 8) {
    header("location:sign_up_form.php?error=Mật khẩu gồm tối thiểu 8 kí tự");
    exit;
}

$connect_DB->insert("customers", [
    'email' => "'$email'",
    'password' => "'$password'",
    'token' => "'$token'",
]);

header("location:index.php?success=tạo tài khoản thành công");
