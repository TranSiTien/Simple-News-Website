<?php
function push_post_data_to_session()
{
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['content'] = $_POST['content'];
    $_SESSION['categories_selected'] = explode(", ", $_POST['categories']);
}
function accepted_file_extention($file_extention)
{
    $accepted_file_extention = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    if (!in_array($file_extention, $accepted_file_extention)) {
        push_post_data_to_session();
        header('location:/createPost?error=File không đúng định dạng');
        exit;
    }
}
if (!is_customer()) {
    header('location:/login?error=Không có quyền truy cập');
    exit;
}
$cus_id = $_POST['customer_id'];
$is_pinned = 0;

// status:
// 0 - this news have been denied by admin or super admin
// 1 - customer recently push this news and waiting for admin check
// 2 - admin says news not available need to change
// 3 - admin accept this news and push request for supper admin browse
// 4 - supper admin accept this news and push to website
$status = 1;
$title = $_POST['title'];
$content = $_POST['content'];

// save image
if ($_FILES['uploadImage']['name'] != '') {
    $file_extention = pathinfo($_FILES['uploadImage']['name'], PATHINFO_EXTENSION);
    accepted_file_extention($file_extention);
    $image_info = $_FILES['uploadImage'];
    if ($image_info['size'] > 1000000) {
        push_post_data_to_session();
        header('location:/createPost?error=Kích thước ảnh quá lớn');
        exit();
    }

    $target_dir = __DIR__ . "/../img/post_img/";
    $image_name = uniqid() . "." . $file_extention;
    move_uploaded_file($image_info['tmp_name'],  $target_dir . $image_name);
}

$created_at = date('Y-m-d H:i:s');
$categories_selected = explode(", ", $_POST['categories']);


// find available new_id for post
$sql = "select max(id) from news";
$result = $connect_DB->execute_sql($sql);
$news_id = mysqli_fetch_array($result)[0] + 1;


// insert post
$sql = "INSERT INTO news (id, customer_id, is_pinned, status, title, content, image, create_at)
 VALUES ($news_id, $cus_id, $is_pinned, $status, '$title', '$content', '$image_name', '$created_at')";
$connect_DB->execute_sql($sql);

// insert categories of post
$sql = "select id, name from categories";
$categories = $connect_DB->execute_sql($sql);
$categories = $categories->fetch_all(MYSQLI_ASSOC);
$categories = array_column($categories, 'id', 'name');
foreach ($categories_selected as $key => $value) {
    if (array_key_exists($value, $categories)) {
        $sql = "INSERT INTO classify (news_id, category_id) VALUES ($news_id, $categories[$value])";
        $connect_DB->execute_sql($sql);
    }
}

header('location:/?success=Đăng bài thành công');
