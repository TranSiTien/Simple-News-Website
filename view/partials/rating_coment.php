<?php
require_once "admin\db-handeler\bootstrap.php";

$news_id = $_GET['news_id'];
$sql = "select cus.name ,rating, comment, rc.create_at, rc.reply_id,rc.id from news join rating_comment as rc on news.id = rc.news_id
join customers as cus on rc.customer_id = cus.id
where news.id = $news_id and isnull(rc.reply_id)";
$rat_cmt = $connect_DB->execute_sql($sql);


foreach ($rat_cmt as $each)
?>

<div class="sumary">
    <div class="parent_info">
        <!-- comment header -->
        <div class="comment_header">
            <div class="comment_header_left">
                <div class="comment_header_left_name">
                    <?= $each['name'] ?>
                </div>
                <div class="comment_header_left_time">
                    <?= $each['create_at'] ?>
                </div>
            </div>
            <div class="comment_header_right">
                <div class="comment_header_right_rating">
                    <?= $each['rating'] ?>
                </div>
            </div>
        </div>

        <!-- comment content -->
        <div class="comment_content">
            <?= $each['comment'] ?>
        </div>

        <!-- comment footer -->
        <div class="comment_footer">
            <div class="comment_footer_left">
                <div class="comment_footer_left_like">
                    <span>Thích</span>
                </div>
                <div class="comment_footer_left_reply">
                    <span>Trả lời</span>
                </div>
            </div>
            <div class="comment_footer_right">
                <div class="comment_footer_right_report">
                    <span>Báo cáo</span>
                </div>
            </div>
        </div>

        <?php
        $reply_id = $each['id'];
        $sql = "select rc.comment, cus.name, rc.create_at from rating_comment as rc 
        join rating_comment as rc2 on rc.reply_id = rc2.id
        join customers as cus on rc.customer_id = cus.id
        where rc.reply_id = $reply_id";
        $reply = $connect_DB->execute_sql($sql);

        foreach ($reply as $each_reply) {
        ?>
            <br>
            <!-- comment reply -->
            <div class="comment_reply">
                <div class="comment_reply_header">
                    <div class="comment_reply_header_left">
                        <div class="comment_reply_header_left_name">
                            <?= $each_reply['name'] ?>
                        </div>
                        <div class="comment_reply_header_left_time">
                            <?= $each_reply['create_at'] ?>
                        </div>
                    </div>
                </div>
                <div class="comment_reply_content">
                    <?= $each_reply['comment'] ?>
                </div>
            </div>
        <?php } ?>
    </div>