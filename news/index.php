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
    require 'pagination.php';
    require 'search.php';

    $news = $connect_DB->select('news', "*");

    $search_key = search::get_search_key();
    $articles_per_page = pagination::$articles_per_page;
    $article_to_jump = pagination::get_article_to_jump();
    $sql = "select * from news 
    where title like '%$search_key%' or content like '%$search_key%'
    limit $articles_per_page offset $article_to_jump";
    $news = $connect_DB->execute_sql($sql);
    ?>


    <table style="border: 1px solid black">
        <caption>
            <form action="">
                <input type="text" name="search" value="<?php echo $search_key ?>">
                <button>Tìm kiếm</button>
            </form>
        </caption>

        <button>
            <a href="insert_form.php">
                Tạo bài đăng
            </a>
        </button>
        <br>

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
                    <button>
                        <a href="update_form.php?id=<?php echo $each['id'] ?>">
                            Sửa
                        </a>
                    </button>

                </td>
                <td>

                    <button>
                        <a href="delete.php?id=<?php echo $each['id'] ?>">
                            Xóa
                        </a>
                    </button>

                </td>
                <td>
                    <button>
                        <a href="../rating_comment?news_id=<?= $each['id'] ?>">
                            Vào phần bình luận
                        </a>
                    </button>

                </td>
            </tr>
        <?php } ?>
    </table>

    <?php for ($i = 1; $i <= pagination::get_number_of_page($connect_DB, $search_key); $i++) { ?>
        <button>
            <a href="?page=<?php echo $i ?><?= empty($search_key) ? "" : "&search=$search_key" ?>">
                <?php echo $i ?>
            </a>
        </button>

    <?php } ?>

</body>

</html>