<?php


require 'admin/db-handeler/bootstrap.php';
if (empty($_POST['email']) || empty($_POST['password'])) {
    header('location:sign_up_form.php?error=Thiếu thông tin!');
    exit;
}


$email = $_POST['email'];
$password = $_POST['password'];
if (isset($_POST['remember'])) {
    $remember = true;
} else {
    $remember = false;
}
$sql = "select id, token from customers where email = '$email' and password = '$password'";
$result = $connect_DB->execute_sql($sql);
$arr = mysqli_fetch_assoc($result);

if ($arr) {
    session_start();
    $id = $arr['id'];
    $_SESSION['id'] = $id;
    $token = openssl_random_pseudo_bytes(20);
    $token = bin2hex($token);
    if ($remember) {
        $connect_DB->update("customers", [
            'token' => "$token"
        ], "id = $id");
    }
    setcookie("token", $token, time() + 10000000);
    header("location:customer_home.php?success?Đăng nhập thành công");
    exit;
} else {
    header("location:login_form.php?error=Sai thông tin đăng nhập");
    exit;
}
