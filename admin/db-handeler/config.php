<?php
class config
{
    private static $config = [
        'server_name' => 'localhost',
        'user_name' => 'root',
        'passwork' => '',
        'db_name' => 'simple_news_website'
    ];
    public static function get_config()
    {
        return self::$config;
    }
}
