<?php
class pagination
{
    public static $articles_per_page = 4;


    // get page number from url
    public static function get_page(string $search_key)
    {

        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if ($page < 1)
            $page = 1;
        $number_of_page = self::get_number_of_page($search_key);
        if ($page > $number_of_page)
            $page = $number_of_page;

        return $page;
    }

    // calculate number of articles in each page
    public static function get_number_of_articles(string $search_key)
    {
        global $connect_DB;
        $query_number_articles = "select count(*) from news
        where title like '%$search_key%' or content like '%$search_key%'";
        $number_of_articles_arr = $connect_DB->execute_sql($query_number_articles);
        $number_of_articles = mysqli_fetch_all($number_of_articles_arr)[0][0];
        return $number_of_articles;
    }

    // calculate number of page
    public static function get_number_of_page(string $search_key)
    {
        $number_of_page = ceil(self::get_number_of_articles($search_key) / self::$articles_per_page);
        return $number_of_page;
    }

    // calculate article to jump
    public static function get_article_to_jump(string $search_key)
    {
        $page = self::get_page($search_key);
        if($page == 0)
        $page =1;
        $article_to_jump = ($page - 1) * self::$articles_per_page;
        return $article_to_jump;
    }
}
