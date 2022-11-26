<?php
require "admin/db-handeler/bootstrap.php";
require 'admin/pagination.php';
require 'admin/search.php';
require 'admin/sercurity.php';



session_start();


// check if user is choose remember me before
// if there were update a new token for user set id and name to session
if (isset($_COOKIE['customer_token'])) {

    $token = $_COOKIE['customer_token'];
    $sql = "select id, email, name from customers where token = '$token'";
    $result = $connect_DB->execute_sql($sql);
    $arr = mysqli_fetch_assoc($result);

    $_SESSION['customer_id'] = $arr['id'];
    $_SESSION['customer_email'] = $arr['email'];
    $_SESSION['customer_name'] = $arr['name'];
}


echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

if (isset($_GET['error'])) {
    echo "<p style='color:red'>" . $_GET['error'] . "</p>";
}


$search_key = search::get_search_key();
$articles_per_page = pagination::$articles_per_page;
$article_to_jump = pagination::get_article_to_jump();
$sql = "select substring(content,1,400) as excerpt, title,image, id from news 
    where title like '%$search_key%' or content like '%$search_key%'
    limit $articles_per_page offset $article_to_jump";
$news = $connect_DB->execute_sql($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/articles.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Báo Thức 4.0</title>
</head>

<body>
    <?php
    require_once "view/partials/header.php";
    require_once "view/partials/articles_list.php";
    ?>


    <?php for ($i = 1; $i <= pagination::get_number_of_page($connect_DB, $search_key); $i++) { ?>
        <button>
            <a href="?page=<?php echo $i ?><?= empty($search_key) ? "" : "&search=$search_key" ?>">
                <?php echo $i ?>
            </a>
        </button>

    <?php } ?>
</body>

</html>