<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>

<body>
    <form action="login_process.php" method="post">
        <h1> Đăng Nhập admin </h1>
        <fieldset>
            <label for="email">Email:</label>
            <input id="email-input" type="email" name="email">
            <span id="email-error"></span>

            <label for="password">Mật khẩu:</label>
            <input id="password-input" type="password" name="password">
            <span id="password-error"></span>

            <label for="remember">Ghi nhớ đăng nhập</label>
            <input type="checkbox" name="remember" value="on">
        </fieldset>

        <button type="submit" onclick="return validate_form()">Đăng Nhập</button>
        <?php
        if (isset($_GET['error'])) {
            echo $_GET['error'];
        }
        ?>
    </form>

    <script type="text/javascript">
        function validate_form() {
            let email = document.getElementById('email-input').value;
            if (email.length == 0) {
                document.getElementById('email-error').innerHTML = "Email không được để trống";
                email_check = false;
            } else if (!email.includes("@gmail.com", email.length - 10)) {
                document.getElementById('email-error').innerHTML = "Cấu trúc email không hợp lệ";
                email_check = false;
            } else {
                document.getElementById('email-error').innerHTML = "";
                email_check = true;
            }

            let password = document.getElementById('password-input').value;
            if (password.length == 0) {
                document.getElementById('password-error').innerHTML = "Mật khẩu không được để trống";
                password_check = false;

            } else if (password.length <= 7) {
                document.getElementById('password-error').innerHTML = "Mật khẩu phải gồm ít nhất 8 kí tự";
                password_check = false;
            } else {
                document.getElementById('password-error').innerHTML = "";
                password_check = true;
            }


            if (email_check && password_check) {
                return true;
            }
            return false;
        }
    </script>
</body>