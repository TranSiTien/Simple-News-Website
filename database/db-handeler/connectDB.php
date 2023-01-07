<?php
namespace Core\Database;

use PDOException;
class connector
{
    public static function connect($db_config)
    {
        try {
            $connect_db = mysqli_connect($db_config['server_name'], $db_config['user_name'], $db_config['passwork'], $db_config['db_name']);
            mysqli_set_charset($connect_db, 'utf8');
            return $connect_db;
        } catch (PDOException $error) {
            die($error->getMessage());
        }
    }
}
