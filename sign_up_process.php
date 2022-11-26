<?php
require 'admin/db-handeler/bootstrap.php';
require 'admin/sercurity.php';

if (empty($_POST['customer_email']) || empty($_POST['customer_password']) || empty($_POST['customer_cfm_password'])) {
    header('location:sign_up_form.php?error=Thiếu thông tin!');
    exit;
}
session_start();

$email = $_POST['customer_email'];
$password = $_POST['customer_password'];
$cfm_password = $_POST['customer_cfm_password'];
$sql = "select count(*) from customers where email = '$email'";
$result = $connect_DB->execute_sql($sql);
$num_row = mysqli_fetch_array($result)[0];


$_SESSION['email_input'] = $email;
if ($num_row) {
    header("location:sign_up_form.php?error=Email đã được sử dụng");

    exit;
} else if ($cfm_password != $password) {
    header("location:sign_up_form.php?error=Mật khẩu nhập lại không đúng");
    exit;
} else if (strlen($password) < 8) {
    header("location:sign_up_form.php?error=Mật khẩu gồm tối thiểu 8 kí tự");
    exit;
}
$token = makeToken();
$connect_DB->insert("customers", [
    'email' => "'$email'",
    'password' => "'$password'",
    'token' => "'$token'",
]);
header("location:index.php?success=tạo tài khoản thành công");
exit;
