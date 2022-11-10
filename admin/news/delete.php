<?php

$id = $_GET['id'];
require '../db-handeler/bootstrap.php';
$connect_DB->delete('news', "id =$id");

header('location:index.php?success=Xóa thành công bài đăng');
exit;
