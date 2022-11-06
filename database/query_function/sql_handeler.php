<?php
trait sql_handler
{
    abstract protected function get_connect_db();

    public function execute_sql(string $sql)
    {
        try {
            // die($sql);
            return mysqli_query($this->get_connect_db(), $sql);
        } catch (Exception $e) {
            die("sql syntax error - sql : $sql" . $e->getMessage());
        }
    }
}
