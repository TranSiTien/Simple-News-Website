<?php
session_start();
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/login_form.css">
    <title>Đăng Nhập</title>
</head>

<body>
    <form action="login_process.php" class="form_container" method="post">
        <h2 class="login_title"> Đăng Nhập </h2>
        <fieldset class="input_container">
            <label for="email">Email:</label>
            <input id="email-input" type="email" name="customers_email">
            <span id="email-error" class="input_error"></span>
            <br><br>

            <label for="password">Mật khẩu:</label>
            <input id="password-input" type="password" name="customers_password">
            <span id="password-error" class="input_error"></span>
            <br>


            <input type="checkbox" name="customers_remember">
            <label for="remember">Ghi nhớ đăng nhập</label>
            <br>
        </fieldset>

        <button type="submit" onclick="return validate_form()" class="submit_button">Đăng Nhập</button>
        <div class="sign_up_suggest">
            <span>Bạn chưa có tài khoản?</span>
            <a href="sign_up_form.php">Đăng ký</a>
        </div>
        <a href="index.php" class="home_link">Trang chủ</a>

    </form>

    <!-- frontend validate -->
    <?php
    require_once "js/validate_login.php";
    ?>
</body>