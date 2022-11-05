<?php
class connector{
    public static function connect($config){
        try {
            $connect_db = mysqli_connect($config['server_name'], $config['user_name'], $config['passwork'], $config['db_name']);
        mysqli_set_charset($connect_db, 'utf8');
        return $connect_db;
        }
        catch (PDOException $error)
        {
            die($error->getMessage());
        }   
    }
}

