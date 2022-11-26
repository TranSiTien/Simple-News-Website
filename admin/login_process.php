<?php


require 'db-handeler/bootstrap.php';
require 'sercurity.php';

// redirect to login page if user is not logged in
if (empty($_POST['email']) || empty($_POST['password'])) {
    header('location:sign_up_form.php?error=Thiếu thông tin!');
    exit;
}

// get user input
$email = $_POST['email'];
$password = $_POST['password'];

// check if admin want to remember login
if (isset($_POST['remember'])) {
    $remember = true;
} else {
    $remember = false;
}

// check if user exists
$sql = "select id, name from admin where email = '$email' and password = '$password'";
$result = $connect_DB->execute_sql($sql);
$arr = mysqli_fetch_assoc($result);

// if user not exits then redirect to login page
if ($arr) {
    session_start();

    // save some user info to session
    $id = $arr['id'];
    $name = $arr['name'];
    $_SESSION['admin_id'] = $id;
    $_SESSION['admin_name'] = $name;
    $_SESSION['admin_email'] = $email;

    // generate ramdom token
    $token = makeToken();
    if ($remember) {
        $connect_DB->update("admin", [
            'token' => "$token"
        ], "id = $id");
        setcookie("admin_token", $token, time() + 60 * 60 * 24 * 30); // set cookie admin info for 30 days
    }
    header("location:index.php?success?Đăng nhập thành công");
    exit;
} else {
    header("location:login_form.php?error=Sai thông tin đăng nhập");
    exit;
}
