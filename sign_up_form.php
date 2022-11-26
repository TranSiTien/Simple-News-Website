<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/sign_up_form.css">
    <title>Đăng ký</title>
</head>

<body>
    <form action="sign_up_process.php" class="form_container" method="post">
        <h2 class="login_title"> Tạo tài khoản dành riêng cho bạn </h2>
        <fieldset class="input_container">
            <label for="email">Email:</label>
            <input id="email-input" type="email" name="customer_email" value="">
            <span id="email-error" class="input_error"></span>
            <br>

            <label for="password">Mật khẩu:</label>
            <input id="password-input" type="password" name="customer_password">
            <span id="password-error" class="input_error"></span>
            <br>

            <label for="password">Nhập lại mật khẩu:</label>
            <input id="cfm_password-input" type="password" name="customer_cfm_password">
            <span id="cfm_password-error" class="input_error"></span>
            <br>


        </fieldset>
        <button type="submit" onclick="return validate_form()" class="submit_button">Đăng ký</button>
        <div class="login_suggest">
            <span>Bạn đã có tài khoản?</span>
            <a href="login_form.php">Đăng nhập</a>
        </div>
        <a href="index.php" class="home_link">Trang chủ</a>
    </form>
    <?php
    require_once "js/validate_sign_up.php";
    ?>

    <!-- frontend validate -->
    <script type="text/javascript" src="js/validate_sign_up.js"></script>
</body>

</html>