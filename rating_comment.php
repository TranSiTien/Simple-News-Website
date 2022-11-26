<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài đăng và bình luận</title>
</head>

<body>
    <h2>Bài đăng</h2>

    <?php
    require './admin/db-handeler/bootstrap.php';
    require './admin/rating_comment/display.php';

    $news_id = $_GET['news_id'];
    $news = $connect_DB->select('news', "*", "id = $news_id");
    $rating_comment = $connect_DB->select('rating_comment', "*", "customer_id = $news_id");

    $admin_join_ratcmt = $connect_DB->join("admin", "rating_comment", "*", "admin.id = rating_comment.admin_id", "news_id = $news_id");
    ?>

    <table style="border: 1px solid black">
        <th>Mã</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Ảnh</th>
        <tr>

            <td>
                <?php

                echo $news['id'] ?>
            </td>
            <td>
                <?= $news['title']; ?>
            </td>
            <td>
                <?php echo $news['content'] ?>
            </td>
            <td>
                <img src="<?php echo $news['image'] ?>" style="height:200px">
            </td>
        </tr>
    </table>

    <!-- print ratings and comments -->
    <?php
    if (!empty($admin_join_ratcmt)) {
        echo "<h2>Các bình luận</h2>";
        foreach ($admin_join_ratcmt as $each) {
            $cus = new diplay($each);
    ?>
            <dd>
            <dt><?php $cus->show_name() ?></dt>
            <dl><?php $cus->show_time() ?></dl>
            <dl><?php $cus->show_rating() ?></dl>
            <dl><?php $cus->show_comment() ?></dl>

            </dd>
            <button>
                <a href="delete.php?news_id=<?= $news_id ?>&rating_comment_id=<?= $each['rating_comment_id'] ?>">
                    Xóa
                </a>
            </button>
            <br>
    <?php
        }
    } else {
        echo "<h1>Không có bình luận</h1>";
    }
    ?>
    <a href="customers_home.php">Trang chủ</a>
</body>

</html>