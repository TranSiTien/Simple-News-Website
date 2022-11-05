<?php
class query_builder
{
    private \mysqli $connect_db;

    function __call($name, $arguments)
    {
        if ($name == 'select')
            switch (count($arguments)) {
                case 2:
                    return $this->select_no_condition($arguments[0], $arguments[1]);
                case 3:
                    return $this->select_with_condition($arguments[0], $arguments[1], $arguments[2]);
                default:
                    die('select function unvalid');
            }

        else if ($name == 'update')
            switch (count($arguments)) {
                case 2:
                    $this->update_no_condition($arguments[0], $arguments[1]);
                    break;
                case 3:
                    $this->update_with_condition($arguments[0], $arguments[1], $arguments[2]);
                    break;
                default:

                    die('update function unvalid');
            }
        else if ($name == 'join')
            switch (count($arguments)) {
                case 3:
                    $this->join_no_condition($arguments[0], $arguments[1], $arguments[2]);
                    break;
                case 4:
                    $this->join_with_condition($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
                    break;
                default:
                    die('join function unvalid');
            }
    }

    private function execute_sql(string $sql)
    {
        $result = mysqli_query($this->connect_db, $sql);
        $error = mysqli_error($this->connect_db);
        if (!empty($error))
            die("query database error");
        return $result;
    }
    public function __construct(\mysqli $connect_db)
    {
        $this->connect_db = $connect_db;
    }
    function __destruct()
    {
        mysqli_close($this->connect_db);
    }
    public function insert(string $table_name, $data)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table_name,
            implode(', ', array_keys($data)),
            implode(',', array_values($data))
        );
        $this->execute_sql($sql);
    }

    public function update_no_condition(string $table_name, $data)
    {
        $col_equal_val = array();
        foreach ($data as $key => $val) {
            $col_equal_val[] =  is_string($val) ? "$key = '$val'" : "$key = $val";
        }

        $sql = sprintf(
            "update %s set %s",
            $table_name,
            implode(',', $col_equal_val),
        );
        $this->execute_sql($sql);
    }

    public function update_with_condition(string $table_name, $data, string $condition)
    {
        $col_equal_val = array();
        foreach ($data as $key => $val) {
            $col_equal_val[] =  is_string($val) ? "$key = '$val'" : "$key = $val";
        }

        $sql = sprintf(
            "update %s set %s where %s",
            $table_name,
            implode(',', $col_equal_val),
            $condition
        );
        $this->execute_sql($sql);
    }

    public function delete(string $table_name, string $condition)
    {
        $sql = "delete from $table_name where $condition";
        $this->execute_sql($sql);
    }



    public function select_no_condition(string $table_name, string $column)
    {
        try {
            $sql = "select $column from $table_name";
            $result = $this->execute_sql($sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("$sql - " . $e->getMessage());
        }
    }

    public function select_with_condition(string $table_name, string $column, string $condition)
    {

        $sql = "select $column from $table_name where $condition";
        $result = $this->execute_sql($sql);
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    public function join_no_condition(string $table_name1, string $table_name2, string $column)
    {
        $sql = "select $column from $table_name1 join $table_name2";
        $result = $this->execute_sql($sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function join_with_condition(string $table_name1, string $table_name2, string $column, string $condition)
    {

        try {
            $sql = "select $column from $table_name1 join $table_name2 $condition";
            $result = $this->execute_sql($sql);
            echo "<pre>";
            var_dump(mysqli_fetch_all($result, MYSQLI_ASSOC));
            echo "</pre>";
            die();
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } catch (Exception $e) {
            die("$sql - " . $e->getMessage());
        }
    }
}
