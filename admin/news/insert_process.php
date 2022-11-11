<?php

$content = $_POST['content'];
$image = $_POST['image'];
$title = $_POST['title'];
$category_id = $_POST['category_id'];
require '../db-handeler/bootstrap.php';
session_start();
$connect_DB->insert(
    'news',
    [
        'title' => "'$title'",
        'image_link' => "'$image'",
        'content' => "'$content'",
        'admin_id' => $_SESSION['admin_id'],
        'category_id' => $category_id
    ]
);
header('location:index.php?success=Thêm thành công bài đăng');
exit;
