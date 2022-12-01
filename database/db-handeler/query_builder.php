<?php
require 'sql_handeler.php';
require 'CRUD.php';
final class query_builder
{
    use sql_handler;
    use query_command;

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
