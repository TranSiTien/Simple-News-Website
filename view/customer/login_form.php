<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/login_form.css">
    <title>Đăng Nhập</title>
</head>

<body>
    <form action="/loginProcess" class="form_container" method="post">
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


            <label for="remember">Ghi nhớ đăng nhập</label>
            <input type="checkbox" name="customers_remember">

            <br>
        </fieldset>

        <button type="submit" onclick="return validate_form()" class="submit_button">Đăng Nhập</button>

        <!-- other suggestion -->
        <div class="sign_up_suggest">
            <span>Bạn chưa có tài khoản?</span>
            <a href="/signup">Đăng ký</a>
        </div>
        <a href="/" class="home_link">Trang chủ</a>

    </form>

    <?php
    require_once __DIR__ . "/../js/validate_login.php";
    ?>

</body>