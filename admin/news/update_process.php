<?php
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$image = $_POST['image'];

require '../db-handeler/bootstrap.php';
$connect_DB->update(
    'news',
    [
        'title' => $title,
        'content' => $content,
        'image' => $image
    ],
    "id = $id"
);
header('location:index.php?success=Thêm thành công bài đăng');
exit;
