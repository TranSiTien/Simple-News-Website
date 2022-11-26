<?php
session_start();

require_once 'admin/db-handeler/bootstrap.php';
require_once 'admin/sercurity.php';



//validate input information in sign up form again
if (empty($_POST['customers_email']) || empty($_POST['customers_password'])) {
    $_SESSION['email_input'] = $_POST['customers_email'];
    header('location:login_form.php?error=Thiếu thông tin!');
    exit;
}

echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

$email = $_POST['customers_email'];
$password = $_POST['customers_password'];
if (isset($_POST['customers_remember'])) {
    $remember = true;
} else {
    $remember = false;
}


$sql = "select id, token, name ,password from customers where email = '$email'";
$result = $connect_DB->execute_sql($sql);
$arr = mysqli_fetch_assoc($result);


if (!$arr) {
    $_SESSION['email_input'] = $email;
    header("location:login_form.php?error=Email không tồn tại");
    exit;
}
if ($arr['password'] != $password) {
    $_SESSION['email_input'] = $email;
    header("location:login_form.php?error=Mật khẩu không đúng");
    exit;
}

$id = $arr['id'];
$_SESSION['customer_id'] = $id;
$_SESSION['customer_email'] = $email;
$_SESSION['customer_name'] = $arr['name'];

// if user check remember me then create cookie with token exist a month
$token = makeToken();
if ($remember) {
    $connect_DB->update("customers", [
        'token' => "$token"
    ], "id = $id");
    setcookie("customer_token", $token, time() + 60 * 60 * 24 * 30); // set cookie customer token for 30 days
}


// header("location:" . $_SESSION['previous_page']['path'] . "?success=Đăng nhập thành công");

header("location:index.php?success?Đăng nhập thành công");
exit;
