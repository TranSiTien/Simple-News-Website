<?php foreach ($news as $each) { ?>
    <article class="article_item">
        <div class="article_thumb">
            <a href="/post?<?= "news_id=" . $each['id'] ?>">
                <img src="<?= "../../img/post_img/" . $each['image'] ?>" alt="Ảnh bài đăng">
            </a>
        </div>
        <div class="article_content">

            <h3 class="article_title">
                <a href="/post?<?= "news_id=" . $each['id'] ?>">
                    <?= $each['title'] ?>
                </a>
            </h3>

            <div class="article_excerpt">
                <a href="/post?<?= "news_id=" . $each['id'] ?>">
                    <?php echo $each['excerpt'] . "..." ?>
                </a>
            </div>
        </div>
    </article>
<?php } ?>