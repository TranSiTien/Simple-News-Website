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
    $news_id = $_GET['id'];
    $news = $connect_DB->select('news', "*", "id = $news_id");
    $rating_comment = $connect_DB->select('rating_comment', "*", "customer_id = $news_id");
    
    $join_condition = "on customers.id = rating_comment.customer_id where news_id = $news_id";
    $cus_join_ratcmt = $connect_DB->join("customers", "rating_comment","*",$join_condition);
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
                <a href="update_form.php?id=<?php echo $news['id'] ?>">
                    Sửa
                </a>
            </td>
            <td>
                <a href="delete.php?id=<?php echo $news['id'] ?>">
                    Xóa
                </a>
            </td>
        </tr>
    </table>
    <h2>Các bình luận</h2>
    <dl>
        <dt><?= $cus_join_ratcmt['customer_name'];?></dt>
        <dd>time comment: <?=$cus_join_ratcmt['create_at'] ?></dd>
        <dd>rating: <?=$cus_join_ratcmt['rating']  ?></dd>
        <dd>comment: <?=$cus_join_ratcmt['comment']  ?></dd>
    </dl>

    <a href="../news/index.php">Trở lại danh sách bài đăng</a>
</body>

</html>
