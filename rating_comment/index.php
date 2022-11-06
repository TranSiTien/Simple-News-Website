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
    require '../database/bootsDB.php';
    $news_id = $_GET['news_id'];
    $news = $connect_DB->select('news', "*", "id = $news_id");
    $rating_comment = $connect_DB->select('rating_comment', "*", "customer_id = $news_id");

    $cus_join_ratcmt = $connect_DB->join("customers", "rating_comment", "*", "customers.id = rating_comment.customer_id", "news_id = $news_id");
    $ad_join_ratcmt = $connect_DB->join("admin", "rating_comment", "*", "admin.id = rating_comment.admin_id", "news_id = $news_id");
    ?>

    <table style="border: 1px solid black">
        <th>Mã</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Ảnh</th>
        <th>Sửa</th>
        <th>Xóa</th>
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
            <td>
                <button>
                    <a href="../news/update_form.php?id=<?php echo $news['id'] ?>">
                        Sửa
                    </a>
                </button>

            </td>
            <td>
                <button>
                    <a href="../news/delete.php?id=<?php echo $news['id'] ?>">
                        Xóa
                    </a>
                </button>

            </td>
        </tr>
    </table>
    <h2>Các bình luận</h2>

    <?php
    require 'display_rating_comment.php';
    if (!empty($cus_join_ratcmt) && !empty($ad_join_ratcmt)) {
        foreach ($cus_join_ratcmt as $each) {
            $cus = new rating_coment_diplay($each);
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
            <br>
            <br>
        <?php
        }

        foreach ($ad_join_ratcmt as $each) {

            $ad = new rating_coment_diplay($each);
        ?>
            <dd>
            <dt><?php $ad->show_name() ?></dt>
            <dl><?php $ad->show_time() ?></dl>
            <dl><?php $ad->show_rating() ?></dl>
            <dl><?php $ad->show_comment() ?></dl>
            </dd>
            <button>
                <a href="delete.php?news_id=<?= $news_id ?>&rating_comment_id=<?= $each['rating_comment_id'] ?>">
                    Xóa
                </a>
            </button>
            <br>
            <br>
            <br>
    <?php
        }
    }
    ?>

    <a href="../news/index.php">Trở lại danh sách bài đăng</a>
</body>

</html>