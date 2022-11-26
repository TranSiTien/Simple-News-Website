<?php
class search
{
    // get search key from url
    public static function get_search_key()
    {
        $search = "";
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        }
        return $search;
    }
}
