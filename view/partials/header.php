    <!-- header bar -->
    <header class="header_container">
        <!-- logo link to home page -->
        <div class="logo">
            <a href="/">
                <img src="img/newspaper.png">
                <span>Báo Thức 4.0</span>
            </a>
        </div>

        <!-- only home page need search bar -->
        <?php
        if (Request::uri() == "/") {
        ?>
            <form action="" class="search_form">
                <input type="search" name="search" value="<?php echo $search_key ?>">
                <button><img src="img/loupe.png" alt="kính lúp"></button>
            </form>
        <?php }

        if (!is_customer()) {
        ?>
            <div class="identification">
                <a href="/signup">Đăng kí</a>
                <a href="/login">Đăng nhập</a>
            </div>
        <?php } else { ?>
            <div class="identification">
                <a href="/logoutProcess">Đăng xuất</a>
            </div>
        <?php }
        ?>

    </header>