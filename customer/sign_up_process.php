<?php


session_start();

$email = $_POST['customer_email'];
$password = $_POST['customer_password'];
$cfm_password = $_POST['customer_cfm_password'];

$sql = "select count(*) from customers where email = '$email'";
$result = $connect_DB->execute_sql($sql);
$num_row = mysqli_fetch_array($result)[0];
$_SESSION['email_input'] = $email;


if (empty($_POST['customer_email']) || empty($_POST['customer_password']) || empty($_POST['customer_cfm_password'])) {
    header('location:sign_up_form.php?error=Thiếu thông tin!');
    exit;
}
if ($num_row) {
    header("location:/signup?error=Email đã được sử dụng");
    exit;
} else if ($cfm_password != $password) {
    header("location:/signup?error=Mật khẩu nhập lại không đúng");
    exit;
} else if (strlen($password) < 8) {
    header("location:/signup?error=Mật khẩu gồm tối thiểu 8 kí tự");
    exit;
}

$token = makeToken();
$connect_DB->insert("customers", [
    'email' => "'$email'",
    'password' => "'$password'",
    'token' => "'$token'",
]);

header("location:/?success=tạo tài khoản thành công");
exit;
