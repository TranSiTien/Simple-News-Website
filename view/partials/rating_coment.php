<?php

$news_id = $_GET['news_id'];
$sql = "select cus.name ,rating, comment, rc.create_at, rc.reply_id,rc.id from news join rating_comment as rc on news.id = rc.news_id
join customers as cus on rc.customer_id = cus.id
where news.id = $news_id and isnull(rc.reply_id)";
$rat_cmt = $connect_DB->execute_sql($sql)->fetch_all(MYSQLI_ASSOC);

 if (!$rat_cmt) {
    echo "<h2>Không có đánh giá và bình luận</h2>";
}?>
   <button class="comment_btn" type="button" onclick="openComment(this);hidden(this)">
        Viết bình luận...
    </button>
    <form class="comment_form hidden">
        <div class="form-group">
            <label for="comment">Bình luận</label>
            <textarea class="form-control" id="comment" rows="3"></textarea>

            <label for="rating">Đánh giá</label>
            <input mbsc-rating type="rating" step=".5" min="0" max="3" value="1.5" />
        
                <input data-input-style="outline" data-end-icon="attachment" data-label-style="floating" mbsc-input type="file" placeholder="Không có cũng được" name="uploadImage" accept=".jpg,.jpeg,.gif,.webp" />
        </div>
    </form>
    <label></label>
    <div mbsc-form>
    <div class="mbsc-form-group">
        <div class="mbsc-form-group-title">Rating</div>
        <label>
            Simple rating
            <input mbsc-rating type="rating" />
        </label>
        <label>
            Custom icons
            <input mbsc-rating type="rating" data-role="none" data-empty="heart2" data-filled="heart" value="3" />
        </label>
        <label>
            Half steps
            <input mbsc-rating type="rating" step=".5" min="0" max="3" value="1.5" />
        </label>
        <label>
           Value
            <input mbsc-rating type="rating" data-val="right" max="6" value="4" data-template="{value}/{max}" />
        </label>
        <label>
            Disabled
            <input mbsc-rating type="rating" disabled />
        </label>
    </div>
    <div class="mbsc-form-group">
        <div class="mbsc-form-group-title">Rating colors</div>
        <label class="mbsc-rating-primary">
            Primary
            <input mbsc-rating type="rating" type="rating" />
        </label>
        <label class="mbsc-rating-secondary">
            Secondary 
            <input mbsc-rating type="rating" type="rating" />
        </label>
        <label class="mbsc-rating-success">
            Success 
            <input mbsc-rating type="rating" type="rating" />
        </label>
        <label class="mbsc-rating-danger">
            Danger 
            <input mbsc-rating type="rating" type="rating" />
        </label>
        <label class="mbsc-rating-warning">
            Warning 
            <input mbsc-rating type="rating" type="rating" />
        </label>
        <label class="mbsc-rating-info">
            Info 
            <input mbsc-rating type="rating" type="rating" />
        </label>
    </div>
</div>
    <?php

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

    ?>