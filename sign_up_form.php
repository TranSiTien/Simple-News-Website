<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>

<body>
    <form action="sign_up_process.php" method="post">
        <h1> Đăng ký </h1>
        <fieldset>
            <label for="email">Email:</label>
            <input id="email-input" type="email" name="email">
            <span id="email-error"></span>

            <label for="password">Mật khẩu:</label>
            <input id="password-input" type="password" name="password">
            <span id="password-error"></span>

            <label for="password">Nhập lại mật khẩu:</label>
            <input id="cfm_password-input" type="password" name="cfm_password">
            <span id="cfm_password-error"></span>

        </fieldset>

        <button type="submit" onclick="return validate_form()">Đăng ký</button>
        <!-- <script> -->
        <?php
        if (isset($_GET['error'])) {
            echo $_GET['error'];
        }
        //     if ($_GET['error'] == "Email đã được sử dụng")
        //         echo "document.getElementById('email-error').innerHTML = " . $_GET['error'];
        // } else if (isset($_GET['error'])) {
        //     if ($_GET['error'] == "Mật khẩu gồm tối thiểu 8 kí tự")
        //         echo "document.getElementById('password-error').innerHTML = " . $_GET['error'];
        // } else if (isset($_GET['error'])) {
        //     if ($_GET['error'] == "Mật khẩu nhập lại không đúng")
        //         echo "document.getElementById('cfm_password-error').innerHTML = " . $_GET['error'];
        // }
        ?>
        <!-- </script> -->

    </form>

    <script type="text/javascript" src="js/validate_sign_up.js">


    </script>
</body>

</html>