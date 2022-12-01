<?php



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
        throw new Exception("Lỗi: Không tìm thấy admin với token này");
    }
} else if (isset($_SESSION['admin_id'])) {
    if (!is_admin()) {
        throw new Exception("Lỗi: Bạn không có quyền truy cập trang này");
    }
} else {
    header("location:/admin/login?error=Vui lòng đăng nhập");
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
    <a href="/admin/logoutProcess">Đăng xuất</a>

    <!-- content -->
    <h1>UID: <?= $_SESSION['admin_id'] ?></h1>
    <h1>Chào admin: <?= $_SESSION['admin_name'] ?></h1>
</body>

</html>