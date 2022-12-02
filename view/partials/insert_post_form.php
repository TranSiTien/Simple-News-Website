<?php


if (!is_customer()) {
    header('location:/login?error=Không có quyền truy cập');
    exit;
}
?>

<!-- insert form -->
<form action="insert_process.php" method="post">
    <input type="hidden" name="customer_id" value="<?= $_SESSION['customer_id'] ?>">
    <input type="hidden" name="is_pinned" value=0>
    <input type="hidden" name="status" value=1>
    <span>
        Tiêu đề
    </span>
    <textarea name="title"></textarea>
    <br>

    <span>Nội dung</span>
    <textarea name="content"></textarea>
    <br>

    <span>Ảnh</span>
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