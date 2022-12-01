<?php

$news_id = $_GET['news_id'];
$sql = "select cus.name ,rating, comment, rc.create_at, rc.reply_id,rc.id from news join rating_comment as rc on news.id = rc.news_id
join customers as cus on rc.customer_id = cus.id
where news.id = $news_id and isnull(rc.reply_id)";
$rat_cmt = $connect_DB->execute_sql($sql)->fetch_all(MYSQLI_ASSOC);
if (!$rat_cmt) {
    echo "<h2>Không có đánh giá và bình luận</h2>";
} else {

    foreach ($rat_cmt as $each) {

?>

        <div class="sumary">
            <div class="parent_info">
                <!-- comment header -->
                <div class="comment_header">
                    <div class="name">
                        <?= $each['name'] ?>
                    </div>
                    <div class="time">
                        <?= $each['create_at'] ?>
                    </div>
                    <div class="rating">
                        <?= $each['rating'] ?>
                    </div>
                </div>

                <!-- comment content -->
                <div class="comment_content">
                    <p>
                        <?= $each['comment'] ?>
                    </p>
                </div>

                <!-- comment footer -->
                <div class="comment_footer">
                    <div class="like btn">
                        <span>Thích</span>
                    </div>
                    <div class="reply btn">
                        <span>Trả lời</span>
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
                            <div class="name">
                                <?= $each_reply['name'] ?>
                            </div>
                            <div class="time">
                                <?= $each_reply['create_at'] ?>
                            </div>
                        </div>
                        <div class="comment_reply_content">
                            <p>
                                <?= $each_reply['comment'] ?>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>

    <?php
    }
}
    ?>