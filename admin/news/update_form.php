<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài đăng</title>
</head>

<body>

    <?php
    $id = $_GET['id'];

    require '../db-handeler/bootstrap.php';

    $record = $connect_DB->select('news', '*', "id=$id");

    ?>
    <h2>Sửa bài đăng</h2>
    <form action="update_process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        Tiêu đề
        <input type="text" name="title" value="<?= $record['title'] ?>">
        <br>
        Nội dung
        <textarea name="content"><?= $record['content'] ?></textarea>
        <br>
        Ảnh
        <textarea name="image"><?= $record['image'] ?></textarea>
        <br>
        <br>
        <button type="submit">Sửa</button>
    </form>
</body>

</html>