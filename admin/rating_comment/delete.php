<?php

$rating_comment_id = $_GET['rating_comment_id'];
$news_id = $_GET['news_id'];
require '../database/bootsDB.php';
$connect_DB->delete('rating_comment', "rating_comment_id = $rating_comment_id");
header("location:index.php?news_id=$news_id");
exit;
