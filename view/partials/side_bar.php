<!-- Open on hover menu -->
<div id="side-bar" class="side-bar">

    <div class="nav-links">
        <?php
        $nav_list = [
            '/' => 'Trang chủ',
            '/profile' => 'Trang cá nhân',
            '/createPost' => 'Đăng bài',
            '/category' => 'Thể loại',
            '/updatePost' => 'Quản lý bài viết',
        ];
        foreach ($nav_list as $link => $name) {
            if (!is_customer() && ($link == '/profile' || $link == '/createPost' || $link == '/updatePost')) continue;
            if (Request::uri() == $link) {
                echo "<a class=\"active\" href='$link'>$name</a>";
            } else {
                echo "<a href='$link'>$name</a>";
            }
        }
        ?>
    </div>
</div>