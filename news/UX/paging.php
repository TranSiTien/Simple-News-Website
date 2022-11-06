<?php
class paging
{
    public static $articles_per_page = 2;

    public static function get_page()
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        return $page;
    }

    public static function get_number_of_articles($connect_DB,string $search_key)
    {
        $query_number_articles = "select count(*) from news
        where title like '%$search_key%' or content like '%$search_key%'";
        $number_of_articles_arr = $connect_DB->execute_sql($query_number_articles);
        $number_of_articles = mysqli_fetch_all($number_of_articles_arr)[0][0];
        return $number_of_articles;
    }

    public static function get_number_of_page($connect_DB,string $search_key)
    {
        $number_of_page = ceil(self::get_number_of_articles($connect_DB,$search_key)/ self::$articles_per_page);
        return $number_of_page;
    }

    public static function get_article_to_jump()
    {
        $article_to_jump = (self::get_page() - 1) * self::$articles_per_page;
        return $article_to_jump;
    }
}

