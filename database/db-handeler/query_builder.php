<?php
namespace Core\Database;

use \Core\Database\SQLHandeler;
use \Core\Database\CRUD;
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
