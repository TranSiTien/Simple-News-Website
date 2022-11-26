    <?php
    $_SESSION['previous_page'] = parse_url($_SERVER['REQUEST_URI']);
    var_dump($_SESSION);
    ?>
    <!-- header bar -->
    <header class="header_container">
        <div class="logo">
            <a href="index.php">
                <img src="img/newspaper.png">
                <span>Báo Thức 4.0</span>
            </a>
        </div>

        <?php
        if ($_SERVER['REQUEST_URI'] == "/index.php") {
        ?>
            <form action="" class="search_form">
                <input type="search" name="search" value="<?php echo $search_key ?>">
                <button><img src="img/loupe.png" alt="không thể tải ảnh"></button>
            </form>
        <?php } ?>
        <?php

        if (!isset($_SESSION['customer_id'])) {
        ?>

            <div class="authentication">
                <a href="sign_up_form.php">Đăng kí</a>
                <a href="login_form.php">Đăng nhập</a>
            </div>
        <?php } else { ?>
            <div class="authentication">
                <a href="logout_process.php">Đăng xuất</a>
            </div>
        <?php } ?>
    </header>