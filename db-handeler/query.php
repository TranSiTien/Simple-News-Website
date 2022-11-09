<?php
require 'query_function/sql_handeler.php';
require 'query_function/CRUD.php';
final class query_builder
{
    use sql_handler;
    use useful_query_func;

    private \mysqli $connect_db;


    public function __construct(\mysqli $connect_db)
    {
        $this->connect_db = $connect_db;
    }
    function __destruct()
    {
        mysqli_close($this->connect_db);
    }
    public function get_connect_db()
    {
        return $this->connect_db;
    }
}
