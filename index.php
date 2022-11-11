<?php
require "./admin/db-handeler/bootstrap.php";
session_start();
if (isset($_COOKIE['token'])) {

    $token = $_COOKIE['token'];
    $sql = "select id from customers where token = '$token'";
    $result = $connect_DB->execute_sql($sql);
    $arr = mysqli_fetch_assoc($result);
    if ($arr) {
        header("location:customer_home.php?success=Đăng nhập lại thành công");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài đăng</title>
</head>

<body>

    <h2>Danh sách bài đăng</h2>
    <a href="sign_up_form.php">Đăng kí</a>
    <a href="login_form.php">Đăng nhập</a>
    <br>
    <?php

    require './admin/news/pagination.php';
    require './admin/news/search.php';

    $news = $connect_DB->select('news', "*");
    die();
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
                        <a href="rating_comment.php?news_id=<?= $each['id'] ?>">
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