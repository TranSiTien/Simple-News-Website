<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài đăng</title>
</head>

<body>
    <h2>Danh seg bài đăng</h2>

    <?php
    require '../database/bootsDB.php';
    $news = $connect_DB->select('news', "*");

    ?>

    <table style="border: 1px solid black">
        <th>Mã</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Ảnh</th>
        <th>Sửa</th>
        <th>Xóa</th>
        <th>Phần bình luận</th>
        <?php foreach ($news as $each) { ?>
            <tr>

                <td>
                    <?php

                    echo $each['id'] ?>
                </td>
                <td>
                    <?= $each['title']; ?>
                </td>
                <td>
                    <?php echo $each['content'] ?>
                </td>
                <td>
                    <img src="<?php echo $each['image'] ?>" style="height:200px">
                </td>
                <td>
                    <a href="update_form.php?id=<?php echo $each['id'] ?>">
                        Sửa
                    </a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $each['id'] ?>">
                        Xóa
                    </a>
                </td>
                <td>
                    
                    <a href="../rating_comment/index.php?id=<?= $each['id'] ?>">
                        Vào phần bình luận
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <button>
        <a href="insert_form.php">
            Tạo bài đăng
        </a>
    </button>
</body>

</html>