<?php

$content = $_POST['content'];
$image = $_POST['image'];
$title = $_POST['title'];

require '../database/bootsDB.php';
$connect_DB->insert(
    'news',
    [
        'title' => "'$title'",
        'image' => "'$image'",
        'content' => "'$content'"
    ]
);

header('location:index.php?success=Thêm thành công bài đăng');
exit;
