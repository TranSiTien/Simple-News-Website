<!-- frontend validate -->

<script>
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

<!-- backend validate -->
<script>
    <?php

    if (isset($_SESSION['email_input'])) {
        echo "document.getElementById('email-input').setAttribute('value','" . $_SESSION['email_input'] .
            "');";
    }
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "Email không tồn tại") {
            echo "document.getElementById('email-error').innerHTML = '" . $_GET['error'] .
                "';";
        }
        if ($_GET['error'] == "Mật khẩu không đúng") {
            echo "document.getElementById('password-error').innerHTML = '" . $_GET['error'] .
                "';";
        }
    }
    // session_unset();
    // session_destroy();
    ?>
</script>