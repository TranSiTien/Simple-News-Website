<?php
require_once '../sercurity.php';
require_once '../db-handeler/bootstrap.php';

if (!checkCustomer($connect_DB)) {
    header('location:../index.php?error=Không có quyền truy cập');
    exit;
}
?>


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

    <!-- insert form -->
    <form action="insert_process.php" method="post">

        <input type="hidden" name="customer_id" value="<?= $_SESSION['customer_id'] ?>">
        <input type="hidden" name="is_pinned" value=0>
        <input type="hidden" name="status" value=1>

        Tiêu đề
        <textarea name="title"></textarea>
        <br>

        Nội dung
        <textarea name="content"></textarea>
        <br>

        Ảnh
        <textarea name="image"></textarea>
        <br>
        <br>

        <div class="category_selection_list">
            <button class="category_select_btn">Lựa chọn thể loại</button>
            <div class="category_content">
                <?php
                $categories = $connect_DB->select('categories', '*');
                foreach ($categories as $category) {
                    echo "<div class='category_item'>
                            <input type='checkbox' name='category_id[]' value='$category[id]'>
                            <label for='category_id'>$category[name]</label>
                            </div>";
                }
                ?>
            </div>
        </div>

        <br>



        <button type="submit">Xác nhận</button>

    </form>
</body>

</html>