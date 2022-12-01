<?php
require_once "admin\db-handeler\bootstrap.php";

// get post info
$news_id = $_GET['news_id'];
$sql = "select news.create_at, title, content, customers.name, image from news join customers on news.customer_id = customers.id where news.id = $news_id";
$news = $connect_DB->execute_sql($sql);
$news = mysqli_fetch_assoc($news);

$title = $news['title'];
$content = $news['content'];
$author = $news['name'];
$time = $news['create_at'];
$image = $news['image'];
?>

<article class="singular-container">
    <h1 class="title-page detail"><?= $title ?></h1>
    <div class="author-wrap">
        <div class="author-name">
            <?= $author ?>
        </div>
        <time class="post-time" datetime="<?= $time ?>">
            <?= $time ?>
        </time>
    </div>

    <div class="singular-content">
        <img src="<?= $image ?>" alt="Ảnh bài đăng">
        <p>
            <?= $content ?>
        </p>
    </div>
</article>