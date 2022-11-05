<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm bài đăng</title>
</head>

<body>
    <h2>Thêm bài đăng</h2>
    <form action="insert_process.php" method="post">
        Tiêu đề
        <input type="text" name="title">
        <br>
        Nội dung
        <textarea name="content"></textarea>
        <br>
        Ảnh
        <textarea name="image"></textarea>
        <br>
        <br>
        <button type="submit">Thêm</button>
    </form>
</body>

</html>