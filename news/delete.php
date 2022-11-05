<?php

$id = $_GET['id'];
require '../database/bootsDB.php';
$connect_DB->delete('news', "id =$id");

header('location:index.php?success=Xóa thành công bài đăng');
exit;
