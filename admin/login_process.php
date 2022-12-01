<?php





// get user input
$email = $_POST['admin_email'];
$password = $_POST['admin_password'];

// check if admin want to remember login
if (isset($_POST['admin_remember'])) {
    $remember = true;
} else {
    $remember = false;
}

// check if user exists
$sql = "select id, token, name, password from admin where email = '$email'";
$result = $connect_DB->execute_sql($sql);
$arr = mysqli_fetch_assoc($result);

// save input email for using in login page
$_SESSION['email_input'] = $email;

// redirect to login page if user is not logged in
if (empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
    header('location:/admin/login?error=Thiếu thông tin!');
    exit;
}
if (!$arr) {
    header("location:/admin/login?error=Email không tồn tại");
    exit;
}
if ($arr['password'] != $password) {
    header("location:/admin/login?error=Mật khẩu không đúng");
    exit;
}

// save some user info to session
$id = $arr['id'];
$name = $arr['name'];
$_SESSION['admin_id'] = $id;
$_SESSION['admin_name'] = $name;
$_SESSION['admin_email'] = $email;

if ($remember) {
    // if user check remember me then create cookie with token exist a month
    $token = makeToken();
    $connect_DB->update("admin", [
        'token' => "$token"
    ], "id = $id");
    setcookie("admin_token", $token, time() + 60 * 60 * 24 * 30); // set cookie admin info for 30 days
}
header("location:/admin?success=Đăng nhập thành công");
exit;
