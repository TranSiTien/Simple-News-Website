<?php


if (!is_customer()) {
    header('location:/login?error=Không có quyền truy cập');
    exit;
}
$sql = "select * from categories";
$result = $connect_DB->execute_sql($sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="lib/css/mobiscroll.javascript.min.css">
    <script src="lib/js/mobiscroll.javascript.min.js"></script>

    <!-- boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="view/css/insert_post_form.css">
    <link rel="stylesheet" href="view/css/header.css">
    <link rel="stylesheet" href="view/css/side_bar.css">

    <title>Document</title>
</head>

<body>
    <?php
    require_once "view/partials/header.php";
    require_once "view/partials/side_bar.php";
    ?>
    <form action="/insertPostProcess" method="post" enctype="multipart/form-data">

        <input type="hidden" name="customer_id" value="<?= $_SESSION['customer_id'] ?>">



        <label>
            <span>Tiêu đề</span>
            <textarea mbsc-textarea rows="10" data-input-style="underline" data-label-style="stacked" data-end-icon="newspaper" name="title"></textarea>
        </label>
        <br>

        <label>
            <span>Nội dung</span>
            <textarea mbsc-textarea rows="30" data-input-style="underline" data-label-style="stacked" data-start-icon="bubble" name="content"></textarea>
        </label>

        <div class="mbsc-grid mbsc-row mbsc-justify-content-center">
            <label>
                <span>Chọn ảnh</span>

                <input data-input-style="outline" data-end-icon="attachment" data-label-style="floating" mbsc-input type="file" placeholder="Không có cũng được" name="uploadImage" tabindex="3" />
            </label>

            <div class="categories-selection">
                <label>
                    <span>Chọn thể loại</span>
                    <input mbsc-input id="categories-input" placeholder="Bạn chưa chọn thể loại nào cho bài đăng... nhưng mà không sao :3" data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" name="categories" />
                </label>
                <select id="categories-mul-select" multiple>
                    <?php
                    foreach ($categories as $category) {
                        echo "<option value='$category[id]'>$category[name]</option>";
                    }
                    ?>
                </select>
            </div>
        </div>


        <div class="text-center">
            <button mbsc-button id="show-cfm" class="btn btn-outline-primary btn-lg" type="submit" onclick="return show_cfm()">Xác nhận</button>
        </div>

    </form>

    <?php
    require_once __DIR__ . "/../js/select_category.php";
    require_once __DIR__ . "/../js/side_bar.php";
    ?>

</body>

</html>